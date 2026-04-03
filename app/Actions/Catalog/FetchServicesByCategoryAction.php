<?php

namespace App\Actions\Catalog;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

/**
 * Dịch vụ (rate / 1000) trong một category.
 */
class FetchServicesByCategoryAction
{
    public function execute(string $categoryId): Collection
    {
        return Service::where('category_id', $categoryId)
            ->where('status', 1)
            ->orderBy('sort', 'asc')
            ->get();
    }
}
