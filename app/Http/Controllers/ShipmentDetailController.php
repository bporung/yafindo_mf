<?php

namespace App\Http\Controllers;
use App\Services\ShipmentDetailService;
use App\Services\ShipmentService;

use Illuminate\Http\Request;

class ShipmentDetailController extends Controller
{
    public function create($shipment_id)
    {
        $dataService = new ShipmentService();
        $data = $dataService->findById($shipment_id);
        if(!$data){return "404";}

        return view('pages.shipmentdetails.create',['shipment_id'=>$shipment_id]);
    }
    public function edit($shipment_id,$id)
    {
        $dataService = new ShipmentDetailService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}

        return view('pages.shipmentdetails.edit',['shipment_id'=>$shipment_id, 'id'=>$id]);
    }
}
