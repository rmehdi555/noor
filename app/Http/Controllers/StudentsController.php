<?php

namespace App\Http\Controllers;


use Adlino\Locations\Facades\locations;
use App\Cities;
use App\Events\UserActivationSms;
use App\Field;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Student\StudentController;
use App\Provinces;
use App\Students;
use App\StudentsDocuments;
use App\StudentsFields;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class StudentsController extends StudentController
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
        alert()->error(__('web/messages.student_field_cancel'), __('web/messages.alert'));
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
        $request->phone_1=\App\Providers\MyProvider::convert_phone_number($request->phone_1);
        $request->phone_2=\App\Providers\MyProvider::convert_phone_number($request->phone_2);
        $request->phone_m=\App\Providers\MyProvider::convert_phone_number($request->phone_m);
        $request->phone_f=\App\Providers\MyProvider::convert_phone_number($request->phone_f);
        $request->tel=\App\Providers\MyProvider::convert_phone_number($request->tel);
        $request->validate([
            'class_type' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            'f_name' => ['required', 'string', 'max:255'],
            'sh_number' => ['required', 'numeric'],
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
            'post_number' => ['required', 'numeric', 'digits:10'],
            'education' => ['required', 'string', 'max:255'],
            'job' => ['string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'number_of_children' => ['nullable', 'numeric', 'min:0', 'max:50'],
            'sex' => ['required', 'string', 'max:255'],
            'meli_image' => 'nullable|max:2048|mimes:jpeg,png,bmp,jpg,jpeg,bmp',
            'sh_1_image' => 'required|max:2048|mimes:jpeg,png,bmp,jpg,jpeg,bmp',
            'sh_2_image' => 'required|max:2048|mimes:jpeg,png,bmp,jpg,jpeg,bmp',
            'sh_3_image' => 'nullable|max:2048|mimes:jpeg,png,bmp,jpg,jpeg,bmp',
            'sh_4_image' => 'nullable|max:2048|mimes:jpeg,png,bmp,jpg,jpeg,bmp',
            'profile_image' => 'required|max:2048|mimes:jpeg,png,bmp,jpg,jpeg,bmp',
            'p_image' => 'nullable|max:2048|mimes:jpeg,png,bmp,jpg,jpeg,bmp,pdf',
            'm_imagee' => 'nullable|max:2048|mimes:jpeg,png,bmp,jpg,jpeg,bmp',
            "file_more" => "nullable|array",
            "file_more.*" => "nullable|max:2048|mimes:jpeg,png,bmp,jpg,jpeg,bmp,pdf",
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
            'tel' => $request->tel,
            'city' => $request->city,
            'province' => $request->province,
            'address' => $request->address,
            'post_number' => $request->post_number,
            'education' => $request->education,
            'job' => $request->job,
            'email' => strtolower($request->email),
            'number_of_children' => $request->number_of_children,
            'sex' => $request->sex,
            'status' => '1',
        ]);


        $user = User::create([
            'name' => $request->name,
            'family' => $request->family,
            'email' => strtolower($request->email),
            'phone' => \App\Providers\MyProvider::convert_phone_number($request->phone_1),
            'password' => Hash::make($request->meli_number),
            'level' => 'student',
        ]);
        $year = substr(verta()->year, 2);

        Students::find($student->id)->update(
            [
                'user_id' => $user->id,
                'student_id' => 'q' . $year . $student->id,
            ]
        );
        $user->update(
            [
                'user_name' => 'q' . $year . $student->id,
            ]
        );

        $file = $request->file('meli_image');
        if ($file) {
            $url = $this->uploadImage($request->file('meli_image'), 'student');
            StudentsDocuments::create([
                'title' => __('web/public.meli_image'),
                'flag_cookie' => $student->flag_cookie,
                'user_id' => $user->id,
                'url' => $url,
                'status' => '1',
            ]);
        }
        $url = $this->uploadImage($request->file('sh_1_image'), 'student');
        StudentsDocuments::create([
            'title' => __('web/public.sh_1_image'),
            'flag_cookie' => $student->flag_cookie,
            'user_id' => $user->id,
            'url' => $url,
            'status' => '1',
        ]);
        $url = $this->uploadImage($request->file('sh_2_image'), 'student');
        StudentsDocuments::create([
            'title' => __('web/public.sh_2_image'),
            'flag_cookie' => $student->flag_cookie,
            'user_id' => $user->id,
            'url' => $url,
            'status' => '1',
        ]);
        $file = $request->file('sh_3_image');
        if ($file) {
            $url = $this->uploadImage($request->file('sh_3_image'), 'student');
            StudentsDocuments::create([
                'title' => __('web/public.sh_3_image'),
                'flag_cookie' => $student->flag_cookie,
                'user_id' => $user->id,
                'url' => $url,
                'status' => '1',
            ]);
        }
        $file = $request->file('sh_4_image');
        if ($file) {
            $url = $this->uploadImage($request->file('sh_4_image'), 'student');
            StudentsDocuments::create([
                'title' => __('web/public.sh_4_image'),
                'flag_cookie' => $student->flag_cookie,
                'user_id' => $user->id,
                'url' => $url,
                'status' => '1',
            ]);
        }

        $url = $this->uploadImage($request->file('profile_image'), 'student');
        StudentsDocuments::create([
            'title' => __('web/public.profile_image'),
            'flag_cookie' => $student->flag_cookie,
            'user_id' => $user->id,
            'url' => $url,
            'status' => '1',
        ]);

        $file = $request->file('p_image');
        if ($file) {
            $url = $this->uploadImage($request->file('p_image'), 'student');
            StudentsDocuments::create([
                'title' => __('web/public.p_image'),
                'flag_cookie' => $student->flag_cookie,
                'user_id' => $user->id,
                'url' => $url,
                'status' => '1',
            ]);
        }
        $file = $request->file('m_image');
        if ($file) {
            $url = $this->uploadImage($request->file('m_image'), 'student');
            StudentsDocuments::create([
                'title' => __('web/public.m_image'),
                'flag_cookie' => $student->flag_cookie,
                'user_id' => $user->id,
                'url' => $url,
                'status' => '1',
            ]);
        }
        if ($request->file('file_more')) {
            foreach ($request->file('file_more') as $key => $file) {
                if ($file) {
                    $url = $this->uploadImage($file, 'student');
                    StudentsDocuments::create([
                        'title' => $request->file_more_name[$key],
                        'flag_cookie' => $student->flag_cookie,
                        'user_id' => $user->id,
                        'url' => $url,
                        'status' => '1',
                    ]);
                }
            }
        }
        Cookie::forget('student_flag_cookie');
        Cookie::queue('student_flag_cookie', "0", 1);
        Cookie::forget('student_flag_cookie');

        event(new UserActivationSms($user));
        alert()->success(__('web/messages.save_register_and_send_sms'), __('web/messages.success'));;
        return view('auth.confirm-sms-code', compact('user'));


        //alert()->success(__('web/messages.student_success_level_1'), __('web/messages.success'));
        //return redirect()->route('login.sms');
    }


    public
    function checkCodeCookie($level = 1)
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
