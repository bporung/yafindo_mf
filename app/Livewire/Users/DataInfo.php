<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Services\UserService;
use App\Models\UserCustomer;
use Auth;
class DataInfo extends Component
{
    protected $userService;
    public $id;


    public function __construct()
    {
        $userService = new UserService();
        $this->userService = $userService;
    }
    public function mount($id)
    {
        $this->id = $id;

    }
    public function setInActiveData()
    {
        if(Auth::user()->id == $this->id){
            $this->dispatch('alert-info', message: 'You Couldnt Deactivate Your Account.');
            return;
        }

        $data = $this->userService->findById($this->id);
        $data->isActive = '0';
        $data->save();
        $this->dispatch('alert-success', message: 'User Has Been DeActivated.');

    }
    public function setActiveData()
    {
        $data = $this->userService->findById($this->id);
        $data->isActive = '1';
        $data->save();
        $this->dispatch('alert-success', message: 'User Has Been Activated.');

    }

    public function unsetCustomer($usercustomer_id){
        $uc = UserCustomer::findOrFail($usercustomer_id);

        if($uc){
            $uc->delete();
            $this->dispatch('alert-success', message: 'User Customer Has been Deleted.');
        }else{
            $this->dispatch('alert-warning', message: 'User Customer Not Found.');

        }

    }
    public function render()
    {
        return view('livewire.users.data-info',[
            'data' => $this->userService->findById($this->id),
        ]);
    }
}
