<?php

namespace App\Livewire\Uoms;

use Livewire\Component;
use App\Services\UomService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class DataList extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $uomService;

    public $search;

    public function __construct()
    {
        $uomService = new UomService();
        $this->uomService = $uomService;
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
        return view('livewire.uoms.data-list',[
            'datas'=> $this->uomService->paginateData(20,$this->search ? $this->search : '')
        ]);
    }
}
