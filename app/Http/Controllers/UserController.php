<?php

namespace App\Http\Controllers;
use App\Services\UserService;

use Illuminate\Http\Request;
use Auth;
class UserController extends Controller
{
    

    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.users.index',[]);
    }
    public function show($id)
    {
        $dataService = new UserService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.users.show',[
            'id' => $id
        ]);
    }
    public function create()
    {

        return view('pages.users.create',[]);
    }
    public function edit($id)
    {
        $dataService = new UserService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        
        return view('pages.users.edit',[    
            'id' => $id
        ]);
    }

    public function profile()
    {
        return view('pages.users.profile',[    
            'id' => Auth::user()->id
        ]);
    }
    public function changepassword()
    {
        return view('pages.users.changepassword',[    
            'id' => Auth::user()->id
        ]);
    }
}
