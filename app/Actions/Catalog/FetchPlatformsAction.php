<?php

namespace App\Actions\Catalog;

use App\Models\Platform;
use Illuminate\Database\Eloquent\Collection;

/**
 * Lấy danh sách nền tảng (social) đang bán trên panel — dùng cho bước chọn dịch vụ.
 */
class FetchPlatformsAction
{
    public function execute(): Collection
    {
        return Platform::where('status', 1)->orderBy('sort', 'asc')->get();
    }
}
