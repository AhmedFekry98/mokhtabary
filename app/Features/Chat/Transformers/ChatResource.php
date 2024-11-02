<?php

namespace App\Features\Chat\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
    /**
     * add messages collection with data
     *
     * @var bool
     */
    private static $withMessages = true;

    /**
     * IgnoerMessages from data.
     *
     * @return void
     */
    public static function withoutMessages()
    {
        self::$withMessages = true;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [
            'id'            => $this->id,
            'sender_id'     => $this->sender->id,
            'sender_name'   => $this->sender->name,
            'sender_avatar' => $this->sender->getFirstMediaUrl('users'),
            'created_at'    => $this->created_at->diffForHumans(),
        ];

        // ? add messages if neet it.
        if ($this->withMessages) {
            $data['messages'] = MessageResource::collection($this->messages);
        }

        return $data;
    }
}
