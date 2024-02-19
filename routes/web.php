<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportBlogsController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\VerifyController;


// show homepage
Route::get('/', [BlogsController::class, 'index']);
// about us
Route::get('/aboutus', [StaticPageController::class, 'aboutus']);
// show signup
Route::get('/signup', [UsersController::class, 'create'])->middleware('guest');
// create new user
Route::post('/users', [UsersController::class, 'store']);
// show login
Route::get('/login', [UsersController::class, 'login'])->name('login')->middleware('guest');
// login function
Route::post('/login/authenticate', [UsersController::class, 'authenticate']);
// logout functionality
Route::post('/logout', [UsersController::class, 'logout'])->middleware('auth');
// show dashboard
Route::get('/dashboard', [AdminController::class, 'show_analytics'])->middleware(['auth', 'isAdmin']);
// show categories
Route::get('/category', [BlogsController::class, 'category']);
// search function
Route::get('/search', [BlogsController::class, 'search']);
//show create blogs form
Route::get('/blogs/create', [BlogsController::class, 'create'])->middleware(['auth', 'verified']);
//store created blogs
Route::post('/blogs/create/store', [BlogsController::class, 'store'])->middleware(['auth', 'verified']);
// show contact us
Route::get('/contact', [ContactController::class, 'show']);
//show edit form for blogs
Route::get('/blogs/{blogs}/edit', [BlogsController::class, 'show_update'])->middleware(['auth', 'verified']);
//update blogs
Route::post('/blogs/{blogs}', [BlogsController::class, 'update'])->middleware(['auth', 'verified']);
//delete blogs
Route::delete('/blogs/{blogs}', [BlogsController::class, 'destroy'])->middleware(['auth', 'verified']);
// show single blogs
Route::get('/blogs/{blog}', [BlogsController::class, 'show']);
//show my blogs
Route::get('/myblogs', [BlogsController::class, 'show_myblogs'])->middleware(['auth', 'verified']);


// user

Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
});

//for email verification
Route::get('/email/verify', [VerifyController::class, 'send'])->middleware('auth')->name('verification.notice');
//for verifying the email
Route::get('/email/verify/{id}/{hash}',[VerifyController::class, 'verify'])->middleware(['auth', 'signed'])->name('verification.verify');
//for resending email verification
Route::post('/email/verification-notification',[VerifyController::class, 'resend'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');
//for restting password
Route::get('/forgot-password', [ForgotPasswordController::class, 'show'])->middleware('guest')->name('password.request');
//for sending the email
Route::post('/forgot-password',[ForgotPasswordController::class, 'send'])->middleware('guest')->name('password.email');
//for the show reset form
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'show_reset'])->middleware('guest')->name('password.reset');
//for reset password
Route::post('/reset-password', [ForgotPasswordController::class, 'update'])->middleware('guest')->name('password.update');
//show users in dashboard
Route::get('/dashboard/manage-user', [AdminController::class, 'show_user'])->middleware(['auth', 'isAdmin', 'verified']);
//show admin in dashboard
Route::get('/dashboard/manage-admin', [AdminController::class, 'show_admin'])->middleware(['auth', 'isAdmin', 'verified']);
//newsletter
Route::post('/newsletter', [SubscriberController::class, 'send']);
//contact send
Route::post('/contact/send', [ContactController::class, 'send']);


Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
// Route for storing replies
Route::post('/comments/{comment}/replies', [CommentController::class, 'storeReply'])->name('comments.storeReply');
Route::post('/comments/storeNestedReply/{parentReply}', [CommentController::class, 'storeNestedReply'])->name('comments.storeNestedReply');
Route::post('/comments/{commentId}/replies', 'ReplyController@create');
Route::put('/replies/{replyId}', 'ReplyController@update');
Route::delete('/replies/{replyId}', 'ReplyController@destroy');


//BOOKMARKS
Route::middleware(['auth'])->group(function () {
    //add to bookmark
    Route::post('/bookmarks/{blog}', [BookmarkController::class, 'bookmark'])->name('bookmarks.bookmark');
    // remove from bookmark
    Route::delete('/bookmarks/{blog}', [BookmarkController::class, 'unbookmark'])->name('bookmarks.unbookmark');
    //show bookmarked items
    Route::get('/bookmarks', [BookmarkController::class, 'showBookmarks'])->name('user.bookmark');
});

//show single blog from bookmarked items
Route::get('/blogs/{blog}', [BlogsController::class, 'show'])->name('blogs.show');

//manage blogs
Route::get('/dashboard/manage-blogs', [AdminController::class, 'show_blogs'])->middleware(['auth', 'isAdmin', 'verified']);
//manage subs
Route::get('/dashboard/manage-subscriber', [AdminController::class, 'show_subscriber'])->middleware(['auth', 'isAdmin', 'verified']);
//manage messages
Route::get('/dashboard/manage-messages', [AdminController::class, 'show_messages'])->middleware(['auth', 'isAdmin', 'verified']);
//for modals
Route::get('/dashboard/blogs-detail/{blogs}', [AdminController::class, 'blog_details']);
//for modals
Route::get('/dashboard/user/{user}', [AdminController::class, 'blog_user']);
//for modals
Route::get('/dashboard/contact/{contact}', [AdminController::class, 'contact_details']);
//delete users
Route::post('/dashboard/delete-user/{user}', [AdminController::class, 'destroy_user'])->middleware(['auth', 'isAdmin', 'verified']);
//delete users
Route::post('/dashboard/delete-admin/{admin}', [AdminController::class, 'destroy_admin'])->middleware(['auth', 'isAdmin', 'verified']);
//delete blogs
Route::post('/dashboard/delete-blog/{blog}', [AdminController::class, 'destroy_blog'])->middleware(['auth', 'isAdmin', 'verified']);
//delete subs
Route::post('/dashboard/delete-subscriber/{blog}', [AdminController::class, 'destroy_subscriber'])->middleware(['auth', 'isAdmin', 'verified']);
// delete contact
Route::post('/dashboard/delete-contact/{blog}', [AdminController::class, 'destroy_contact'])->middleware(['auth', 'isAdmin', 'verified']);
//store admin
Route::post('/dashboard/manage-admin/admins', [AdminController::class, 'store_admin'])->middleware(['auth', 'isAdmin', 'verified']);
//store report
Route::post('/blogs/{blog}/report', [ReportBlogsController::class, 'store'])->middleware('auth');
//likes
Route::middleware(['auth'])->group(function () {
    Route::post('/api/like/comment/{comment}', [LikeController::class, 'likeComment'])->name('api.like.comment');
    Route::post('/api/like/reply/{replyId}', [LikeController::class, 'likeReply'])->name('api.like.reply');

});
//show report in admin
Route::get('/dashboard/manage-reports', [AdminController::class, 'show_reportblog'])->middleware(['auth', 'isAdmin', 'verified']);