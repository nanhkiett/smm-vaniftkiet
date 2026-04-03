<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Deposit extends Model
{
    use HasUlids;

    protected $fillable = [
        'user_id', 'amount', 'payment_method', 'transaction_id', 'status'
    ];
}
