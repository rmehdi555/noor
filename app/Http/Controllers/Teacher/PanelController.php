<?php

namespace App\Http\Controllers\Teacher;

use Adlino\Locations\Facades\locations;
use App\Cities;
use App\Field;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Provinces;
use App\SiteDetails;
use App\Teachers;
use App\TeachersDocuments;
use App\TeachersFields;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use SoapClient;

/*
 * status=0مدارک بارگذاری شده و در حال نمایش و ویرایش اطلاعات
 * status=2اطلاعات توسط کاربر تایید شده اند درحال پرداخت
 * status=4 پرداخت تایید شده
 * status=10 تایید نهایی
 */
class PanelController extends TeacherController
{
    public function index(Request $request)
    {
        $user=Auth::user();
        //dd($user->teacher->name);
        switch (Auth::user()->status)
        {

            case 0:
                $provinces = Provinces::all();
                $cities = Cities::all();
                return view('teacher.pages.status-2', compact('user','provinces','cities'));
                break;
            case 2:
                $this->createPayment();
                return view('teacher.pages.status-3', compact( 'user'));
                break;
            case 4:
                $provinces = Provinces::all();
                $cities = Cities::all();
                return view('teacher.pages.status-4', compact('user','provinces','cities'));
                break;

            default:
                return view('user.pages.panel');
                break;
        }

    }


    public function level2Save(Request $request)
    {
        $user=Auth::user();
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
            'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users'],
            'number_of_children' => ['nullable', 'numeric', 'min:0', 'max:50'],

        ]);



        $user->teacher->update([
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
            'status'=> '2',
        ]);
        alert()->success(__('web/messages.teacher_success_save_level_2'), __('web/messages.success'));
        return redirect()->route('teacher.panel');
    }

    public function createPayment()
    {
        $user=Auth::user();
        $price=SiteDetails::where('key','=','price_register_m')->get()->first();
        Payment::where([['status','=','1'],['user_id','=',$user->id]])->delete();
        Payment::create([
            'price' => $price->value,
            'description' => '',
            'user_id' => $user->id,
            'user_type' => $user->level,
            'user_code' => $user->teacher->teacher_id,
            'email' => $user->email,
            'mobile' => $user->phone,
            'callbackURL'=>route('web.payment.online.zarinpal.callback.teacher'),
            'status'=>'1'
        ]);

    }
}
