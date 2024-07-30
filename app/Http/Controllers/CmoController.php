<?php

namespace App\Http\Controllers;
use App\Services\CmoService;

use Illuminate\Http\Request;

class CmoController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.cmos.index',[]);
    }
    public function show($id)
    {
        $dataService = new CmoService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.cmos.show',[
            'id' => $id
        ]);
    }
    public function create()
    {
        return view('pages.cmos.create',[]);
    }
}
