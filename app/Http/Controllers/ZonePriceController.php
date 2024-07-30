<?php

namespace App\Http\Controllers;
use App\Services\ZonePriceService;

use Illuminate\Http\Request;

class ZonePriceController extends Controller
{
    public function edit($zone_id,$id)
    {
        $dataService = new ZonePriceService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}

        return view('pages.zoneprices.edit',['zone_id'=>$zone_id, 'id'=>$id]);
    }
}
