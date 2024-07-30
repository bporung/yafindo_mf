<?php

namespace App\Livewire\Zones;

use Livewire\Component;
use App\Services\ZoneService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class DataList extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $zoneService;

    public $search;

    public function __construct()
    {
        $zoneService = new ZoneService();
        $this->zoneService = $zoneService;
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
        return view('livewire.zones.data-list',[
            'datas'=> $this->zoneService->paginateData(20,$this->search ? $this->search : '')
        ]);
    }
}
