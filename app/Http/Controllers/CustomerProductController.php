<?php

namespace App\Http\Controllers;
use App\Services\CustomerProductService;

use Illuminate\Http\Request;

class CustomerProductController extends Controller
{
    
    public function edit($customer_id,$id)
    {
        $dataService = new CustomerProductService();
        $data = $dataService->findById($id);
        if(!$data){return "404";}

        return view('pages.customerproducts.edit',['customer_id'=>$customer_id, 'id'=>$id]);
    }
}
