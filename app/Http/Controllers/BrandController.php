<?php

namespace App\Http\Controllers;
use App\Services\BrandService;

use Illuminate\Http\Request;
class BrandController extends Controller
{

    public function index()
    {
        return view('pages.brands.index',[]);
    }
    public function show($id)
    {
        $dataService = new BrandService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}

        return view('pages.brands.show',[
            'id' => $id
        ]);
    }
    public function create()
    {

        return view('pages.brands.create',[]);
    }
    public function edit($id)
    {
        $dataService = new BrandService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.brands.edit',[    
            'id' => $id
        ]);
    }
}
