<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmoShipment extends Model
{
    use HasFactory;
    protected $table = 'cmoshipments';
    protected $guarded = [];
    public function cmo()
    {
        return $this->belongsTo(Cmo::class,'cmo_id');
    }
    public function shipmentdetail()
    {
        return $this->belongsTo(ShipmentDetail::class,'shipmentdetail_id');
    }
}
