<?php

namespace App\Livewire\Brands;

use Livewire\Component;
use App\Services\BrandService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class DataList extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $brandService;

    public $search;

    public function __construct()
    {
        $brandService = new BrandService();
        $this->brandService = $brandService;
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
        return view('livewire.brands.data-list',[
            'datas'=> $this->brandService->paginateData(20,$this->search ? $this->search : '')
        ]);
    }
}
