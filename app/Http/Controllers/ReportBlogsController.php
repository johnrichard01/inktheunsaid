<?php

namespace App\Http\Controllers;

use App\Models\ReportBlogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportBlogsController extends Controller
{
    public function store(Request $request)
    {
        $report['blog_id']= $request->blog_id;
        $report['reason']=$request->report_reason;
        $report['user_id']=Auth::user()->id;

        ReportBlogs::create($report);
        return redirect()->back()->with('success', 'Report successfully sent');
    }
}
