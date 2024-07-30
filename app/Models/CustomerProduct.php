<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProduct extends Model
{
    use HasFactory;
    protected $table = 'customerproducts';
    protected $guarded = [];
    protected $casts = [
        'last_updated_stock_at' => 'datetime',
    ];
    
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function shipmentdetail()
    {
        return $this->belongsTo(ShipmentDetail::class,'shipmentdetail_id');
    }
}
