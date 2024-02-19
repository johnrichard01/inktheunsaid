<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyController extends Controller
{
    public function create(Request $request, $commentId)
    {
        // Validate the request
        $request->validate([
            'reply_text' => 'required|string',
        ]);

        // Create a new reply
        $reply = new Reply();
        $reply->comment_id = $commentId;
        $reply->user_id = Auth::id(); // Assuming you have user authentication
        $reply->reply_text = $request->input('reply_text');
        $reply->save();

        // Optionally, you may want to return the created reply as a response
        return response()->json(['reply' => $reply]);
    }

    public function update(Request $request, $replyId)
    {
        // Validate the request
        $request->validate([
            'reply_text' => 'required|string',
        ]);

        // Find the reply
        $reply = Reply::findOrFail($replyId);

        // Check if the authenticated user is the owner of the reply
        if (Auth::id() !== $reply->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Update the reply
        $reply->reply_text = $request->input('reply_text');
        $reply->save();

        // Optionally, you may want to return the updated reply as a response
        return response()->json(['reply' => $reply]);
    }

    public function destroy($replyId)
    {
        // Find the reply
        $reply = Reply::findOrFail($replyId);

        // Check if the authenticated user is the owner of the reply
        if (Auth::id() !== $reply->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Delete the reply
        $reply->delete();

        // Optionally, you may want to return a success message as a response
        return response()->json(['message' => 'Reply deleted successfully']);
    }
}

