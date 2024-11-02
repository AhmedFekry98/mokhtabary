<?php

namespace App\Features\Chat\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MessageResource extends JsonResource
{
    /**
     * Get type of message if sent/resived
     *
     * @param int $senderId The id of sender
     * @return string sent/resived
     */
    protected static function type(int $senderIfd): string
    {
        return $senderIfd == Auth::id()
        ? 'sent'
        : 'resived';
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => static::type($this->sender_id),
            'sent_at' => $this->created_at->diffForHumans(),
            'content' => $this->content,
        ];
    }
}
