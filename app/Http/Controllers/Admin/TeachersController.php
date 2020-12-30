<?php

namespace App\Http\Controllers\Admin;

use App\Cities;
use App\Field;
use App\Http\Controllers\Controller;
use App\Provinces;
use App\Teachers;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    public function index(Request $request)
    {
        $SID=$request->SID;
        $teachers=Teachers::all();
        return view('admin.teachers.index',compact('teachers','SID'));

    }
    public function show($teacher)
    {
        $SID="50";
        $teacher=Teachers::find($teacher);
        //dd($teacher->user->teachersDocuments);
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        return view('admin.teachers.show',compact('teacher','fields','provinces','cities','SID'));
    }
}
