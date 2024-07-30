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
    public function deleteData()
    {
        $del = $this->brandService->deleteData($this->id);
        if($del){
            $this->dispatch('alert-info', message: 'Data has been deleted.');
            sleep(3);
            return redirect()->to('/brands');
        }else{
            $this->dispatch('alert-error', message: 'Data couldnt be deleted.');
        }
    }
    public function render()
    {
        return view('livewire.brands.data-info',[
            'data' => $this->brandService->findById($this->id),
        ]);
    }
}
