<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id'; // Specify the primary key column

    protected $fillable = ['order_id', 'user_id', 'order_status', 'total_price', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}   