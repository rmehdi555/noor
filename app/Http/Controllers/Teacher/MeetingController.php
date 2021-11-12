<?php

namespace App\Http\Controllers\Teacher;

use App\Meeting;
use Illuminate\Http\Request;

class MeetingController extends TeacherController
{

    public function list(Request $request)
    {
        $meetings=Meeting::where('status','=',1)->orderBy('id','desc')->get();
        return view('teacher.pages.meeting-list',compact('meetings'));

    }

}
