<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'type',
        'brand',
        'model',
        'problem_description',
    ];
    public function repairOrders()
    {
        return $this->hasMany(RepairOrder::class);
    }
}
