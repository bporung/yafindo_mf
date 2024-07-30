<?php

namespace App\Livewire\Forecasts;

use Livewire\Component;
use App\Services\ForecastService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class DataList extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $forecastService;

    public $search;

    public function __construct()
    {
        $forecastService = new ForecastService();
        $this->forecastService = $forecastService;
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
        return view('livewire.forecasts.data-list',[
            'datas'=> $this->forecastService->paginateData(20,$this->search ? $this->search : '')
        ]);
    }
}
