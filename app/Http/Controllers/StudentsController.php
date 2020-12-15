<?php

namespace App\Http\Controllers;



use Adlino\Locations\Facades\locations;
use App\Cities;
use App\Field;
use App\Http\Controllers\Controller;
use App\Provinces;
use App\Students;
use App\StudentsFields;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class StudentsController extends Controller
{
    public function level1()
    {
        //Cookie::queue('student_code', 124891, 720);
        $result = $this->checkCodeCookie(1);
        if ($result == 'true') {
            $fields = Field::all();
            $studentFields = StudentsFields::where('flag_cookie', '=', Cookie::get('student_flag_cookie'))->orderBy('id')->get();
            return view('web.pages.students-level-1', compact('fields', 'studentFields'));
        } else {
            return redirect()->route($result);
        }
    }

    public function level1Save(Request $request)
    {
        $student_flag_cookie = Cookie::get('student_flag_cookie');
        if (empty($student_flag_cookie)) {
            return redirect()->route('web.students.level.1');
        }
        return redirect()->route('web.students.level.2', ['class_type' => $request->class_type]);
        //$studentFields = StudentsFields::where('flag_cookie', '=', Cookie::get('student_flag_cookie'))->orderBy('id')->get();
        // return view('web.pages.students-level-2', compact('studentFields','request'));
    }

    public function level1Cancel(Request $request)
    {
        Cookie::forget('student_flag_cookie');
        Cookie::queue('student_flag_cookie', "0", 1);
        Cookie::forget('student_flag_cookie');
        alert()->error(__('web/messages.student_field_cancel'), __('web/messages.alert'))->persistent(__('web/messages.success'));
        return redirect()->route('web.home');
    }


    public function level2(Request $request)
    {
        $student_flag_cookie = Cookie::get('student_flag_cookie');
        if (empty($student_flag_cookie) OR empty($request->class_type)) {
            return redirect()->route('web.students.level.1');
        }
        $studentFields = StudentsFields::where('flag_cookie', '=', Cookie::get('student_flag_cookie'))->orderBy('id')->get();
        $provinces = Provinces::all();
        $cities = Cities::all();
        return view('web.pages.students-level-2', compact('studentFields', 'request', 'provinces', 'cities'));

    }

    public function level2Save(Request $request)
    {
        $request->validate([
            'class_type' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            'f_name' => ['required', 'string', 'max:255'],
            'sh_number' => ['required', 'string', 'max:255'],
            'meli_number' => ['required', 'numeric', 'digits:10'],
            'sh_sodor' => ['required', 'string', 'max:255'],
            'tavalod_date_y' => ['required', 'numeric', 'min:1250', 'max:1450'],
            'tavalod_date_m' => ['required', 'numeric', 'min:1', 'max:12'],
            'tavalod_date_d' => ['required', 'numeric', 'min:1', 'max:31'],
            'married' => ['required', 'string', 'max:255'],
            'phone_1' => ['required', 'numeric', 'digits:11', 'unique:users,phone'],
            'phone_2' => ['nullable', 'numeric', 'digits:11'],
            'phone_f' => ['nullable', 'numeric', 'digits:11'],
            'phone_m' => ['nullable', 'numeric', 'digits:11'],
            'tel' => ['nullable', 'numeric'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'post_number' => ['required', 'string', 'max:255'],
            'education' => ['required', 'string', 'max:255'],
            'job' => ['string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'number_of_children' => ['nullable', 'numeric', 'min:0', 'max:50'],

        ]);


        $student_flag_cookie = Cookie::get('student_flag_cookie');
        if (empty($student_flag_cookie)) {
            return redirect()->route('web.students.level.1');
        }

        $student = Students::create([
            'flag_cookie' => $student_flag_cookie,
            'class_type' => $request->class_type,
            'name' => $request->name,
            'family' => $request->family,
            'f_name' => $request->f_name,
            'sh_number' => $request->sh_number,
            'meli_number' => $request->meli_number,
            'sh_sodor' => $request->sh_sodor,
            'tavalod_date' => $request->tavalod_date_y . '-' . $request->tavalod_date_m . '-' . $request->tavalod_date_d,
            'married' => $request->married,
            'phone_1' => \App\Providers\MyProvider::convert_phone_number($request->phone_1),
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
            'status' => '1',
        ]);


        $user=User::create([
            'name' => $request->name,
            'family' => $request->family,
            'email' => strtolower($request->email),
            'phone' => \App\Providers\MyProvider::convert_phone_number($request->phone_1),
            'password' => Hash::make($request->meli_number),
            'level' => 'student',
        ]);
        $year=substr(verta()->year, 2);

        Students::find($student->id)->update(
            [
                'user_id'=>$user->id,
                'student_id'=>'q'.$year.$student->id,
            ]
        );
        alert()->success(__('web/messages.student_success_level_1'), __('web/messages.success'))->persistent(__('web/messages.success'));
        Cookie::forget('student_flag_cookie');
        Cookie::queue('student_flag_cookie', "0", 1);
        Cookie::forget('student_flag_cookie');
        return redirect()->route('login.sms');
    }


    public function checkCodeCookie($level = 1)
    {
        $student_flag_cookie = Cookie::get('student_flag_cookie');
        if (!empty($student_flag_cookie)) {
            $student = Students::where('flag_cookie', '=', $student_flag_cookie)->get()->first();
            if (!isset($student['flag_cookie'])) {
                if ($level == 1)
                    return 'true';
                return 'web.students.level.1';

            } else {

                Cookie::queue('student_flag_cookie', $student['flag_cookie'], 720);

                if ($student['status'] == 1) {
                    if ($level == 2) {
                        return 'true';
                    } else {
                        alert()->success(__('web/messages.success_sabt_level_1_students'), __('web/messages.success'));
                        return 'web.students.level.2';
                    }

                }
                if ($student['status'] == 2) {
                    if ($level == 3) {
                        return 'true';
                    } else {
                        alert()->success(__('web/messages.success_sabt_level_2_students'), __('web/messages.success'));
                        return 'web.students.level.3';
                    }

                }
                if ($student['status'] == 3) {
                    if ($level == 4) {
                        return 'true';
                    } else {
                        alert()->success(__('web/messages.success_sabt_level_3_students'), __('web/messages.success'));
                        return 'web.students.level.4';
                    }

                }
            }
        }
        if ($level == 1)
            return 'true';
        return 'web.students.level.1';
    }
}
