<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;

class Blogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category',
        'description',
        'thumbnail',
        'about',
        'user_id'
    ];
    public function scopeFilter($query, array $filters){
        if ($filters['category'] ?? false) {
            $query->where('category', 'like', '%' . request('category') . '%');
        }
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('category', 'like', '%' . request('search') . '%');
        }
    }
    //relationship to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function reportblogs()
    {
        return $this->hasMany(reportblogs::class, 'blog_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'blog_id');
    }

    
}
