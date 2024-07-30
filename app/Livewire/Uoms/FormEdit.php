<?php

namespace App\Livewire\Uoms;

use Livewire\Component;
use App\Services\UomService;

class FormEdit extends Component
{

    public $id;
    public $name;
    public $code;

    protected $uomService;
    
    
    public function __construct()
    {
        $uomService = new UomService();
        $this->uomService = $uomService;
    }
    public function mount($id)
    {
        $this->id = $id;
        $data = $this->uomService->findById($id);
        $this->name = $data->name;
        $this->code = $data->code;
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|unique:uoms,code,' . $this->id,
        ]);

        $updatedData = $this->uomService->updateData($this->id,$validatedData);

        if($updatedData){

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }
    public function render()
    {
        return view('livewire.uoms.form-edit');
    }
}
