<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportInventory extends Model
{
    use HasFactory;
    protected $table = 'reportinventories';
    protected $guarded = [];

    
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function details()
    {
        return $this->hasMany(ReportInventoryDetail::class,'reportinventory_id');
    }
}
