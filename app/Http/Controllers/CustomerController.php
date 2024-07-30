<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CustomerService;

class CustomerController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.customers.index',[]);
    }
    public function show($id)
    {
        $dataService = new CustomerService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}

        return view('pages.customers.show',[
            'id' => $id
        ]);
    }
    public function create()
    {

        return view('pages.customers.create',[]);
    }
    public function edit($id)
    {
        $dataService = new CustomerService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.customers.edit',[    
            'id' => $id
        ]);
    }
}
