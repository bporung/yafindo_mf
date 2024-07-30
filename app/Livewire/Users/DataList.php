<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Services\UserService;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class DataList extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $userService;

    public $search;

    public function __construct()
    {
        $userService = new UserService();
        $this->userService = $userService;
    }
    public function mount()
    {

    }
    
    public function runSearch()
    {
        $this->resetPage();
        $this->dispatch('alert-info', message: 'Data has been searched.');
    }

    public function render()
    {
        return view('livewire.users.data-list',[
            'datas'=> $this->userService->paginateData(20,$this->search ? $this->search : '')
        ]);
    }
}
