<?php

namespace App\Livewire\Customers;

use Livewire\Component;
use App\Services\CustomerService;
use App\Services\ShipmentDetailService as ShipmentService;
use App\Services\ZoneService;

class FormCreate extends Component
{

    public $name;
    public $code;
    public $address;
    public $description;
    public $lead_time;
    public $buffer_time;
    public $nickname;
    public $shipment;
    public $sell_zone;
    public $buy_zone;

    public $selectShipments;
    public $selectZones;


    protected $customerService;
    protected $shipmentService;
    protected $zoneService;
    
    
    public function __construct()
    {
        
        $customerService = new CustomerService();
        $this->customerService = $customerService;
        $shipmentService = new ShipmentService();
        $this->shipmentService = $shipmentService;
        $zoneService = new ZoneService();
        $this->zoneService = $zoneService;
    }
    public function mount()
    {
        $this->selectShipments = $this->shipmentService->allData();
        $this->selectZones = $this->zoneService->allData();
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|unique:brands,code',
            'description' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'lead_time' => 'required|numeric',
            'buffer_time' => 'required|numeric',
            'shipment' => 'required|numeric',
            'sell_zone' => 'required|numeric',
            'nickname' => 'required|string|max:125',
        ]);
        $validatedData['shipmentdetail_id'] = $validatedData['shipment'];
        unset($validatedData['shipment']);

        // $validatedData['buy_zone_id'] = $validatedData['buy_zone'];
        // unset($validatedData['buy_zone']);

        
        $validatedData['sell_zone_id'] = $validatedData['sell_zone'];
        unset($validatedData['sell_zone']);

        $newData = $this->customerService->createData($validatedData);

        if($newData){
            $this->name = "";
            $this->code = "";
            $this->address = "";
            $this->description = "";
            $this->lead_time = "";
            $this->buffer_time = "";
            $this->nickname = "";
            $this->shipment = "";
            $this->sell_zone = "";
            $this->buy_zone = "";

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }

    public function render()
    {
        return view('livewire.customers.form-create');
    }
}
