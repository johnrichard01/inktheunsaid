<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;
use App\Models\Comment;
use App\Models\Like;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function store(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // If not authenticated, redirect to login and preserve the intended URL
            return redirect()->route('login')->with('error', 'Please log in to leave a comment.');
        }

        // Validate the request
        $request->validate([
            'comment_text' => 'required',
            'blog_id' => 'required|exists:blogs,id',
        ]);

        // Create a new Comment model and save it to the database
        $comment = new Comment;
        $comment->blog_id = $request->input('blog_id');
        $comment->user_id = Auth::user()->id;
        $comment->comment_text = $request->input('comment_text');
        $comment->save();

        // Notify the user about the new comment
        $this->notificationService->createNotification(Auth::user(), $comment, 'comment', 'New comment on your post.');

        // Redirect back or to the blog post page
        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    public function storeReply(Request $request, Comment $comment)
    {
        try {
            $request->validate([
                'reply_text' => 'required',
            ]);

            $reply = new Reply([
                'user_id' => auth()->id(),
                'reply_text' => $request->input('reply_text'),
            ]);

            $comment->replies()->save($reply);

            $this->notificationService->createNotification(Auth::user(), $reply, 'reply', 'New reply on your comment.');

            return response()->json(['message' => 'Reply added successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error adding reply.', 'message' => $e->getMessage()], 500);
        }
    }

    public function storeNestedReply(Request $request, Reply $parentReply)
    {
        try {
            $user = Auth::user();

            $reply = new Reply([
                'user_id' => $user->id,
                'comment_id' => $parentReply->comment_id,
                'reply_text' => $request->input('reply_text'),
            ]);

            $reply->parent_id = $parentReply->id;
            $reply->save();

            $this->notificationService->createNotification($user, $reply, 'nested_reply', 'New nested reply on your comment.');

            return redirect()->back()->with('success', 'Nested Reply added successfully');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error adding nested reply.', 'message' => $e->getMessage()], 500);
        }
    }
    public function show($id)
    {
        // Fetch the comments along with the user relation
        $comments = Comment::with('user')->get();

        // Pass the comments to the view
        return view('homepage.show', compact('comments'));
    }

    public function like(Request $request, $commentId)
    {
        $comment = Comment::findOrFail($commentId);
        $user = auth()->user();
    
        $existingLike = Like::where('user_id', $user->id)
            ->where('comment_id', $comment->id)
            ->first();
    
        if ($existingLike) {
            $existingLike->delete(); // Unlike
        } else {
            $like = new Like();
            $like->user_id = $user->id;
            $like->comment_id = $comment->id;
            $like->save();
        }
    
        return redirect()->back();
    }
}

