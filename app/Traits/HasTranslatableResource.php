<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

trait HasTranslatableResource
{
    protected function resolveResourceArray(Request $request): array
    {
        $fields = $this->translatableFields ?? [];

        $ownAttributes = array_diff_key(
            $this->resource->toArray(),
            array_flip($fields)
        );

        $perFieldTranslations = collect($fields)
        ->mapWithKeys(function ($field) {
            return [$field => $this->translations
              ->mapWithKeys(fn ($t) => [$t->locale => $t->{$field}])];
        })->toArray();

        return array_merge($ownAttributes, array_filter($perFieldTranslations, fn ($v) => $v !== []));
    }
}
