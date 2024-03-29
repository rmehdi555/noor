<?php

namespace App\Http\Controllers;

use App\Events\UserActivationSms;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Teacher\TeacherController;
use App\Specialization;
use App\TeachersDocuments;
use App\TeachersSpecialization;
use Illuminate\Http\Request;
use App\Cities;
use App\Field;
use App\Provinces;
use App\Teachers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class TeachersController extends TeacherController
{
    public function level1()
    {
        return view('web.pages.teachers-level-1');
    }


    public function level1Cancel(Request $request)
    {
        return redirect()->route('web.home');
    }

    public function level2(Request $request)
    {
        Auth::logout();
        $provinces = Provinces::all();
        $cities = Cities::all();
        $allSpecialization=Specialization::latest()->get();
        return view('web.pages.teachers-level-2', compact('provinces', 'cities','allSpecialization'));
    }

    public function level2Save(Request $request)
    {
        $request->phone_1=\App\Providers\MyProvider::convert_phone_number($request->phone_1);
        $request->phone_2=\App\Providers\MyProvider::convert_phone_number($request->phone_2);
        $request->phone_m=\App\Providers\MyProvider::convert_phone_number($request->phone_m);
        $request->phone_f=\App\Providers\MyProvider::convert_phone_number($request->phone_f);
        $request->tel=\App\Providers\MyProvider::convert_phone_number($request->tel);
        $request->validate([
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
            "specialization" => "required|array",
            "specialization.*" => "required",
        ]);


        $teacher = Teachers::create([
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

        foreach ($request->specialization as $item)
        {
            TeachersSpecialization::create([
                'specialization_id' => $item,
                'teacher_id' => $teacher->id,
                'price ' => 0,
                'status' => 0,
            ]);
        }
        $user = User::create([
            'name' => $request->name,
            'family' => $request->family,
            'email' => strtolower($request->email),
            'phone' => \App\Providers\MyProvider::convert_phone_number($request->phone_1),
            'password' => Hash::make($request->meli_number),
            'level' => 'teacher',
        ]);
        $year = substr(verta()->year, 2);

        Teachers::find($teacher->id)->update(
            [
                'user_id' => $user->id,
                'teacher_id' => 'm' . $year . $teacher->id,
            ]
        );

        $user->update(
            [
                'user_name' => 'm' . $year . $teacher->id,
            ]
        );

        $file = $request->file('meli_image');
        if ($file) {
            $url = $this->uploadImage($request->file('meli_image'), 'teacher');
            TeachersDocuments::create([
                'title' => __('web/public.meli_image'),
                'flag_cookie' => $teacher->flag_cookie,
                'user_id' => $user->id,
                'url' => $url,
                'status' => '1',
            ]);
        }
        $url = $this->uploadImage($request->file('sh_1_image'), 'teacher');
        TeachersDocuments::create([
            'title' => __('web/public.sh_1_image'),
            'flag_cookie' => $teacher->flag_cookie,
            'user_id' => $user->id,
            'url' => $url,
            'status' => '1',
        ]);

        $url = $this->uploadImage($request->file('sh_2_image'), 'teacher');
        TeachersDocuments::create([
            'title' => __('web/public.sh_2_image'),
            'flag_cookie' => $teacher->flag_cookie,
            'user_id' => $user->id,
            'url' => $url,
            'status' => '1',
        ]);

        $file = $request->file('sh_3_image');
        if ($file) {
            $url = $this->uploadImage($request->file('sh_3_image'), 'teacher');
            TeachersDocuments::create([
                'title' => __('web/public.sh_3_image'),
                'flag_cookie' => $teacher->flag_cookie,
                'user_id' => $user->id,
                'url' => $url,
                'status' => '1',
            ]);
        }
        $file = $request->file('sh_4_image');
        if ($file) {
            $url = $this->uploadImage($request->file('sh_4_image'), 'teacher');
            TeachersDocuments::create([
                'title' => __('web/public.sh_4_image'),
                'flag_cookie' => $teacher->flag_cookie,
                'user_id' => $user->id,
                'url' => $url,
                'status' => '1',
            ]);
        }
        $url = $this->uploadImage($request->file('profile_image'), 'teacher');
        TeachersDocuments::create([
            'title' => __('web/public.profile_image'),
            'flag_cookie' => $teacher->flag_cookie,
            'user_id' => $user->id,
            'url' => $url,
            'status' => '1',
        ]);

        $file = $request->file('p_image');
        if ($file) {
            $url = $this->uploadImage($request->file('p_image'), 'teacher');
            TeachersDocuments::create([
                'title' => __('web/public.p_image'),
                'flag_cookie' => $teacher->flag_cookie,
                'user_id' => $user->id,
                'url' => $url,
                'status' => '1',
            ]);
        }
        $file = $request->file('m_image');
        if ($file) {
            $url = $this->uploadImage($request->file('m_image'), 'teacher');
            TeachersDocuments::create([
                'title' => __('web/public.m_image'),
                'flag_cookie' => $teacher->flag_cookie,
                'user_id' => $user->id,
                'url' => $url,
                'status' => '1',
            ]);
        }
        if ($request->file('file_more')) {
            foreach ($request->file('file_more') as $key => $file) {
                if ($file) {
                    $url = $this->uploadImage($file, 'teacher');
                    TeachersDocuments::create([
                        'title' => $request->file_more_name[$key],
                        'flag_cookie' => $teacher->flag_cookie,
                        'user_id' => $user->id,
                        'url' => $url,
                        'status' => '1',
                    ]);
                }
            }
        }


        event(new UserActivationSms($user));
        alert()->success(__('web/messages.save_register_and_send_sms'), __('web/messages.success'));;
        return view('auth.confirm-sms-code', compact('user'));

    }

}
