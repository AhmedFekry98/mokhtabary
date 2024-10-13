<?php

namespace App\Features\Radiology\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class RadiologyxRayCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $radiologyInfo = $this->additional['radiology_info']->radiologyDetail()->first();
        if ($radiologyInfo) {
            $radiologyInfo = $radiologyInfo->makeHidden(['id', 'parent_id']);
        }

        $radiologyInfo['email'] = $this->additional['radiology_info']['email'];
        $radiologyInfo['phone'] = $this->additional['radiology_info']['phone'];

        return [
            'per_page'          => $this->collection->count(),
            'current_page'      => $this->currentPage() ?? null,
            'last_page'         => $this->lastPage(),
            'next_page_url'     => $this->nextPageUrl(),
            'radiology_info'    => $radiologyInfo,
            'items'             => XRayResource::collection($this->collection),
        ];
    }
}
