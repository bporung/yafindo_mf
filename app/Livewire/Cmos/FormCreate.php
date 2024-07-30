<?php

namespace App\Livewire\Forecasts;

use Livewire\Component;
use App\Services\CustomerService;
use Livewire\WithFileUploads;
use App\Models\ReportSaleDetail;
use App\Models\Forecast;
use App\Models\ForecastDetail;
use App\Models\ForecastShipment;
use App\Models\CustomerProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FormCreate extends Component
{
    use WithFileUploads;

    public $customer;
    public $period_months;
    public $cut_off_date;
    public $remaining_days;

    public $selectCustomers = [];


    protected $customerService;
    
    
    public function __construct()
    {
        
        $customerService = new CustomerService();
        $this->customerService = $customerService;
    }
    public function mount()
    {
        $this->selectCustomers = $this->customerService->allData();
    }
    public function getPeriodDateStart($a , $b){
        $period_months = $a;
        $cut_off_date = $b;

        $cutOffDate = Carbon::parse($cut_off_date);
        $start_date = $cutOffDate->subMonths($period_months)->startOfMonth()->format('Y-m-d');

        return $start_date;

    }
    public function getPeriodDateEnd($b){
        $cut_off_date = $b;

        $cutOffDate = Carbon::parse($cut_off_date);
        $end_date = $cutOffDate->subMonth()->endOfMonth()->format('Y-m-d');
        return $end_date;
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'customer' => 'required',
            'period_months' => 'required|numeric|min:1',
            'cut_off_date' => 'required|date',
            'remaining_days' => 'required|numeric',
        ]);

        $customer_id = $this->customer;
        $period_months = $this->period_months;
        $cut_off_date = $this->cut_off_date;
        $first_date_of_the_month = date('Y-m-01', strtotime($cut_off_date));
        $remaining_days = $this->remaining_days;

        $start_period = $this->getPeriodDateStart($period_months,$cut_off_date);
        $end_period = $this->getPeriodDateEnd($cut_off_date);

        $data = [
            'period' => [
                'start_period' => $start_period,
                'end_period' => $end_period
            ]
        ];

        $forecast = Forecast::create([
            'customer_id' => $customer_id,
            'period_months' => $period_months,
            'cut_off_date' => $cut_off_date,
            'remaining_days' => $remaining_days,
            'additional_info' => json_encode($data)
        ]);

        $customerproducts = CustomerProduct::where('customer_id',$customer_id)->where('isActive','1')->get();

        $shipData = [];

        foreach($customerproducts as $cp){
            // FIRST QUERY
            $getReportSale = ReportSaleDetail::selectRaw('CONCAT(YEAR(date), "-", LPAD(MONTH(date), 2, "0")) as `year_month`, COUNT(DISTINCT date) as working_days, SUM(conversion_qty) as total_qty')
    ->whereDate('date', '>=', $start_period)
    ->whereDate('date', '<=', $end_period)
    ->where('product_id', $cp->product_id)
    ->whereHas('reportsale', function ($query) use ($customer_id) {
        $query->where('customer_id', $customer_id)
            ->where('isPublished', '1');
    })
    ->groupBy(DB::raw('CONCAT(YEAR(date), "-", LPAD(MONTH(date), 2, "0"))'))
    ->get();


            $dataForDetail = [];
            $dataForDetail['monthly_sales'] = [];
            $avg_qty_1st = 0;
            foreach($getReportSale as $rs){
                $dataForDetail['monthly_sales'][$rs->year_month] = [
                    'working_days' => $rs->working_days,
                    'total_qty' => $rs->total_qty
                ];
                $avg = 0;
                if($rs->working_days > 0){
                    $avg = $rs->total_qty/$rs->working_days;
                }
                $avg_qty_1st += $avg;
            }
            
            $totalQuantity = $getReportSale->sum('total_qty');
            $totalWorkingDays = $getReportSale->sum('working_days');
            $average_sell_out_per_day = $avg_qty_1st/$period_months;
            $safety_stock = $average_sell_out_per_day * ($cp->lead_time + $cp->buffer_time);


            // SECOND QUERY
            $getReportSale2nd = ReportSaleDetail::selectRaw('COUNT(DISTINCT date) as working_days, SUM(conversion_qty) as total_qty')
            ->whereDate('date', '>=', $first_date_of_the_month)
            ->whereDate('date', '<=', $cut_off_date)
            ->where('product_id', $cp->product_id)
            ->whereHas('reportsale', function ($query) use ($customer_id) {
                $query->where('customer_id', $customer_id)
                    ->where('isPublished', '1');
            })
            ->get();

            $actual_current = 0;
            $est_left_current = 0;
            $adj_left_current = 0;
            $est_sell_out_current = 0;
            $total_working_days_current = 0;

            foreach($getReportSale2nd as $rs2nd){
                $dataForDetail['current_month'] = [
                    'working_days' => $rs2nd->working_days,
                    'total_qty' => $rs2nd->total_qty
                ];

                $actual_current = $rs2nd->total_qty;
                $avg = 0;
                if($rs2nd->working_days > 0) {
                    $avg = $rs2nd->total_qty/$rs2nd->working_days;
                }
                $est_left_current = ($avg)* $remaining_days;
                $est_sell_out_current = $est_left_current + $actual_current + $adj_left_current;
                $total_working_days_current = $rs2nd->working_days + $remaining_days;
                break;
            }

            $plan_sell_out_next_month = 0;

            $adj_plan_sell_out_special = 0;

            if ($average_sell_out_per_day > 0) {
                $plan_sell_out_next_month = (($average_sell_out_per_day * $total_working_days_current) + $est_sell_out_current) / 2;
            } else {
                $plan_sell_out_next_month = (($average_sell_out_per_day * $total_working_days_current) + $est_sell_out_current) / 1;
            }

            $final_plan_sell_out_special = $plan_sell_out_next_month + $adj_plan_sell_out_special;

            $cmo_sent = 0;
            $cmo_plan = 0;
            $cmo_left = 0;
            $adj_cmo_left=0;
            $adj_cmo = 0;



            $doi_current_month = 0;
            if ($average_sell_out_per_day > 0) {
                $doi_current_month = ($cp->stock + $cmo_sent+$cmo_plan+$adj_cmo_left+$cmo_left - $est_left_current) / $average_sell_out_per_day;
                if ($doi_current_month <= 0) {
                    $doi_current_month = 0;
                }
            }


            
            $cmo = ($final_plan_sell_out_special + $safety_stock) - ($cp->stock + $cmo_sent + $cmo_plan + $cmo_left + $adj_cmo_left) + ($est_left_current + $adj_cmo);
            if ($cmo <= 0) {
                $cmo = 0;
            }

            $doi_next_month = 0;
            if ($average_sell_out_per_day > 0) {
                $doi_next_month = (($cp->stock + $cmo_sent + $cmo_plan + $cmo_left+$adj_cmo_left+$cmo) - ($est_left_current + $plan_sell_out_next_month)) / $average_sell_out_per_day;
                if ($doi_next_month <= 0) {
                    $doi_next_month = 0;
                }
            }


            $volume = ($cp->product->width * $cp->product->height * $cp->product->depth);
            $weight = $cp->product->weight;
            $total_volume = $volume * $cmo;
            $total_weight = $weight * $cmo;

            $forecastdetail = ForecastDetail::create([
                'forecast_id' => $forecast->id,
                'customerproduct_id' => $cp->id,
                'product_id' => $cp->product_id,
                'code' => $cp->code,
                'target' => $cp->target,
                'stock' => $cp->stock,
                'lead_time' => $cp->lead_time,
                'buffer_time' => $cp->buffer_time,

                'average_sell_out' => $totalQuantity,
                'average_sell_out_per_day' => $average_sell_out_per_day,

                'actual_current' => $actual_current ? $actual_current : 0,

                'est_left_current'=> $est_left_current,
                'est_sell_out_current'=> $est_sell_out_current,
                
                'adj_left_current'=> $adj_left_current,

                'plan_sell_out_next_month'=> $plan_sell_out_next_month,
                'adj_plan_sell_out_special'=> $adj_plan_sell_out_special,
                'final_plan_sell_out_special'=> $plan_sell_out_next_month,

                'safety_stock'=> $safety_stock,

                'cmo_sent'=> $cmo_sent,
                'cmo_plan'=> $cmo_plan,
                'cmo_left'=> $cmo_left,
                'adj_cmo_left'=> $adj_cmo_left,

                'doi_current_month'=> $doi_current_month,
                'doi_next_month'=> $doi_next_month,
                'adj_cmo'=> $adj_cmo,

                'cmo'=> $cmo,

                'volume'=> $volume,
                'weight'=> $weight,
                'total_volume'=> $total_volume,
                'total_weight'=> $total_weight,
                'additional_info'=> json_encode($dataForDetail),
            ]);


            if(isset($shipData[$cp->shipment_id])){
                $shipData[$cp->shipment_id]['total_volume'] += $total_volume;
                $shipData[$cp->shipment_id]['total_weight'] += $total_weight;
            }else{
                $shipData[$cp->shipment_id] = [
                    'total_volume' => $total_volume,
                    'total_weight' => $total_weight,
                    'shipment_volume_quota' => $cp->shipment->max_volume,
                    'shipment_weight_quota' => $cp->shipment->max_weight
                ];
            }
        }

        foreach ($shipData as $key => $ship) {
            $sType = $this->checkShipmentType($ship['shipment_volume_quota'],$ship['shipment_weight_quota'],$ship['total_volume'],$ship['total_weight']);
            $forecastshipment = ForecastShipment::create([
                'forecast_id'=>$forecast->id,
                'shipment_id'=>$key,
                'total_volume'=>$ship['total_volume'],
                'total_weight'=>$ship['total_weight'],
                'shipment_volume_quota'=>$ship['shipment_volume_quota'],
                'shipment_weight_quota'=>$ship['shipment_weight_quota'],
                'shipment_volume'=>$ship['total_volume'] / $ship['shipment_volume_quota'],
                'shipment_weight'=>$ship['total_weight'] / $ship['shipment_weight_quota'],
                'shipment_type'=>$sType,
                'shipment_quota_percentage'=>0,
                'shipment_quota_requirement'=>95,
            ]);

        }



        
        $this->dispatch('alert-success', message: 'Form has been saved.');
        

    }

    public function checkShipmentType($a,$b,$c,$d){
        $shipment_volume_quota = $a;
        $use_shipment_volume_quota = $a;
        $shipment_weight_quota = $b;
        $use_shipment_weight_quota = $b;
        $total_volume = $c;
        $total_weight = $d;

        if ($total_volume > $shipment_volume_quota){
            $use_shipment_volume_quota = ceil($total_volume / $shipment_volume_quota) * $shipment_volume_quota;
        }
        if ($total_weight > $shipment_weight_quota){
            $use_shipment_weight_quota = ceil($total_weight / $shipment_weight_quota) * $shipment_weight_quota;
        }

        $shipment_quota_percentage_volume = 0;
        $shipment_quota_percentage_weight = 0;

        if($total_volume >0){
            $shipment_quota_percentage_volume = ($use_shipment_volume_quota / $total_volume) * 100;
        }   
        if($total_weight >0){
            $shipment_quota_percentage_weight = ($use_shipment_weight_quota / $total_weight) * 100;
        }

        if($shipment_quota_percentage_volume > $shipment_quota_percentage_weight){return  '1';}
        if($shipment_quota_percentage_weight > $shipment_quota_percentage_volume){return  '2';}
        return '1';
    }
    public function render()
    {
        return view('livewire.forecasts.form-create');
    }
}
