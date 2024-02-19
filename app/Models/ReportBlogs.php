<?php

namespace App\Models;

use App\Models\User;
use App\Models\Blogs;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ReportBlogs extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'blog_id',
        'reason',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function blogs()
    {
       return $this->belongsTo(Blogs::class, 'blog_id');
    }
}
