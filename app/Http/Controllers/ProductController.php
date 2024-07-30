<?php

namespace App\Http\Controllers;
use App\Services\ProductService;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.products.index',[]);
    }
    public function show($id)
    {
        $dataService = new ProductService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.products.show',[
            'id' => $id
        ]);
    }
    public function create()
    {

        return view('pages.products.create',[]);
    }
    public function edit($id)
    {
        $dataService = new ProductService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.products.edit',[    
            'id' => $id
        ]);
    }
}
