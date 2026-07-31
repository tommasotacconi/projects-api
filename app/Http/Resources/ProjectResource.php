<?php

namespace App\Http\Resources;

use App\Traits\HasTranslatableResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    use HasTranslatableResource;

    protected array $translatableFields = ['purpose', 'description'];

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->resolveResourceArray($request);

    }
}
