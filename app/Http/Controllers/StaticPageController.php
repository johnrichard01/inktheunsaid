<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaticPageController extends Controller
{
    public function aboutus(){
        $user = Auth::user();
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
                    return view('homepage.aboutus', compact('user'));
                }
            } 
        }
        else
        {
            return view('homepage.aboutus');
        }
        
    }
}
