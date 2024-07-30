<?php

namespace App\Livewire\Summaries;

use Livewire\Component;
use App\Services\CustomerService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Illuminate\Support\Facades\DB;
use Auth;
class SummarySales extends Component
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
        $this->resetPage();
        $this->dispatch('alert-info', message: 'Data has been searched.');
    }

    public function render()
    {
        $start_date = $this->start_date;
        $end_date = $this->end_date;
        $customer = $this->customer;
        $results = [];
        if($start_date != '' && $end_date != ''){
            if($customer != ''){
                $results = DB::select(
                    'SELECT rsd.product_id as product_id , p.code as product_code, p.name  as product_name,p.nickname as product_nickname, u.code as uom , sum(rsd.conversion_qty) as sum_qty FROM reportsaledetails rsd 
                    LEFT JOIN reportsales rs ON rsd.reportsale_id = rs.id 
                    LEFT JOIN uoms u ON rsd.conversion_uom = u.id 
                    LEFT JOIN products p ON rsd.product_id = p.id 
                    WHERE rsd.date >= ? and rsd.date <= ?
                    AND rs.isPublished = ?
                    AND rs.customer_id = ?
                    GROUP BY rsd.product_id , p.code , p.name , rsd.conversion_uom
                    ORDER BY sum_qty DESC', 
                    [$start_date , $end_date , '1' , $customer]
                );
            }else{
                if(!Auth::user()->can('manage customer')){
                    $userCustomerIds = Auth::user()->usercustomers()->pluck('customer_id')->toArray();
                    $results = DB::select(
                        'SELECT rsd.product_id as product_id , p.code as product_code, p.name  as product_name,p.nickname as product_nickname, u.code as uom , sum(rsd.conversion_qty) as sum_qty FROM reportsaledetails rsd 
                        LEFT JOIN reportsales rs ON rsd.reportsale_id = rs.id 
                        LEFT JOIN uoms u ON rsd.conversion_uom = u.id 
                        LEFT JOIN products p ON rsd.product_id = p.id 
                        WHERE rsd.date >= ? and rsd.date <= ?
                        AND rs.isPublished = ?
                        AND rs.customer_id IN (' . implode(',', $userCustomerIds) . ') 
                        GROUP BY rsd.product_id , p.code , p.name , rsd.conversion_uom
                        ORDER BY sum_qty DESC', 
                        [$start_date , $end_date , '1']
                    );
                }else{
                $results = DB::select(
                    'SELECT rsd.product_id as product_id , p.code as product_code, p.name  as product_name,p.nickname as product_nickname, u.code as uom , sum(rsd.conversion_qty) as sum_qty FROM reportsaledetails rsd 
                    LEFT JOIN reportsales rs ON rsd.reportsale_id = rs.id 
                    LEFT JOIN uoms u ON rsd.conversion_uom = u.id 
                    LEFT JOIN products p ON rsd.product_id = p.id 
                    WHERE rsd.date >= ? and rsd.date <= ?
                    AND rs.isPublished = ?
                    GROUP BY rsd.product_id , p.code , p.name , rsd.conversion_uom
                    ORDER BY sum_qty DESC', 
                    [$start_date , $end_date , '1']
                );
                }
            }

        }


        return view('livewire.summaries.summary-sales',[
            'datas'=> $results
        ]);
    }
}
