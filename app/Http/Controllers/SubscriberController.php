<?php

namespace App\Http\Controllers;

use App\Models\subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Subscriber as MailSubscriber;

class SubscriberController extends Controller
{
    public function send()
    {
        $sub=request()->validate([
            'email'=>'required|email',
        ]);
        subscriber::create($sub);
        Mail::to($sub['email'])->send(new MailSubscriber());
        return redirect()->back()->with('success', 'Successfully subscribe to newsletter');
    }
}
