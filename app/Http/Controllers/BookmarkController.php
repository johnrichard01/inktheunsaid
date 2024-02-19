<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function bookmark(Blogs $blog)
    {
        auth()->user()->bookmarks()->create([
            'blog_id' => $blog->id,
        ]);

        return redirect()->back()->with('success', 'Blog bookmarked successfully.');
    }

    public function unbookmark(Blogs $blog)
    {
        auth()->user()->bookmarks()->where('blog_id', $blog->id)->delete();
   
        // Assuming you want to show bookmarks after unbookmarking
        return $this->showBookmarks();
    }
    
    public function showBookmarks()
    {
        // Retrieve the authenticated user
        $user = Auth::user();
    
        // Retrieve bookmarks for the user
        $bookmarks = $user->bookmarks()->with('blog')->get();
    
        return view('user.bookmark', compact('user', 'bookmarks'));
    }
}
