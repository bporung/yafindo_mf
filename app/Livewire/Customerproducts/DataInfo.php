<?php

namespace App\Livewire\Brands;

use Livewire\Component;
use App\Services\BrandService;

class DataInfo extends Component
{
    protected $brandService;
    public $id;


    public function __construct()
    {
        $brandService = new BrandService();
        $this->brandService = $brandService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function render()
    {
        return view('livewire.brands.data-info',[
            'data' => $this->brandService->findById($this->id),
        ]);
    }
}
