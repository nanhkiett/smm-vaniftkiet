<?php

namespace App\Actions\Catalog;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

/**
 * Phân loại dịch vụ theo nền tảng (TikTok, Facebook, …).
 */
class FetchCategoriesByPlatformAction
{
    public function execute(string $platformId): Collection
    {
        return Category::where('platform_id', $platformId)
            ->where('status', 1)
            ->orderBy('sort', 'asc')
            ->get();
    }
}
