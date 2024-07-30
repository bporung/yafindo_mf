<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportSaleCheckController extends Controller
{
    public function __construct()
    {
    }

    public function sales()
    {
        return view('pages.reportsalechecks.sales',[]);
    }
}
