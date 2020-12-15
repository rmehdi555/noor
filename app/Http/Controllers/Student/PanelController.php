<?php

namespace App\Http\Controllers\Student;

use Adlino\Locations\Facades\locations;
use App\Field;
use App\Http\Controllers\Student\StudentController;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Students;
use App\StudentsDocuments;
use App\StudentsFields;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use SoapClient;

/*
 * status=0ثبت نام اولیه
 * status=1ایجاد فاکتور و ارسال به درگاه پرداخت
 * status=2درخواست بررسی نهاد برای پرداخت نکردن
 * status=3تایید پرداخت نکردن
 * status=4 پرداخت تایید شده و در حال بارگذاری مدارک
 * status=5مدارک بارگذاری شده و در حال نمایش و ویرایش اطلاعات
 * status=6اطلاعات توسط کاربر تایید شده اند
 * status=10 تایید نهایی
 */
class PanelController extends StudentController
{
    public function index(Request $request)
    {
        $user=Auth::user();
        //dd($user->student->studentsFields);
        switch (Auth::user()->status)
        {
            case 0:
                $this->createPayment();
                $fields = Field::all();
                return view('student.pages.status-1', compact('fields', 'user'));
                break;
            case 1:


                break;
            case 2:
                $this->createPayment();
                $fields = Field::all();
                return view('student.pages.status-2', compact('fields', 'user'));
                break;
            case 4:
                $this->createPayment();
                $fields = Field::all();
                return view('student.pages.status-4', compact('fields', 'user'));
                break;
            case 5:
                $this->createPayment();
                $fields = Field::all();
                $provinces = Locations::getAllProvinces();
                $cities = Locations::getAllCities();
                return view('student.pages.status-5', compact('fields', 'user','provinces','cities'));
                break;
            case 6:
                $this->createPayment();
                $fields = Field::all();
                $provinces = Locations::getAllProvinces();
                $cities = Locations::getAllCities();
                return view('student.pages.status-6', compact('fields', 'user','provinces','cities'));
                break;
            default:
                return view('user.pages.panel');
                break;
        }

    }

    public function level1Save(Request $request)
    {
        $user=Auth::user();
        //dd($user->student->studentsFields);
        $request->validate([
            'filename' => 'required|mimes:jpeg,png,bmp|max:2048',
        ]);
        $url = $this->uploadImage($request->file('filename'),'student');
        StudentsDocuments::create([
            'title'=>'مدرک ارئه جهت عضو نهاد خاص برای تخفیف',
            'flag_cookie'=>$user->student->flag_cookie,
            'user_id'=>$user->id,
            'url'=>$url,
            'status' => '1',
        ]);


        $user->update([
            'status'=> '2',
        ]);
        alert()->success(__('web/messages.student_success_save_level_1'), __('web/messages.success'))->persistent(__('web/messages.success'));
        return redirect()->route('student.panel');
    }


    public function level4Save(Request $request)
    {
        $user=Auth::user();
        //dd($user->student->studentsFields);
        $request->validate([
            'meli_image' => 'required|max:2048|mimes:jpeg,png,bmp',
            'sh_1_image' => 'required|max:2048|mimes:jpeg,png,bmp',
            'sh_2_image' => 'required|max:2048|mimes:jpeg,png,bmp',
            'p_image' => 'nullable|max:2048|mimes:jpeg,png,bmp',
            'm_imagee' => 'nullable|max:2048|mimes:jpeg,png,bmp',
        ]);
        $url = $this->uploadImage($request->file('meli_image'),'student');
        StudentsDocuments::create([
            'title'=>__('web/public.meli_image'),
            'flag_cookie'=>$user->student->flag_cookie,
            'user_id'=>$user->id,
            'url'=>$url,
            'status' => '1',
        ]);
        $url = $this->uploadImage($request->file('sh_1_image'),'student');
        StudentsDocuments::create([
            'title'=>__('web/public.sh_1_image'),
            'flag_cookie'=>$user->student->flag_cookie,
            'user_id'=>$user->id,
            'url'=>$url,
            'status' => '1',
        ]);
        $url = $this->uploadImage($request->file('sh_2_image'),'student');
        StudentsDocuments::create([
            'title'=>__('web/public.sh_2_image'),
            'flag_cookie'=>$user->student->flag_cookie,
            'user_id'=>$user->id,
            'url'=>$url,
            'status' => '1',
        ]);

        $file = $request->file('p_image');
        if($file) {
            $url = $this->uploadImage($request->file('p_image'),'student');
            StudentsDocuments::create([
                'title'=>__('web/public.p_image'),
                'flag_cookie'=>$user->student->flag_cookie,
                'user_id'=>$user->id,
                'url'=>$url,
                'status' => '1',
            ]);
        }
        $file = $request->file('m_image');
        if($file) {
            $url = $this->uploadImage($request->file('m_image'),'student');
            StudentsDocuments::create([
                'title'=>__('web/public.m_image'),
                'flag_cookie'=>$user->student->flag_cookie,
                'user_id'=>$user->id,
                'url'=>$url,
                'status' => '1',
            ]);
        }

        $user->update([
            'status'=> '5',
        ]);
        alert()->success(__('web/messages.student_success_save_level_4'), __('web/messages.success'))->persistent(__('web/messages.success'));
        return redirect()->route('student.panel');
    }

    public function level5Save(Request $request)
    {
        $user=Auth::user();
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'family' => ['required', 'string', 'max:255'],
            'f_name' => ['required', 'string', 'max:255'],
            'sh_number' => ['required', 'string', 'max:255'],
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
            'post_number' => ['required', 'string', 'max:255'],
            'education' => ['required', 'string', 'max:255'],
            'job' => ['string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'number_of_children' => ['nullable', 'numeric', 'min:0', 'max:50'],

        ]);



        $user->student->update([
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
            'status' => '2',
        ]);


        $user->update([
            'name' => $request->name,
            'family' => $request->family,
            'email' => strtolower($request->email),
            'status'=> '6',
        ]);
        alert()->success(__('web/messages.student_success_save_level_5'), __('web/messages.success'))->persistent(__('web/messages.success'));
        return redirect()->route('student.panel');
    }

    public function createPayment()
    {
        $user=Auth::user();
        $allPrice=0;
        foreach ($user->student->studentsFields as $field)
        {
            $allPrice+=$field->price;
        }
        Payment::where([['status','=','1'],['user_id','=',$user->id]])->delete();
        Payment::create([
            'price' => $allPrice,
            'description' => '',
            'user_id' => $user->id,
            'user_type' => $user->level,
            'user_code' => $user->student->student_id,
            'email' => $user->email,
            'mobile' => $user->phone,
            'callbackURL'=>route('web.payment.online.zarinpal.callback'),
            'status'=>'1'
        ]);

    }
}
