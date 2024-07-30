<?php

namespace App\Livewire\Shipments;

use Livewire\Component;
use App\Services\ShipmentService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class DataList extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $shipmentService;

    public $search;

    public function __construct()
    {
        $shipmentService = new ShipmentService();
        $this->shipmentService = $shipmentService;
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
        return view('livewire.shipments.data-list',[
            'datas'=> $this->shipmentService->paginateData(20,$this->search ? $this->search : '')
        ]);
    }
}
