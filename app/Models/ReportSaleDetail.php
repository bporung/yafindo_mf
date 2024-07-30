<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSaleDetail extends Model
{
    use HasFactory;
    protected $table = 'reportsaledetails';
    protected $guarded = [];

    

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function reportsale()
    {
        return $this->belongsTo(ReportSale::class,'reportsale_id');
    }

    public function c_uom()
    {
        return $this->belongsTo(Uom::class,'conversion_uom');
    }
}
