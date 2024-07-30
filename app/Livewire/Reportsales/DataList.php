<?php

namespace App\Livewire\Reportsales;

use Livewire\Component;
use App\Services\ReportSaleService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class DataList extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $reportService;

    public $search;

    public function __construct()
    {
        $reportService = new ReportSaleService();
        $this->reportService = $reportService;
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
        return view('livewire.reportsales.data-list',[
            'datas'=> $this->reportService->paginateData(20,$this->search ? $this->search : '')
        ]);
    }
}
