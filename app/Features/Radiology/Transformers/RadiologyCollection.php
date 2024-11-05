<?php

namespace App\Features\Radiology\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RadiologyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $asPaginate = $request->has('asPaginate');

        return [
            'per_page'          => $this->collection->count(),
            'current_page'      => $asPaginate ? $this->currentPage() : null,
            'last_page'         => $asPaginate ? $this->lastPage() : null,
            'next_page_url'     => $asPaginate ? $this->nextPageUrl() : null,
            'items'             => RadiologyResource::collection($this->collection),
        ];
    }
}
