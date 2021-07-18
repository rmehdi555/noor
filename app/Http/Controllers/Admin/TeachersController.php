<?php

namespace App\Http\Controllers\Admin;

use App\Cities;
use App\Field;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Teacher\TeacherController;
use App\Provinces;
use App\Specialization;
use App\Teachers;
use App\TeachersDocuments;
use Illuminate\Http\Request;

class TeachersController extends TeacherController
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
    public function edit($teacher)
    {
        $SID="50";
        $teacher=Teachers::find($teacher);
        //dd($teacher->user->teachersDocuments);
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        return view('admin.teachers.edit',compact('teacher','fields','provinces','cities','SID'));
    }
    public function update(Request $request,$teacherId)
    {
        $teacher=Teachers::find($teacherId);
        $request->phone_2=\App\Providers\MyProvider::convert_phone_number($request->phone_2);
        $request->phone_m=\App\Providers\MyProvider::convert_phone_number($request->phone_m);
        $request->phone_f=\App\Providers\MyProvider::convert_phone_number($request->phone_f);
        $request->tel=\App\Providers\MyProvider::convert_phone_number($request->tel);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            'f_name' => ['required', 'string', 'max:255'],
            'sh_number' => ['required', 'numeric'],
            'sh_sodor' => ['required', 'string', 'max:255'],
            'tavalod_date_y' => ['required', 'numeric', 'min:1250', 'max:1450'],
            'tavalod_date_m' => ['required', 'numeric', 'min:1', 'max:12'],
            'tavalod_date_d' => ['required', 'numeric', 'min:1', 'max:31'],
            'married' => ['required', 'string', 'max:255'],
            'phone_2' => ['nullable', 'numeric', 'digits:11'],
            'phone_f' => ['nullable', 'numeric', 'digits:11'],
            'phone_m' => ['nullable', 'numeric', 'digits:11'],
            'tel' => ['nullable', 'numeric'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'post_number' => ['required', 'numeric', 'digits:10'],
            'education' => ['required', 'string', 'max:255'],
            'job' => ['string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,'.$teacher->user->id],
            'number_of_children' => ['nullable', 'numeric', 'min:0', 'max:50'],
            'sex' => ['required', 'string', 'max:255'],
        ]);



        $teacher->update([
            'name' => $request->name,
            'family' => $request->family,
            'f_name' => $request->f_name,
            'sh_number' => $request->sh_number,
            'sh_sodor' => $request->sh_sodor,
            'tavalod_date' => $request->tavalod_date_y . '-' . $request->tavalod_date_m . '-' . $request->tavalod_date_d,
            'married' => $request->married,
            'phone_2' => \App\Providers\MyProvider::convert_phone_number($request->phone_2),
            'phone_f' => \App\Providers\MyProvider::convert_phone_number($request->phone_f),
            'phone_m' => \App\Providers\MyProvider::convert_phone_number($request->phone_m),
            'tel'=> $request->tel,
            'city' => $request->city,
            'province' => $request->province,
            'address' => $request->address,
            'post_number' => $request->post_number,
            'education' => $request->education,
            'job' => $request->job,
            'email' => strtolower($request->email),
            'number_of_children' => $request->number_of_children,
            'sex'=>$request->sex,
        ]);
        $teacher->user->update([
            'name' => $request->name,
            'family' => $request->family,
            'email' => strtolower($request->email),
        ]);

        alert()->success(__('admin/messages.success_save_form'), __('web/messages.success'));
        return redirect(route('teachers.index',['SID' => '50']));
    }
    public function addFile(Request $request,$teacherId)
    {
        $teacher=Teachers::find($teacherId);
        $request->validate([
            'file_name' => ['required', 'string', 'max:255'],
        ]);

        if ($request->file('file')) {
            $url = $this->uploadImage($request->file('file'), 'teacher');
            TeachersDocuments::create([
                'title' => $request->file_name,
                'flag_cookie' => $teacher->flag_cookie,
                'user_id' => $teacher->user_id,
                'url' => $url,
                'status' => '1',
            ]);
        }



        alert()->success(__('admin/messages.success_save_form'), __('web/messages.success'));
        return redirect(route('teachers.edit',$teacherId));
    }
}
