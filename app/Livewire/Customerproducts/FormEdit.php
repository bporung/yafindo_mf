<?php

namespace App\Livewire\Customerproducts;

use Livewire\Component;
use App\Services\CustomerProductService;
use App\Services\ShipmentService;
use App\Services\ShipmentDetailService;
use Illuminate\Validation\Rule;
use Auth;
class FormEdit extends Component
{

    public $id;
    public $customer_id;
    public $code;
    public $target;
    public $product = [];
    public $lead_time;
    public $buffer_time;
    public $margin;
    public $margin_2;
    public $shipment;
    public $selectShipments;

    protected $customerProductService;
    protected $shipmentService;
    
    
    public function __construct()
    {
        $customerProductService = new CustomerProductService();
        $this->customerProductService = $customerProductService;
        $shipmentService = new ShipmentDetailService();
        $this->shipmentService = $shipmentService;
    }
    public function mount($customer_id,$id)
    {
        $this->id = $id;
        $this->selectShipments = $this->shipmentService->allData();
        $data = $this->customerProductService->findById($id);

        $this->product['name'] = $data->product->name;
        $this->product['code'] = $data->product->code;
        $this->product['brand'] = $data->product->brand->code.' - '.$data->product->brand->name;
        $this->product['category'] = $data->product->category->code.' - '.$data->product->category->name;

        $this->code = $data->code;
        $this->target = $data->target;
        $this->lead_time = $data->lead_time;
        $this->buffer_time = $data->buffer_time;
        $this->shipment = $data->shipmentdetail_id;
        $this->margin = $data->margin;
        $this->margin_2 = $data->margin_2;
    }

    public function submitForm(){
        
        $customer_id = $this->customer_id;
        // Validate the form data

        $user = Auth::user();
        if($user->can('manage customer')){
            $validatedData  = $this->validate([
                'target' => 'required|numeric',
                'lead_time' => 'required|numeric',
                'buffer_time' => 'required|numeric',
                'shipment' => 'required|numeric',
                'margin' => 'required|numeric',
                'margin_2' => 'required|numeric',
                'code' => [
                    'required',
                    Rule::unique('customerproducts')
                        ->where(function ($query) use ($customer_id) {
                            return $query->where('customer_id', $customer_id);
                        })
                        ->ignore($this->id),
                ],
            ]);

            $validatedData['shipmentdetail_id'] = $validatedData['shipment'];
            unset($validatedData['shipment']);
            $updatedData = $this->customerProductService->updateData($this->id,$validatedData);

            if($updatedData){

                $this->dispatch('alert-success', message: 'Form has been saved.');
            } else {
                $this->dispatch('alert-error', message: 'Form error , failed to save.');
            }

        }else{

        
        if($user->can('manage self customerproduct')){
            $validatedData  = $this->validate([
                'code' => [
                    'required',
                    Rule::unique('customerproducts')
                        ->where(function ($query) use ($customer_id) {
                            return $query->where('customer_id', $customer_id);
                        })
                        ->ignore($this->id),
                ],
            ]);

            $updatedData = $this->customerProductService->updateData($this->id,$validatedData);

            if($updatedData){
                $this->dispatch('alert-success', message: 'Form has been saved.');
            } else {
                $this->dispatch('alert-error', message: 'Form error , failed to save.');
            }

        }}

    }
    public function render()
    {
        return view('livewire.customerproducts.form-edit');
    }
}
