<?php

namespace App\Http\Controllers\Admin;

use App\Cities;
use App\Field;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Student\StudentController;
use App\Provinces;
use App\Students;
use App\StudentsDeleted;
use App\StudentsDocuments;
use App\StudentsFields;
use App\User;
use App\UsersDeleted;
use function GuzzleHttp\default_ca_bundle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentsController extends  StudentController
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
        //dd($student->user->studentsDocuments);
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        return view('admin.students.show',compact('student','fields','provinces','cities','SID'));
    }
    public function edit($student)
    {
        $SID="40";
        $student=Students::find($student);
        //dd($student->user->studentsDocuments);
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        return view('admin.students.edit',compact('student','fields','provinces','cities','SID'));
    }
    public function update(Request $request,$studentId)
    {
        $student=Students::find($studentId);
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
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,'.$student->user->id],
            'number_of_children' => ['nullable', 'numeric', 'min:0', 'max:50'],
            'sex' => ['required', 'string', 'max:255'],
        ]);



        $student->update([
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
        $student->user->update([
            'name' => $request->name,
            'family' => $request->family,
            'email' => strtolower($request->email),
        ]);
        alert()->success(__('admin/messages.success_save_form'), __('web/messages.success'));
        return redirect(route('students.index',['SID' => '50']));
    }
    public function addFile(Request $request,$studentId)
    {
        $student=Students::find($studentId);
        $request->validate([
            'file_name' => ['required', 'string', 'max:255'],
        ]);

        if ($request->file('file')) {
            $url = $this->uploadImage($request->file('file'), 'student');
            StudentsDocuments::create([
                'title' => $request->file_name,
                'flag_cookie' => $student->flag_cookie,
                'user_id' => $student->user_id,
                'url' => $url,
                'status' => '1',
            ]);
        }



        alert()->success(__('admin/messages.success_save_form'), __('web/messages.success'));
        return redirect(route('students.edit',$studentId));
    }

    public function reports(Request $request)
    {

        $SID=$request->SID;
        switch ($request->sex)
        {
            case "male":
                $operatorSex="=";
                $valueSex="male";
                break;
            case "female":
                $operatorSex="=";
                $valueSex="female";
                break;
            default:
                $operatorSex="!=";
                $valueSex="all";
                break;
        }
        if(isset($request->field_child) and !empty($request->field_child))
        {
            $field = Field::find($request->field_child);
            if(isset($field->id))
            {
                $studentsN = DB::table('students')
                    ->select('students.*', 'students_fields.title' )
                    ->join('students_fields', 'students.flag_cookie', '=', 'students_fields.flag_cookie')
                    ->where('students_fields.field_id','=',$request->field_child)
                    ->where('students.sex',$operatorSex,$valueSex)
                    ->get();
                $students=array();
                foreach ($studentsN as $key=>$student)
                {
                    $s=Students::find($student->id);
                    if(isset($s->id))
                        $students[$key]=$s;
                }

                $fields = Field::all();
                return view('admin.students.reports',compact('students','fields','SID'));
            }
        }
        $students=Students::all();
        $fields = Field::all();
        return view('admin.students.reports',compact('students','fields','SID'));

    }

    public function destroy(Request $request,$studentId)
    {
        $student=Students::find($studentId);
        StudentsDeleted::create([
            'flag_cookie'=>$student->flag_cookie,
            'user_id'=>$student->user_id,
            'student_id'=>$student->student_id,
            'name'=>$student->name,
            'family'=>$student->family,
            'f_name'=>$student->f_name,
            'sh_number'=>$student->sh_number,
            'meli_number'=>$student->meli_number,
            'sh_sodor'=>$student->sh_sodor,
            'tavalod_date'=>$student->tavalod_date,
            'married'=>$student->married,
            'phone_1'=>$student->phone_1,
            'phone_2'=>$student->phone_2,
            'phone_f'=>$student->phone_f,
            'phone_m'=>$student->phone_m,
            'tel'=>$student->tel,
            'city'=>$student->city,
            'province'=>$student->province,
            'address'=>$student->address,
            'post_number'=>$student->post_number,
            'education'=>$student->education,
            'job'=>$student->job,
            'email'=>$student->email,
            'number_of_children'=>$student->number_of_children,
            'sex'=>$student->sex,
            'status'=>$student->status,
            'old_id'=>$student->id,
        ]);
        $userD=User::find($student->user_id);
        UsersDeleted::create([
                'name'=>$userD->name,
                'family'=>$userD->family,
                'email'=>$userD->email,
                'phone'=>$userD->phone,
                'password'=>$userD->password,
                'active'=>$userD->active,
                'level'=>$userD->level,
                'user_name'=>$userD->user_name,
                'email_verified_at'=>$userD->email_verified_at,
                'phone_verified_at'=>$userD->phone_verified_at,
                'priority'=>$userD->priority,
                'status'=>$userD->status,
                'old_id'=>$userD->id,
            ]
        );
        $student->forceDelete();
        $userD->forceDelete();
        alert()->success(__('admin/messages.success_save_form'), __('web/messages.success'));
        return redirect(route('students.index',['SID' => '50']));
    }




    public function acceptField($id)
    {
        $item=StudentsFields::find($id);
        if(!isset($item->id))
        {
            alert()->error('خطا در یافتن رکورد ', __('web/messages.error'));
            return redirect(route('students.index',['SID' => '50']));
        }

        $item->update([
            'status' => 2,
        ]);
        alert()->success(__('admin/messages.success_save_form'), __('web/messages.success'));
        return redirect(route('students.index',['SID' => '50']));

    }




}
