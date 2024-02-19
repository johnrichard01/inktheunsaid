<?php

namespace App\Http\Controllers;

use App\Mail\ContactUs;
use App\Models\Contact;
use App\Mail\ContactThanks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        if(Auth::check())
        {
            if($user->email_verified_at == null)
            {
                return redirect('/email/verify');
            }   
            else if($user->email_verified_at != null)
            {
                if(Auth::user()->role_as == '1')
                {
                    return redirect('/dashboard');
                }
                else if(Auth::user()->role_as == '0')
                {
                    return view('homepage.contactus', compact('user'));
                }
            } 
        }
        else
        {
            return view('homepage.contactus');
        }
    }
    public function send()
    {
        $data=request()->validate([
            'firstName'=> 'required|min:3',
            'lastName'=> 'required|min:3',
            'email'=> 'required|email',
            'message'=> 'required|min:3',
        ]);
        Contact::create($data);
        Mail::to('contact.expressyourself01@gmail.com')->send(new ContactUs($data));
        Mail::to($data['email'])->send(new ContactThanks());
        return redirect('/contact')->with('success', 'Successfully sent a message');
    }
}


