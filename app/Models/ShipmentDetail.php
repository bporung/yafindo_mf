<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipmentDetail extends Model
{
    use HasFactory;
    protected $table = 'shipmentdetails';
    protected $guarded = [];

    
    public function shipment()
    {
        return $this->belongsTo(Shipment::class,'shipment_id');
    }
    public function customers()
    {
        return $this->hasMany(Customer::class,'shipmentdetail_id');
    }
    public function customerproducts()
    {
        return $this->hasMany(CustomerProduct::class,'shipmentdetail_id');
    }
    public function forecastshipments()
    {
        return $this->hasMany(ForecastShipment::class,'shipmentdetail_id');
    }
    public function cmoshipments()
    {
        return $this->hasMany(CmoShipment::class,'shipmentdetail_id');
    }
    public function forecastdetails()
    {
        return $this->hasMany(ForecastDetail::class,'shipmentdetail_id');
    }
    public function cmodetails()
    {
        return $this->hasMany(CmoDetail::class,'shipmentdetail_id');
    }
}
