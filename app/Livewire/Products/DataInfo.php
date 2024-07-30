<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Services\ProductService;

class DataInfo extends Component
{
    protected $productService;
    public $id;


    public function __construct()
    {
        $productService = new ProductService();
        $this->productService = $productService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function deleteData()
    {
        $del = $this->productService->deleteData($this->id);
        if($del){
            $this->dispatch('alert-info', message: 'Data has been deleted.');
            sleep(3);
            return redirect()->to('/products');
        }else{
            $this->dispatch('alert-error', message: 'Data couldnt be deleted.');
        }
    }
    public function render()
    {
        return view('livewire.products.data-info',[
            'data' => $this->productService->findById($this->id),
        ]);
    }
}
