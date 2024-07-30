<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Services\RoleService;
use App\Services\UserService;

class FormCreate extends Component
{

    public $name;
    public $email;
    public $role;
    public $password;

    public $selectRoles;

    protected $roleService;
    protected $userService;
    
    
    public function __construct()
    {
        $roleService = new RoleService();
        $this->roleService = $roleService;

        
        $userService = new UserService();
        $this->userService = $userService;
    }
    public function mount()
    {
        $this->selectRoles = $this->roleService->allData();
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',  
            'role' => 'required',  
        ]);

        $newData = $this->userService->createData($validatedData);
        $newData->syncRoles([$this->role]);


        if($newData){
            
            $this->name = "";
            $this->email = "";
            $this->role = "";
            $this->password = "";

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }

    public function render()
    {
        return view('livewire.users.form-create');
    }
}
