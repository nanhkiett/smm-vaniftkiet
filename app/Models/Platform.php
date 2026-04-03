<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platform extends Model
{
    use HasUlids;

    protected $fillable = ['name', 'slug', 'icon', 'status', 'sort'];

    // Quan hệ 1-N với Category
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class)->orderBy('sort', 'asc');
    }
}
