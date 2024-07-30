<?php

namespace App\Livewire\Shipments;

use Livewire\Component;
use App\Services\ShipmentService;

class FormCreate extends Component
{

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
    public function mount()
    {
        
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'max_volume' => 'required|numeric',
            'max_weight' => 'required|numeric',
        ]);

        $newData = $this->shipmentService->createData($validatedData);

        if($newData){
            
            $this->name = "";
            $this->description = "";
            $this->max_volume = "";
            $this->max_weight = "";
        

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }

    public function render()
    {
        return view('livewire.shipments.form-create');
    }
}
