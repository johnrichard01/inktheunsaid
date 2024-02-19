<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Blogs;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'comment_text',
        'blog_id',
        'likes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with Blog model (comment belongs to a blog)
    public function blog()
    {
        return $this->belongsTo(Blogs::class, 'blog_id');
    }

    // Relationship with replies (comment has many replies)
    public function replies()
    {
        return $this->hasMany(Reply::class, 'comment_id');
    }

    public function show($id)
    {
        // Fetch the comments along with the user relation
        $comments = Comment::with('user')->get();

        // Pass the comments to the view
        return view('homepage.show', compact('comments'));
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    
}

