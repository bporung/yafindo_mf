<?php

namespace App\Livewire\Customers;

use Livewire\Component;
use App\Services\CustomerService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class DataList extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $customerService;

    public $search;

    public function __construct()
    {
        $customerService = new CustomerService();
        $this->customerService = $customerService;
    }
    public function mount()
    {

    }
    
    public function runSearch()
    {
        $this->resetPage();
        $this->dispatch('alert-info', message: 'Data has been searched.');
    }

    public function render()
    {
        return view('livewire.customers.data-list',[
            'datas'=> $this->customerService->paginateData(20,$this->search ? $this->search : '')
        ]);
    }
}
