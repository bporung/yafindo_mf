<?php

namespace App\Livewire\Shipments;

use Livewire\Component;
use App\Services\ShipmentService;

class FormEdit extends Component
{

    public $id;
    public $name;
    public $description;
    public $max_volume;
    public $max_weight;

    protected $shipmentService;
    
    
    public function __construct()
    {
        $shipmentService = new ShipmentService();
        $this->shipmentService = $shipmentService;
    }
    public function mount($id)
    {
        $this->id = $id;
        $data = $this->shipmentService->findById($id);
        $this->name = $data->name;
        $this->description = $data->description;
        $this->max_volume = $data->max_volume;
        $this->max_weight = $data->max_weight;
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_volume' => 'required|numeric',
            'max_weight' => 'required|numeric',
        ]);

        $updatedData = $this->shipmentService->updateData($this->id,$validatedData);

        if($updatedData){

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }
    public function render()
    {
        return view('livewire.shipments.form-edit');
    }
}
