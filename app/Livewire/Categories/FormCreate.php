<?php

namespace App\Livewire\Categories;

use Livewire\Component;
use App\Services\CategoryService;

class FormCreate extends Component
{

    public $name;
    public $code;


    protected $categoryService;
    
    
    public function __construct()
    {
        
        $categoryService = new CategoryService();
        $this->categoryService = $categoryService;
    }
    public function mount()
    {
        
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|unique:categories,code',
        ]);

        $newData = $this->categoryService->createData($validatedData);

        if($newData){
            
            $this->name = "";
            $this->code = "";

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }

    public function render()
    {
        return view('livewire.categories.form-create');
    }
}
