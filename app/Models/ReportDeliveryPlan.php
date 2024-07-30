<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportDeliveryPlan extends Model
{
    use HasFactory;
    protected $table = 'reportdeliveryplans';
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
    public function details()
    {
        return $this->hasMany(ReportDeliveryPlanDetail::class,'reportdeliveryplan_id');
    }
}
