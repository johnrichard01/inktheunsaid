<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply; // Add the Reply model
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // Like a comment
        public function likeComment(Request $request, $commentId)
    {
        try {
            $comment = Comment::findOrFail($commentId);
            $this->toggleLike($comment);

            return response()->json([
                'success' => true,
                'data' => [
                    'likesCount' => $comment->likes_count,
                    'isLiked' => $comment->isLiked,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error liking comment.', 'message' => $e->getMessage()], 500);
        }
    }


    // Like a reply
    public function likeReply(Request $request, $replyId)
    {
        try {
            $reply = Reply::findOrFail($replyId);
            $this->toggleLike($reply);

            return response()->json([
                'success' => true,
                'data' => [
                    'likesCount' => $reply->likes_count,
                    'isLiked' => $reply->isLiked,
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error liking reply.', 'message' => $e->getMessage()], 500);
        }
    }

    // Common method for toggling like
    private function toggleLike($entity)
    {
        $user = auth()->user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }

        // Check if the user has already liked the entity
        if ($entity->likes()->where('user_id', $user->id)->exists()) {
            // If already liked, detach like and decrement likes count
            $entity->likes()->where('user_id', $user->id)->delete();
            $entity->decrement('likes_count');
            $entity->isLiked = false;
        } else {
            // If not liked, create a new like and increment likes count
            $entity->likes()->create(['user_id' => $user->id]);
            $entity->increment('likes_count');
            $entity->isLiked = true;
        }
    }
}



