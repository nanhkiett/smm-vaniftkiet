<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Order extends Model
{
    use HasUlids;

    protected $fillable = [
        'user_id', 'service_id', 'quantity', 'charge', 'start_count', 'remains', 'status', 'api_order_id', 'provider_id'
    ];
}
