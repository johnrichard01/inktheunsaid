<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blogs;
use App\Models\Contact;
use App\Models\ReportBlogs;
use App\Models\subscriber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class AdminController extends Controller
{
    //show analytics page
    public function show_analytics()
    {
        $currentUser=Auth::user();
        $userCount= User::where('role_as', 0)->count();
        $contactCount= Contact::count();
        $subscriberCount= subscriber::count();
        $blogCount= Blogs::count();
        $unreadCount = Contact::where('status', 'unread')->count();
        return view('admin.dashboard', [
            'userCount'=>$userCount,
            'contactCount'=>$contactCount,
            'subscriberCount'=>$subscriberCount,
            'blogCount'=>$blogCount,
            'currentUser'=>$currentUser,
            'unreadCount'=>$unreadCount
        ]);
    }
    public function show_user()
    {
        $currentUser=Auth::user();
        $users = User::where('role_as', 0)->get();
        $unreadCount = Contact::where('status', 'unread')->count();
        return view('admin.manage-user', [
            'users'=>$users,
            'currentUser'=>$currentUser,
            'unreadCount'=>$unreadCount
        ]);
    }
    public function show_admin()
    {
        $currentUser=Auth::user();
        $users = User::where('role_as', 1)->get();
        $unreadCount = Contact::where('status', 'unread')->count();
        return view('admin.manage-admin', [
            'users'=>$users,
            'currentUser'=>$currentUser,
            'unreadCount'=>$unreadCount
        ]);
    }
    public function show_blogs()
    {
        $currentUser=Auth::user();
        $blogs=Blogs::all();
        $unreadCount = Contact::where('status', 'unread')->count();
        return view('admin.manage-blogs', [
            'blogs'=>$blogs,
            'currentUser'=>$currentUser,
            'unreadCount'=>$unreadCount
        ]);
    }
    public function show_subscriber()
    {
        $currentUser=Auth::user();
        $subs=Subscriber::all();
        $unreadCount = Contact::where('status', 'unread')->count();
        return view('admin.manage-subscribers', [
            'subs'=>$subs,
            'currentUser'=>$currentUser,
            'unreadCount'=>$unreadCount
        ]);
    }

    public function show_messages()
    {
        $currentUser=Auth::user();
        $messages=Contact::all();
        $unreadCount = Contact::where('status', 'unread')->count();
        return view('admin.manage-messages', [
            'messages'=>$messages,
            'currentUser'=>$currentUser,
            'unreadCount'=>$unreadCount
        ]);
    }
    public function blog_details($id){
        return Blogs::findOrFail($id);
    }
    public function blog_user($id){
        return User::findOrFail($id);
    }
    public function contact_details($id){
        $contact =Contact::findOrFail($id);
        $contact->status ='read';
        $contact->save();
        return $contact;
    }
    public function destroy_user(Request $request)
    {
        $user= User::find($request->user_delete_id);
        if($user)
        {
            $user->delete();

            return redirect('dashboard/manage-user');
        }
        else{
            return redirect('dashboard/manage-user');
        }
    }

    public function destroy_admin(Request $request)
    {
        $user= User::find($request->user_delete_id);
        if(Auth::user()->id != $user->id)
        {
                if($user)
            {
                $user->delete();

                return redirect('dashboard/manage-admin');
            }
            else{
                return redirect('dashboard/manage-admin');
            }
        }else{
            return redirect('dashboard/manage-admin');
        }
    }
    public function destroy_blog(Request $request)
    {
        $blog= Blogs::find($request->user_delete_id);
        if($blog)
        {
            $blog->delete();

            return redirect('dashboard/manage-blogs');
        }
        else{
            return redirect('dashboard/manage-blogs');
        }
    }
    public function destroy_subscriber(Request $request)
    {
        $sub= subscriber::find($request->user_delete_id);
        if($sub)
        {
            $sub->delete();

            return redirect('dashboard/manage-subscriber');
        }
        else{
            return redirect('dashboard/manage-subscriber');
        }
    }
    public function destroy_contact(Request $request)
    {
        $sub= Contact::find($request->user_delete_id);
        if($sub)
        {
            $sub->delete();

            return redirect('dashboard/manage-messages');
        }
        else{
            return redirect('dashboard/manage-messages');
        }
    }
    public function store_admin(Request $request)
    {

            $formFields = $request->validate([
                'username'=> ['required', 'min:3', Rule::unique('users', 'username')],
                'email'=>['required', 'email', Rule::unique('users', 'email')],
                'password'=>['required', 'confirmed']
            ]);
    
            $formFields['password'] = bcrypt($formFields['password']);
            $formFields['role_as']=1;
            $user=User::create($formFields);
            event(new Registered($user));
            return back();
    }
    public function show_reportblog()
    {
        $currentUser=Auth::user();
        $reports=ReportBlogs::all();
        $unreadCount = Contact::where('status', 'unread')->count();
        return view('admin.manage-reportblog', [
            'reports'=>$reports,
            'currentUser'=>$currentUser,
            'unreadCount'=>$unreadCount
        ]);
    }
}
