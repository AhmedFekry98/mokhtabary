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
            $radiologyInfo = $radiologyInfo->makeHidden(['id', 'parent_id','country_id','governorate_id','city_id']);
        }

        $radiologyInfo['email']             = $this->additional['radiology_info']['email'];
        $radiologyInfo['phone']             = $this->additional['radiology_info']['phone'];
        $radiologyInfo['img']               = $this->additional['radiology_info']->getFirstMediaUrl('users');
        $radiologyInfo['country_info']      = $this->additional['radiology_info']->radiologyDetail->country()->first(['id','name_ar','name_en']);
        $radiologyInfo['governorate_info']  = $this->additional['radiology_info']->radiologyDetail->governorate()->first(['id','name_ar','name_en']);
        $radiologyInfo['city_info']         = $this->additional['radiology_info']->radiologyDetail->governorate()->first(['id','name_ar','name_en']);

        return [
            'per_page'          => $this->collection->count(),
            'current_page'      => $this->currentPage() ?? null,
            'last_page'         => $this->lastPage(),
            'next_page_url'     => $this->nextPageUrl(),
            'info'              => $radiologyInfo,
            'items'             => XRayResource::collection($this->collection),
        ];
    }
}

