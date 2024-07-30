<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];

    
    public function customerproducts()
    {
        return $this->hasMany(CustomerProduct::class,'customer_id');
    }
    public function shipmentdetail()
    {
        return $this->belongsTo(ShipmentDetail::class,'shipmentdetail_id');
    }
    public function sell_zone()
    {
        return $this->belongsTo(Zone::class,'sell_zone_id');
    }
    public function buy_zone()
    {
        return $this->belongsTo(Zone::class,'buy_zone_id');
    }

    public function usercustomers()
    {
        return $this->hasMany(UserCustomer::class,'customer_id');
    }
    
    public function cmos()
    {
        return $this->hasMany(Cmo::class,'customer_id');
    }
    public function reportsales()
    {
        return $this->hasMany(ReportSale::class,'customer_id');
    }
    public function reportinventories()
    {
        return $this->hasMany(ReportInventory::class,'customer_id');
    }
    public function reportdeliveryplans()
    {
        return $this->hasMany(ReportDeliveryPlan::class,'customer_id');
    }
}
