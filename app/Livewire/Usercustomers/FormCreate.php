<?php

namespace App\Livewire\Usercustomers;

use Livewire\Component;
use App\Services\UserCustomerService;
use App\Models\Customer;
use App\Models\UserCustomer;

class FormCreate extends Component
{
    public $user_id;
    public $customer_id;
    public $customer;
    public $selectCustomers = [];

    protected $userCustomerService;
    
    
    public function __construct()
    {
        $userCustomerService = new UserCustomerService();
        $this->userCustomerService = $userCustomerService;
    }
    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->loadData();
    }

    public function loadData()
    {
        $user_id = $this->user_id;

        $alreadySelecteds = UserCustomer::where('user_id',$user_id)->pluck('customer_id')->toArray();
        $unselectedCustomers = Customer::whereNotIn('id', $alreadySelecteds)->get();

        $this->selectCustomers = $unselectedCustomers;
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'user_id' => 'required|numeric',
            'customer' => 'required|numeric',
        ]);

        $validatedData['customer_id'] = $validatedData['customer'];
        
        unset($validatedData['customer']);
        $createdData = $this->userCustomerService->createData($validatedData);

        if($createdData){
            $this->customer_id = "";
            $this->loadData();
            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }
    public function render()
    {
        return view('livewire.usercustomers.form-create');
    }
}
