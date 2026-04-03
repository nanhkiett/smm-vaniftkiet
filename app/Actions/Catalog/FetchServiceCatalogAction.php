<?php

namespace App\Actions\Catalog;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;

/**
 * Toàn bộ dịch vụ SMM đang hoạt động — tra cứu / autocomplete.
 */
class FetchServiceCatalogAction
{
    public function execute(): Collection
    {
        return Service::where('status', 1)->get();
    }
}
