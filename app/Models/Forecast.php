<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'cut_off_date' => 'date',
    ];
    public function details()
    {
        return $this->hasMany(ForecastDetail::class,'forecast_id');
    }
    public function shipments()
    {
        return $this->hasMany(ForecastShipment::class,'forecast_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
