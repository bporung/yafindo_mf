<?php

namespace App\Livewire\Forecasts;

use Livewire\Component;
use App\Services\ForecastService;
use App\Models\Cmo;
use App\Models\CmoDetail;
use App\Models\CmoShipment;
use App\Models\Forecast;
use App\Models\Product;
use App\Models\ZonePrice;
use Carbon\Carbon;

class DataInfo extends Component
{
    protected $forecastService;
    public $id;


    public function __construct()
    {
        $forecastService = new ForecastService();
        $this->forecastService = $forecastService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function deleteData()
    {
        $del = $this->forecastService->deleteData($this->id);
        if($del){
            $this->dispatch('alert-info', message: 'Data has been deleted.');
            sleep(3);
            return redirect()->to('/forecasts');
        }else{
            $this->dispatch('alert-error', message: 'Data couldnt be deleted.');
        }
    }
    function convertDateToMonthYear($dateString) {
        // Parse the date string into a Carbon instance
        $date = Carbon::parse($dateString);
    
        // Add one month to the date and set the time to the start of the month
        $date = $date->addMonth()->startOfMonth();
    
        // Format the date as 'M-Y'
        return $date->format('Y-m');
    }
    public function finalizeReport(){
        $fc = Forecast::findOrFail($this->id);
        $fc->status = '1';
        $fc->save();
        $period = $this->convertDateToMonthYear($fc->cut_off_date);

        $cmo = Cmo::create([
            'forecast_id' => $fc->id,
            'customer_id' => $fc->customer_id,
            'period' => $period,
            'status' => '1',
        ]);

        foreach($fc->details as $fcDet){

            $cmoDet = CmoDetail::create([
                'cmo_id' => $cmo->id,
                'product_id' => $fcDet->product_id,
                'customerproduct_id' => $fcDet->customerproduct_id,
                'code' => $fcDet->code,
                'shipmentdetail_id' => $fcDet->shipmentdetail_id,
                'volume' => $fcDet->volume,
                'weight' => $fcDet->weight,
                'qty' => $fcDet->cmo,
                'uom_id' => $fcDet->product->first_uom_id,
                'total_volume' => $fcDet->total_volume,
                'total_weight' => $fcDet->total_weight,
            ]);
        }

        
        foreach($fc->shipments as $fcS){
            $cmoDet = CmoShipment::create([
                'cmo_id' => $cmo->id,
                'shipmentdetail_id' => $fcS->shipmentdetail_id,
                'total_volume' => $fcS->total_volume,
                'total_weight' => $fcS->total_weight,
                'shipment_volume_quota' => $fcS->shipment_volume_quota,
                'shipment_weight_quota' => $fcS->shipment_weight_quota,
                'shipment_volume' => $fcS->shipment_volume,
                'shipment_weight' => $fcS->shipment_weight,
                'shipment_quota_percentage' => $fcS->shipment_quota_percentage,
                'shipment_quota_requirement' => $fcS->shipment_quota_requirement,
                'shipment_type' => $fcS->shipment_type,
            ]);
        }

        $this->dispatch('alert-success', message: 'Form has been finalized.');

    }

    public function deleteReport(){

    }
    
    public function render()
    {
        return view('livewire.forecasts.data-info',[
            'data' => $this->forecastService->findById($this->id),
        ]);
    }
}
