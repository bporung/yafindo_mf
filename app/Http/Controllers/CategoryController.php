<?php

namespace App\Http\Controllers;
use App\Services\CategoryService;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.categories.index',[]);
    }
    public function show($id)
    {
        $dataService = new CategoryService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}

        return view('pages.categories.show',[
            'id' => $id
        ]);
    }
    public function create()
    {

        return view('pages.categories.create',[]);
    }
    public function edit($id)
    {
        return view('pages.categories.edit',[    
            'id' => $id
        ]);
    }
}
