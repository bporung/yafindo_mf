<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportSale extends Model
{
    use HasFactory;
    protected $table = 'reportsales';
    protected $guarded = [];

    
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function details()
    {
        return $this->hasMany(ReportSaleDetail::class,'reportsale_id');
    }
}
