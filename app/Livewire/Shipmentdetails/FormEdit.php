<?php

namespace App\Livewire\Shipmentdetails;

use Livewire\Component;
use App\Services\ShipmentDetailService;

class FormEdit extends Component
{

    public $id;
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
    public function mount($id)
    {
        $this->id = $id;
        $data = $this->shipmentDetailService->findById($id);
        $this->shipment_id = $data->shipment_id;
        $this->name = $data->name;
        $this->origin = $data->origin;
        $this->destination = $data->destination;
        $this->price = $data->price;
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

        $updatedData = $this->shipmentDetailService->updateData($this->id,$validatedData);

        if($updatedData){

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }
    public function render()
    {
        return view('livewire.shipmentdetails.form-edit');
    }
}
