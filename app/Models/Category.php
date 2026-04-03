<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasUlids;

    protected $fillable = ['platform_id', 'name', 'slug', 'description', 'status', 'sort'];

    // Quan hệ cha
    public function platform(): BelongsTo
    {
        return $this->belongsTo(Platform::class);
    }

    // Quan hệ 1-N với Service
    public function services(): HasMany
    {
        return $this->hasMany(Service::class)->orderBy('sort', 'asc');
    }
}
