<?php

namespace App\Http\Controllers\Teacher;


use App\Mali;
use Illuminate\Support\Facades\Auth;


class MaliController extends TeacherController
{
    public function list()
    {
        $user=Auth::user();
        $malis = Mali::where('user_id', '=',$user->id)->orderBy('id','desc')->get();
        return view('teacher.pages.mali-list', compact('malis'));
    }


}
