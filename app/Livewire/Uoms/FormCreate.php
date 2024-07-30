<?php

namespace App\Livewire\Uoms;

use Livewire\Component;
use App\Services\UomService;

class FormCreate extends Component
{

    public $name;
    public $code;


    protected $uomService;
    
    
    public function __construct()
    {
        
        $uomService = new UomService();
        $this->uomService = $uomService;
    }
    public function mount()
    {
        
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|unique:uoms,code',
        ]);

        $newData = $this->uomService->createData($validatedData);

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
        return view('livewire.uoms.form-create');
    }
}
