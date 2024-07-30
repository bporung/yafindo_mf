<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_id');
    }
    public function first_uom()
    {
        return $this->belongsTo(Uom::class,'first_uom_id');
    }
    public function secondary_uom()
    {
        return $this->belongsTo(Uom::class,'secondary_uom_id');
    }
    public function third_uom()
    {
        return $this->belongsTo(Uom::class,'third_uom_id');
    }
    public function fourth_uom()
    {
        return $this->belongsTo(Uom::class,'fourth_uom_id');
    }

    
    public function customerproducts()
    {
        return $this->hasMany(CustomerProduct::class,'product_id');
    }
    public function zoneprices()
    {
        return $this->hasMany(ZonePrice::class,'product_id');
    }

    public function forecastdetails()
    {
        return $this->hasMany(ForecastDetail::class,'product_id');
    }
    public function cmodetails()
    {
        return $this->hasMany(CmoDetail::class,'product_id');
    }
    public function reportinventorydetails()
    {
        return $this->hasMany(ReportInventoryDetail::class,'product_id');
    }
    public function reportsaledetails()
    {
        return $this->hasMany(ReportSaleDetail::class,'product_id');
    }
    public function reportdeliveryplandetails()
    {
        return $this->hasMany(ReportDeliveryPlanDetail::class,'product_id');
    }
}
