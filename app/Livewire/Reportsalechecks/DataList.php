<?php

namespace App\Livewire\Reportsalechecks;

use Livewire\Component;
use App\Services\CustomerService;
use App\Models\Customer;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Auth;
class DataList extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $cSvc;

    public $search;
    public $customers = [];
    public $customer;
    public $start_date;
    public $end_date;

    public $selectCustomers;

    public function __construct()
    {
        $cSvc = new CustomerService();
        $this->cSvc = $cSvc;
    }
    public function mount()
    {
        $customers = $this->cSvc->allData();
        $this->selectCustomers = $customers;

    }
    
    public function runSearch()
    {
        $start_date = $this->start_date;
        $end_date = $this->end_date;
        $customer = $this->customer;

        
        if($start_date == '' || $end_date == ''){
            $this->dispatch('alert-warning', message: 'You Must Filled : Start Date and End Date.');
        }else{
            $this->resetPage();
            $this->dispatch('alert-info', message: 'Data has been searched.');
        }
    }

    public function render()
    {
        $start_date = $this->start_date;
        $end_date = $this->end_date;
        $periods = [];
        $customer = $this->customer;
        $results = [];
        $resCustomers = [];
        $dataRes = [];



        if($start_date != '' && $end_date != ''){
            $periods = $this->setPeriods($start_date,$end_date);
            if($customer != ''){
                $resCustomers = Customer::where('id',$customer)->get();
                $results = DB::select(
                    'SELECT rsd.date , r.customer_id , "1" as "check"  from reportsaledetails rsd
                    left join reportsales r on rsd.reportsale_id = r.id
                    where rsd.date >= ? and rsd.date <= ?
                    and r.customer_id = ? and r.isPublished = ?
                    group by rsd.date,r.customer_id', 
                    [$start_date , $end_date , $customer , '1']
                );

                foreach($results as $res){
                    $periods[$res->date]['value'] = $res->check;
                }
            }else{
                if(!Auth::user()->can('manage customer')){
                    $userCustomerIds = Auth::user()->usercustomers()->pluck('customer_id')->toArray();
                    $resCustomers = Customer::whereIn('id',$userCustomerIds)->get();
                    $results = DB::select(
                        'SELECT rsd.date , r.customer_id , "1" as "check"  from reportsaledetails rsd
                        left join reportsales r on rsd.reportsale_id = r.id
                        where rsd.date >= ? and rsd.date <= ?
                        and r.customer_id IN (' . implode(',', $userCustomerIds) . ')  and r.isPublished = ?
                        group by rsd.date,r.customer_id', 
                        [$start_date , $end_date , '1']
                    );
                }else{
                $resCustomers = $this->selectCustomers;
                    $results = DB::select(
                        'SELECT rsd.date , r.customer_id , "1" as "check"  from reportsaledetails rsd
                        left join reportsales r on rsd.reportsale_id = r.id
                        where rsd.date >= ? and rsd.date <= ?
                        and r.isPublished = ?
                        group by rsd.date,r.customer_id', 
                        [$start_date , $end_date , '1']
                    );

                }
            }


            foreach ($results as $row) {
                $date = $row->date;
                $customer_id = $row->customer_id;
                $check = $row->check;

                if (!isset($dataRes[$date])) {
                    $dataRes[$date] = [];
                }

                $dataRes[$date][$customer_id] = $check;
            }
        }
    


        return view('livewire.reportsalechecks.data-list',[
            'datas'=> $dataRes,
            'resCustomers'=> $resCustomers,
            'periods'=> $periods,
        ]);
    }

    public function setPeriods($a,$b){
        $start_date = Carbon::parse($a); // Ensure $start_date is a Carbon instance
        $end_date = Carbon::parse($b); // Ensure $end_date is a Carbon instance
        $periods = [];

        while ($start_date->lte($end_date)) {
            $periods[$start_date->copy()->format('Y-m-d')] = [
                'day_name' => $start_date->copy()->format('l')
            ]; // Add a copy of $start_date with day name to the periods array

            $start_date->addDay(); // Move to the next day
        }

        return $periods;
    }
}
