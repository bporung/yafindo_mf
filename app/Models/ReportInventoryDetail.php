<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportInventoryDetail extends Model
{
    use HasFactory;
    protected $table = 'reportinventorydetails';
    protected $guarded = [];

    
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function c_uom()
    {
        return $this->belongsTo(Uom::class,'conversion_uom');
    }
    public function reportinventory()
    {
        return $this->belongsTo(ReportInventory::class,'reportinventory_id');
    }
}
