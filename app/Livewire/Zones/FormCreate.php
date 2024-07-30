<?php

namespace App\Livewire\Zones;

use Livewire\Component;
use App\Services\ZoneService;

class FormCreate extends Component
{

    public $name;
    public $code;
    public $type;

    protected $zoneService;
    
    
    public function __construct()
    {
        
        $zoneService = new ZoneService();
        $this->zoneService = $zoneService;
    }
    public function mount()
    {
        
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|unique:zones,code',
        ]);

        $newData = $this->zoneService->createData($validatedData);

        if($newData){
            
            $this->name = "";
            $this->code = "";
            $this->type = "";

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }

    public function render()
    {
        return view('livewire.zones.form-create');
    }
}
