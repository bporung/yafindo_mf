<?php

namespace App\Livewire\Customers;

use Livewire\Component;
use App\Services\CustomerService;
use App\Models\CustomerProduct;

class DataInfo extends Component
{
    protected $customerService;
    protected $customerProductService;
    public $id;


    public function __construct()
    {
        $customerService = new CustomerService();
        $this->customerService = $customerService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function setProductStatus($id,$action)
    {
        $data = CustomerProduct::findOrFail($id);

        if($action == 'active'){
            $data->isActive = '1';
        }
        if($action == 'inactive'){
            $data->isActive = '0';
        }
        $data->save();
        
        $this->dispatch('alert-success', message: 'Status has been changed.');

    }
    public function deleteData()
    {
        $del = $this->customerService->deleteData($this->id);
        if($del){
            $this->dispatch('alert-info', message: 'Data has been deleted.');
            sleep(3);
            return redirect()->to('/customers');
        }else{
            $this->dispatch('alert-error', message: 'Data couldnt be deleted.');
        }
    }
    public function render()
    {
        return view('livewire.customers.data-info',[
            'data' => $this->customerService->findById($this->id),
        ]);
    }
}
