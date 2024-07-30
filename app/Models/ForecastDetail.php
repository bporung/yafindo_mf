<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastDetail extends Model
{
    use HasFactory;
    protected $table = 'forecastdetails';
    protected $guarded = [];
    public function forecast()
    {
        return $this->belongsTo(Forecast::class,'forecast_id');
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
}
