<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;


class UsersController extends Controller
{
    //show the signup page
    public function create()
    {
        return view('homepage.signup');
    }
    //for storing new users
    public function store(Request $request){
        $formFields = $request->validate([
            'username'=> ['required', 'min:3', Rule::unique('users', 'username')],
            'email'=>['required', 'email', Rule::unique('users', 'email')],
            'password'=>['required', 'confirmed']
        ]);

        $formFields['password'] = bcrypt($formFields['password']);
        $user=User::create($formFields);
        event(new Registered($user));
        return redirect('/login')->with('success', 'Successfully created an account');
    }
    //show login
    public function login()
    {
        return view('homepage.login');
    }
    //login functionality
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email'=>['required', 'email'],
            'password'=>['required']
        ]);
        if(auth()->attempt($formFields))
        {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Successfully logged in');
        }
        return back()->withErrors(['credentials'=>'Invalid Credentials'])->onlyInput('email');

    }
    //for logout
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    
}


