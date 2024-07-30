<?php

namespace App\Http\Controllers;

use App\Services\ZoneService;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.zones.index',[]);
    }
    public function show($id)
    {
        $dataService = new ZoneService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}

        return view('pages.zones.show',[
            'id' => $id
        ]);
    }
    public function create()
    {

        return view('pages.zones.create',[]);
    }
    public function edit($id)
    {
        $dataService = new zoneservice();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.zones.edit',[    
            'id' => $id
        ]);
    }
}
