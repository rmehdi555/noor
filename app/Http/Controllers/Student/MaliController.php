<?php

namespace App\Http\Controllers\Student;


use App\Mali;
use Illuminate\Support\Facades\Auth;


class MaliController extends StudentController
{
    public function list()
    {
        $user=Auth::user();
        $malis = Mali::where('user_id', '=',$user->id)->orderBy('id','desc')->get();
        return view('student.pages.mali-list', compact('malis'));
    }


}
