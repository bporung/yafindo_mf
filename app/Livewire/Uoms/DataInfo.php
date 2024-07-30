<?php

namespace App\Livewire\Uoms;

use Livewire\Component;
use App\Services\UomService;

class DataInfo extends Component
{
    protected $uomService;
    public $id;


    public function __construct()
    {
        $uomService = new UomService();
        $this->uomService = $uomService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function deleteData()
    {
        $del = $this->uomService->deleteData($this->id);
        if($del){
            $this->dispatch('alert-info', message: 'Data has been deleted.');
            sleep(3);
            return redirect()->to('/uoms');
        }else{
            $this->dispatch('alert-error', message: 'Data couldnt be deleted.');
        }
    }
    public function render()
    {
        return view('livewire.uoms.data-info',[
            'data' => $this->uomService->findById($this->id),
        ]);
    }
}
