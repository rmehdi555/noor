<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Students;
use Illuminate\Http\Request;

class StudentsController extends  AdminController
{

    public function index(Request $request)
    {
        $SID=$request->SID;
        $students=Students::all();
        return view('admin.students.index',compact('students','SID'));

    }
    public function show($student)
    {
        $SID="40";
        $student=Students::find($student);
        return view('admin.students.show',compact('student','SID'));
    }
}
