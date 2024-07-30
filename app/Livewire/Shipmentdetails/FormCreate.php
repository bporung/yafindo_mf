<?php

namespace App\Livewire\Shipmentdetails;

use Livewire\Component;
use App\Services\ShipmentDetailService;

class FormCreate extends Component
{
    public $shipment_id;
    public $name;
    public $origin;
    public $destination;
    public $price;

    protected $shipmentDetailService;
    
    
    public function __construct()
    {
        $shipmentDetailService = new ShipmentDetailService();
        $this->shipmentDetailService = $shipmentDetailService;
    }
    public function mount($shipment_id)
    {
        $this->shipment_id = $shipment_id;
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'shipment_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'price' => 'required|numeric',
        ]);

        $createdData = $this->shipmentDetailService->createData($validatedData);

        if($createdData){

            $this->name = "";
            $this->origin = "";
            $this->destination = "";
            $this->price = "";
            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }
    public function render()
    {
        return view('livewire.shipmentdetails.form-create');
    }
}
