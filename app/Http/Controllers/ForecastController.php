<?php

namespace App\Http\Controllers;
use App\Services\ForecastService;

use Illuminate\Http\Request;

class ForecastController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        return view('pages.forecasts.index',[]);
    }
    public function show($id)
    {
        $dataService = new ForecastService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}
        return view('pages.forecasts.show',[
            'id' => $id
        ]);
    }
    public function create()
    {
        return view('pages.forecasts.create',[]);
    }
}
