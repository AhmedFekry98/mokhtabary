<?php

namespace App\Features\Chat\Controllers;

use App\Features\Chat\Models\Chat;
use App\Features\Chat\Models\Message;
use Graphicode\Standard\Traits\ApiResponses;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    use ApiResponses;

    public function joinChat(Request $request)
    {
        $chat = Chat::firstOrCreate(['id' => $request->chat_id]);
        $chat->users()->syncWithoutDetaching([auth()->id()]);

        return response()->json(['status' => 'Joined Chat!']);
    }

    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => auth()->id(),
            'chat_id' => $request->chat_id,
            'content' => $request->content,
        ]);

        // broadcast(new NewMessage($message))->toOthers();

        return response()->json(['status' => 'Message Sent!']);
    }

    public function fetchMessages($chatId)
    {
        $messages = Message::where('chat_id', $chatId)->with('sender')->orderBy('created_at', 'asc')->get();
        return response()->json($messages);
    }

    public function fetchChatMembers($chatId)
    {
        $chat = Chat::findOrFail($chatId);
        return response()->json($chat->users);
    }
}
