<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Services\UserService;

class FormChangePassword extends Component
{

    public $id;
    public $password;
    public $password_confirmation;

    protected $userService;
    
    
    public function __construct()
    {
        
        $userService = new UserService();
        $this->userService = $userService;
    }
    public function mount($id)
    {
        $this->id = $id;
        $data = $this->userService->findById($id);
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'password' => 'required|min:8|confirmed',  
        ]);

        $updatedData = $this->userService->updateData($this->id,$validatedData);

        if($updatedData){

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }
    public function render()
    {
        return view('livewire.users.form-change-password');
    }
}
