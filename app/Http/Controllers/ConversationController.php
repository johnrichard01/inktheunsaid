<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;

class ConversationController extends Controller
{
    public function show($userId)
    {
        // Get the authenticated user
        $user = auth()->user();

        // Get the other user based on the provided $userId
        $otherUser = User::find($userId);

        if (!$otherUser) {
            // Handle case when the user is not found
            return abort(404);
        }

        // Get messages between the authenticated user and the other user
        $messages = Message::where(function ($query) use ($user, $otherUser) {
            $query->where('sender_id', $user->id)
                ->where('recipient_id', $otherUser->id);
        })->orWhere(function ($query) use ($user, $otherUser) {
            $query->where('sender_id', $otherUser->id)
                ->where('recipient_id', $user->id);
        })->orderBy('created_at', 'asc')->get();

        return view('conversations.show', compact('user', 'otherUser', 'messages'));
    }
}
