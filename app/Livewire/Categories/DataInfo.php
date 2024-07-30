<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Services\CategoryService;

class DataInfo extends Component
{
    protected $categoryService;
    public $id;


    public function __construct()
    {
        $categoryService = new CategoryService();
        $this->categoryService = $categoryService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function deleteData()
    {
        $del = $this->categoryService->deleteData($this->id);
        if($del){
            $this->dispatch('alert-info', message: 'Data has been deleted.');
            sleep(3);
            return redirect()->to('/categories');
        }else{
            $this->dispatch('alert-error', message: 'Data couldnt be deleted.');
        }
    }
    public function render()
    {
        return view('livewire.categories.data-info',[
            'data' => $this->categoryService->findById($this->id),
        ]);
    }
}
