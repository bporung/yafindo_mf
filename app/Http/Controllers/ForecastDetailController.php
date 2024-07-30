<?php

namespace App\Http\Controllers;
use App\Models\ForecastDetail;

use Illuminate\Http\Request;

class ForecastDetailController extends Controller
{
    public function edit($forecast_id,$id)
    {
        $data = ForecastDetail::findOrFail($id);
        if(!$data){return "404";}

        return view('pages.forecastdetails.edit',['forecast_id'=>$forecast_id, 'id'=>$id]);
    }
}
