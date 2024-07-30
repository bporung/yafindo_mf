<?php

namespace App\Http\Controllers;
use App\Services\ReportDeliveryPlanService;

use Illuminate\Http\Request;

class ReportDeliveryPlanController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.reportdeliveryplans.index',[]);
    }
    public function show($id)
    {
        $dataService = new ReportDeliveryPlanService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.reportdeliveryplans.show',[
            'id' => $id
        ]);
    }
    public function create()
    {
        return view('pages.reportdeliveryplans.create',[]);
    }
}
