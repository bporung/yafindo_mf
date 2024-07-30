<?php

namespace App\Livewire\Shipments;

use Livewire\Component;
use App\Services\ShipmentService;

class DataInfo extends Component
{
    protected $shipmentService;
    public $id;


    public function __construct()
    {
        $shipmentService = new ShipmentService();
        $this->shipmentService = $shipmentService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function deleteData()
    {
        $del = $this->shipmentService->deleteData($this->id);
        if($del){
            $this->dispatch('alert-info', message: 'Data has been deleted.');
            sleep(3);
            return redirect()->to('/shipments');
        }else{
            $this->dispatch('alert-error', message: 'Data couldnt be deleted.');
        }
    }
    public function render()
    {
        return view('livewire.shipments.data-info',[
            'data' => $this->shipmentService->findById($this->id),
        ]);
    }
}
