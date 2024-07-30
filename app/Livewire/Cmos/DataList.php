<?php

namespace App\Livewire\Cmos;

use Livewire\Component;
use App\Services\CmoService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class DataList extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $cmoService;

    public $search;

    public function __construct()
    {
        $cmoService = new CmoService();
        $this->cmoService = $cmoService;
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
        return view('livewire.cmos.data-list',[
            'datas'=> $this->cmoService->paginateData(20,$this->search ? $this->search : '')
        ]);
    }
}
