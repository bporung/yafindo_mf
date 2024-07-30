<?php

namespace App\Livewire\Zones;

use Livewire\Component;
use App\Services\ZoneService;

class FormEdit extends Component
{

    public $id;
    public $name;
    public $code;
    public $type;

    protected $zoneService;
    
    
    public function __construct()
    {
        $zoneService = new ZoneService();
        $this->zoneService = $zoneService;
    }
    public function mount($id)
    {
        $this->id = $id;
        $data = $this->zoneService->findById($id);
        $this->name = $data->name;
        $this->code = $data->code;
        $this->type = $data->type;
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|unique:zones,code,' . $this->id,
        ]);

        $updatedData = $this->zoneService->updateData($this->id,$validatedData);

        if($updatedData){

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }
    public function render()
    {
        return view('livewire.zones.form-edit');
    }
}
