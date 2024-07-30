<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Services\UomService;
class UomController extends Controller
{public function __construct()
    {
    }

    public function index()
    {
        return view('pages.uoms.index',[]);
    }
    public function show($id)
    {
        $dataService = new UomService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}

        return view('pages.uoms.show',[
            'id' => $id
        ]);
    }
    public function create()
    {

        return view('pages.uoms.create',[]);
    }
    public function edit($id)
    {
        $dataService = new UomService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.uoms.edit',[    
            'id' => $id
        ]);
    }
}
