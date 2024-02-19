<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserActivity;

class ActivityController extends Controller
{
    public function activity()
    {
        $userActivities = UserActivity::all();

        return view('user.activities', ['userActivities' => $userActivities]);
    }
}




