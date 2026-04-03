<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Service extends Model
{
    use HasUlids;

    protected $fillable = [
        'category_id', 'name', 'description', 'price', 'min', 'max', 
        'api_provider_id', 'api_service_id', 'status', 'sort'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'min' => 'integer',
        'max' => 'integer',
        'status' => 'integer',
    ];

    // Quan hệ cha
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
