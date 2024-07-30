<?php

namespace App\Livewire\Zones;

use Livewire\Component;
use App\Services\ZoneService;

class DataInfo extends Component
{
    protected $zoneService;
    public $id;


    public function __construct()
    {
        $zoneService = new ZoneService();
        $this->zoneService = $zoneService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function deleteData()
    {
        $del = $this->zoneService->deleteData($this->id);
        if($del){
            $this->dispatch('alert-info', message: 'Data has been deleted.');
            sleep(3);
            return redirect()->to('/zones');
        }else{
            $this->dispatch('alert-error', message: 'Data couldnt be deleted.');
        }
    }
    public function render()
    {
        return view('livewire.zones.data-info',[
            'data' => $this->zoneService->findById($this->id),
        ]);
    }
}
