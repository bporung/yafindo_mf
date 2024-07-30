<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmoDetail extends Model
{
    use HasFactory;
    protected $table = 'cmodetails';
    protected $guarded = [];
    public function cmo()
    {
        return $this->belongsTo(Cmo::class,'cmo_id');
    }
    public function shipmentdetail()
    {
        return $this->belongsTo(ShipmentDetail::class,'shipmentdetail_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function customerproduct()
    {
        return $this->belongsTo(CustomerProduct::class,'customerproduct_id');
    }
    public function uom()
    {
        return $this->belongsTo(Uom::class,'uom_id');
    }
}
