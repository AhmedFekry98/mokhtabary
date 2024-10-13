<?php

namespace App\Features\Lab\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LabTestCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        $labInfo = $this->additional['lab_info']->labDetail()->first();
        if ($labInfo) {
            $labInfo = $labInfo->makeHidden(['id', 'parent_id']);
        }
        $labInfo['email'] = $this->additional['lab_info']['email'];
        $labInfo['phone'] = $this->additional['lab_info']['phone'];

        return [
            'per_page'          => $this->collection->count(),
            'current_page'      => $this->currentPage() ?? null,
            'last_page'         => $this->lastPage(),
            'next_page_url'     => $this->nextPageUrl(),
            'lab_info'          => $labInfo,
            'items'             => TestResource::collection($this->collection),
        ];
    }
}

