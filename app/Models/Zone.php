<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $guarded = [];

    
    
    public function zoneprices()
    {
        return $this->hasMany(ZonePrice::class,'zone_id');
    }
    public function sellcustomers()
    {
        return $this->hasMany(Customer::class,'sell_zone_id');
    }
    public function buycustomers()
    {
        return $this->hasMany(Customer::class,'buy_zone_id');
    }
}
