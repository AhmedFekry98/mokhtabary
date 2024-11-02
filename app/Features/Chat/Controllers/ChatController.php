<?php

namespace App\Features\Chat\Controllers;

use App\Features\Chat\Models\Chat;
use App\Features\Chat\Requests\StoreMessageRequest;
use App\Features\Chat\Transformers\ChatResource;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    use ApiResponses;

    public function chats()
    {
        $authId = Auth::id();

        $chats = Chat::whereHas('users', fn($q) => $q->whereUserId($authId))
            ->get();

            ChatResource::withoutMessages();

        return $this->okResponse(
            ChatResource::collection($chats),
            "Success API call"
        );
    }

    public function showChat($chatId)
    {
        $authId = Auth::id();

        $chat = Chat::whereId($chatId)
            ->with('messages')
            ->first();

        if (!$chat || !$chat->users()->whereUserId($authId)->exists()) {
            return $this->badResponse(null, "No chat with id '$chatId'");
        }

        return $this->okResponse(
            ChatResource::make($chat),
            "Success API call"
        );
    }

    public function storeMessage(StoreMessageRequest $request)
    {
        $authId = Auth::id();

        // ? GEt chat between users if exists.
        $chat = Chat::whereHas('users', fn($q) => $q->whereUserId($authId))
            ->whereHas('users', fn($q) => $q->whereUserId($request->to))
            ->first();

        // ? creaate new chat if no chat between them.
        if (!$chat) {
            $chat = Chat::create();
            $chat->users()->attach([$authId, $request->to]);
        }

        // ? attach message to chat
        $message = $chat->messages()->create([
            'sender_id' => $authId,
            'content' => $request->content,
        ]);

        // ? broadcast message to resiver user.
        // broadcast(new MessageSent($message));

        return $this->createdResponse(null, "Message sent successfuly");
    }
}
