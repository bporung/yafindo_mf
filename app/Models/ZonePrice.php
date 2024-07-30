<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZonePrice extends Model
{
    use HasFactory;
    protected $table = 'zoneprices';
    protected $guarded = [];

    
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
