<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Services\CategoryService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class DataList extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $categoryService;

    public $search;

    public function __construct()
    {
        $categoryService = new CategoryService();
        $this->categoryService = $categoryService;
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
        return view('livewire.categories.data-list',[
            'datas'=> $this->categoryService->paginateData(20,$this->search ? $this->search : '')
        ]);
    }
}
