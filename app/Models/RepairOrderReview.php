<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RepairOrderReview extends Model
{
    protected $fillable = [
        'content', 'user_id', 'repair_order_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function repairOrder()
    {
        return $this->belongsTo(RepairOrder::class);
    }

}
