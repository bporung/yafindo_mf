<?php

namespace App\Http\Controllers;
use App\Services\ReportSaleService;

use Illuminate\Http\Request;

class ReportSalesController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.reportsales.index',[]);
    }
    public function show($id)
    {
        $dataService = new ReportSaleService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.reportsales.show',[
            'id' => $id
        ]);
    }
    public function create()
    {
        return view('pages.reportsales.create',[]);
    }
}
