<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uom extends Model
{
    use HasFactory;
    protected $guarded = [];

    
    public function products_first()
    {
        return $this->hasMany(Product::class,'first_uom_id');
    }
    public function products_secondary()
    {
        return $this->hasMany(Product::class,'secondary_uom_id');
    }
    public function products_third()
    {
        return $this->hasMany(Product::class,'third_uom_id');
    }
    public function products_fourth()
    {
        return $this->hasMany(Product::class,'fourth_uom_id');
    }
}
