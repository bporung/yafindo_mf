<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Services\CategoryService;

class FormEdit extends Component
{

    public $id;
    public $name;
    public $code;

    protected $categoryService;
    
    
    public function __construct()
    {
        $categoryService = new CategoryService();
        $this->categoryService = $categoryService;
    }
    public function mount($id)
    {
        $this->id = $id;
        $data = $this->categoryService->findById($id);
        $this->name = $data->name;
        $this->code = $data->code;
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|unique:categories,code,' . $this->id,
        ]);

        $updatedData = $this->categoryService->updateData($this->id,$validatedData);

        if($updatedData){

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }
    public function render()
    {
        return view('livewire.categories.form-edit');
    }
}
