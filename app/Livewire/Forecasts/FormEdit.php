<?php

namespace App\Livewire\Forecasts;

use Livewire\Component;
use App\Services\BrandService;

class FormEdit extends Component
{

    public $id;
    public $name;
    public $code;

    protected $brandService;
    
    
    public function __construct()
    {
        $brandService = new BrandService();
        $this->brandService = $brandService;
    }
    public function mount($id)
    {
        $this->id = $id;
        $data = $this->brandService->findById($id);
        $this->name = $data->name;
        $this->code = $data->code;
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|unique:brands,code,' . $this->id,
        ]);

        $updatedData = $this->brandService->updateData($this->id,$validatedData);

        if($updatedData){

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }
    public function render()
    {
        return view('livewire.brands.form-edit');
    }
}
