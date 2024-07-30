<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cmo extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function details()
    {
        return $this->hasMany(CmoDetail::class,'cmo_id');
    }
    public function shipments()
    {
        return $this->hasMany(CmoShipment::class,'cmo_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function forecast()
    {
        return $this->belongsTo(Forecast::class,'forecast_id');
    }
    public function cmostatus()
    {
        return $this->belongsTo(CmoStatus::class,'status');
    }
    public function approved()
    {
        return $this->belongsTo(User::class,'approved_by');
    }
    public function deliveryupdated()
    {
        return $this->belongsTo(User::class,'deliveryupdated_by');
    }
    public function received()
    {
        return $this->belongsTo(User::class,'received_by');
    }
}
