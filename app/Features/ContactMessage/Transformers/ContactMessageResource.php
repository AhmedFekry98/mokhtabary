<?php

namespace App\Features\ContactMessage\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContactMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $data['file'] = $this->getFirstMediaUrl('file') ?? null;
        $data['read_at'] =  $data['read_at'] == null ?  "non-read" : "readed"  ;
        return $data;
    }
}
