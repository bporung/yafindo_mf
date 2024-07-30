<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForecastShipment extends Model
{
    use HasFactory;
    protected $table = 'forecastshipments';
    protected $guarded = [];
    public function forecast()
    {
        return $this->belongsTo(Forecast::class,'forecast_id');
    }
    public function shipmentdetail()
    {
        return $this->belongsTo(ShipmentDetail::class,'shipmentdetail_id');
    }
}
