<?php

namespace App\Http\Controllers;
use App\Services\ReportInventoryService;

use Illuminate\Http\Request;

class ReportInventoryController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.reportinventories.index',[]);
    }
    public function show($id)
    {
        $dataService = new ReportInventoryService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.reportinventories.show',[
            'id' => $id
        ]);
    }
    public function create()
    {
        return view('pages.reportinventories.create',[]);
    }
}
