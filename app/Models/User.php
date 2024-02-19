<?php

// app/Models/User.php

namespace App\Models;

use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail, CanResetPassword
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'avatar',
        'bio',
        'first_name',
        'last_name',
        'user_id',
        'role_as'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    use HasFactory;

    // Define the relationship with the blogs
    public function blogs()
    {
        return $this->hasMany(Blogs::class, 'user_id');
    }

    // Define the relationship with the bookmarks
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'user_id');
    }

    // Define the relationship with the comments
    public function comments()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    // Define the relationship with the replies
    public function replies()
    {
        return $this->hasMany(Reply::class, 'user_id');
    }
    public function reportblogs()
    {
        return $this->hasMany(ReportBlogs::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}

