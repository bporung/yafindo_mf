<?php

namespace App\Livewire\Zoneprices;

use Livewire\Component;
use App\Services\ZonePriceService;

class FormEdit extends Component
{

    public $id;
    public $zone_id;
    public $product_id;
    public $price_inc;
    public $price_exc;

    protected $zonePriceService;
    
    
    public function __construct()
    {
        $zonePriceService = new ZonePriceService();
        $this->zonePriceService = $zonePriceService;
    }
    public function mount($id)
    {
        $this->id = $id;
        $data = $this->zonePriceService->findById($id);
        $this->zone_id = $data->zone_id;
        $this->product_id = $data->product_id;
        $this->price_inc = $data->price_inc;
        $this->price_exc = $data->price_exc;
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'zone_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'price_inc' => 'required|numeric',
            'price_exc' => 'required|numeric',
        ]);

        $updatedData = $this->zonePriceService->updateData($this->id,$validatedData);

        if($updatedData){

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }
    public function render()
    {
        return view('livewire.zoneprices.form-edit');
    }
}
