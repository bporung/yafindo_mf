<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDeliveryPlanDetail extends Model
{
    use HasFactory;
    protected $table = 'reportdeliveryplandetails';
    protected $guarded = [];

    
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function c_uom()
    {
        return $this->belongsTo(Uom::class,'conversion_uom');
    }
    public function reportdeliveryplan()
    {
        return $this->belongsTo(ReportDeliveryPlan::class,'reportdeliveryplan_id');
    }
}
