<?php

namespace App\Http\Controllers;
use App\Services\UserService;
use App\Services\UserCustomerService;

use Illuminate\Http\Request;

class UserCustomerController extends Controller
{
    public function create($user_id)
    {
        $dataService = new UserService();
        $data = $dataService->findById($user_id);
        if(!$data){return "404";}

        return view('pages.usercustomers.create',['user_id'=>$user_id]);
    }
}
