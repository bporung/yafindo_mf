<?php

namespace App\Http\Controllers;
use App\Services\ShipmentService;


use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.shipments.index',[]);
    }
    public function show($id)
    {
        $dataService = new ShipmentService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}

        return view('pages.shipments.show',[
            'id' => $id
        ]);
    }
    public function create()
    {

        return view('pages.shipments.create',[]);
    }
    public function edit($id)
    {
        $dataService = new ShipmentService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.shipments.edit',[    
            'id' => $id
        ]);
    }
}
