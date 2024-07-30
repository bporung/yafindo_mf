<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Services\ProductService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class DataList extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $productService;

    public $search;

    public function __construct()
    {
        $productService = new ProductService();
        $this->productService = $productService;
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
        return view('livewire.products.data-list',[
            'datas'=> $this->productService->paginateData(20,$this->search ? $this->search : '')
        ]);
    }
}
