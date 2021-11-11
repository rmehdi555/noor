<?php

namespace App\Http\Controllers\Teacher;

use App\MethodOfLetter;
use Illuminate\Http\Request;

class MethodOfLetterController extends TeacherController
{

    public function list(Request $request)
    {
        $methodOfLetters=MethodOfLetter::where('status','=',1)->orderBy('id','desc')->get();
        return view('teacher.pages.method-of-letter-list',compact('methodOfLetters'));

    }

}
