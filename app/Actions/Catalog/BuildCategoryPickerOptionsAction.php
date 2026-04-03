<?php

namespace App\Actions\Catalog;

use Illuminate\Database\Eloquent\Collection;

/**
 * Payload {id, text} cho picker (Select2 / đồng bộ Livewire–JS).
 *
 * @return list<array{id: string, text: string}>
 */
class BuildCategoryPickerOptionsAction
{
    public function execute(Collection $categories): array
    {
        return $categories->map(fn ($c) => [
            'id' => $c->id,
            'text' => $c->name,
        ])->values()->all();
    }
}
