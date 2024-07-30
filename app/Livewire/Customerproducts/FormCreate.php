<?php

namespace App\Livewire\Brands;

use Livewire\Component;
use App\Services\BrandService;

class FormCreate extends Component
{

    public $name;
    public $code;


    protected $brandService;
    
    
    public function __construct()
    {
        
        $brandService = new BrandService();
        $this->brandService = $brandService;
    }
    public function mount()
    {
        
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|unique:brands,code',
        ]);

        $newData = $this->brandService->createData($validatedData);

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
        return view('livewire.brands.form-create');
    }
}
