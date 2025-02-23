<?php

namespace App\Features\CompanyProfile\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GovernorateCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'per_page'          => $this->collection->count(),
            'current_page'      => $this->currentPage() ?? null,
            'last_page'         => $this->lastPage(),
            'next_page_url'     => $this->nextPageUrl(),
            'items'             => GovernorateResource::collection($this->collection),
        ];
    }
}
