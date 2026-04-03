<?php

namespace App\Actions\Catalog;

use Illuminate\Database\Eloquent\Collection;

/**
 * @return list<array{id: string, text: string}>
 */
class BuildServicePickerOptionsAction
{
    public function execute(Collection $services): array
    {
        return $services->map(fn ($s) => [
            'id' => $s->id,
            'text' => '[' . $s->id . '] ' . $s->name . ' - (' . number_format((float) $s->price, 0, ',', '.') . 'đ / 1000)',
        ])->values()->all();
    }
}
