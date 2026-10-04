<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairOrder extends Model
{
    protected $fillable = [
        'user_id',
        'device_id',
        'description',
        'status',
        'client_name',
        'client_phone',
        'client_email',
        'final_price',
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
