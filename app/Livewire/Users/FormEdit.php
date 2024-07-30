<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Services\RoleService;
use App\Services\UserService;

class FormEdit extends Component
{

    public $id;
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
    public function mount($id)
    {
        $this->id = $id;
        $data = $this->userService->findById($id);
        $this->name = $data->name;
        $this->email = $data->email;
        $this->role = $data->getRoleNames()[0];

        $this->selectRoles = $this->roleService->allData();
    }

    public function submitForm(){
        
        // Validate the form data
        $validatedData  = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->id,
            'password' => 'nullable|min:8',  
            'role' => 'required',  
        ]);

        $updatedData = $this->userService->updateData($this->id,$validatedData);
        $updatedData->syncRoles([$this->role]);


        if($updatedData){

            $this->dispatch('alert-success', message: 'Form has been saved.');
        } else {
            $this->dispatch('alert-error', message: 'Form error , failed to save.');
        }

    }
    public function render()
    {
        return view('livewire.users.form-edit');
    }
}
