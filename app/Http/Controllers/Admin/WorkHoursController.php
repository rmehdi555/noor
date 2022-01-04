<?php

namespace App\Http\Controllers\Admin;


use App\Providers\MyProvider;
use App\TeachersCardNumberBank;
use App\TeachersWorkHours;
use App\TeachersWorkHoursList;
use App\User;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkHoursController extends AdminController
{
    public function show(Request $request)
    {
        $user=User::find($request->user_id);
        $cardNumberBank=TeachersCardNumberBank::where('user_id','=',$user->id)->first();
        if(!isset($cardNumberBank->id) or empty($cardNumberBank))
        {
            alert()->error('معلم هنوز شماره کارت بانکی خود را ثبت نکرده است .',__('web/messages.alert'));
            return redirect()->route('teachers.index');
        }
        $workHours=TeachersWorkHours::where([['user_id','=',$user->id],['status','=','1']])->get();
        return view('admin.work-hours.show',compact('workHours','user','cardNumberBank'));
    }

    public function createSave(Request $request)
    {
        $request->validate([
            'date' => ['required'],
            'start_date' => ['required'],
            'end_date' => ['required'],
        ]);
        $user=Auth::user();
        $request->date=MyProvider::convert_phone_number($request->date);
        $date=explode('-',$request->date);
        $date=Verta::getGregorian($date[0],$date[1],$date[2]);
        $date=implode('-',$date);
        $request->start_date=MyProvider::convert_phone_number($request->start_date);
        $request->start_date=$date.' '.$request->start_date;
        $request->end_date=MyProvider::convert_phone_number($request->end_date);
        $request->end_date=$date.' '.$request->end_date;
        $request->date=$date.' '.'00:00:00';
        if(MyProvider::submission_date($request->end_date,$request->start_date)<1)
        {
            alert()->error('ساعت پایان باید بعد از ساعت شروع باشد .',__('web/messages.alert'));
            return redirect()->route('teacher.work.hours');
        }
        TeachersWorkHours::create([
            'user_id'=>$user->id,
            'teacher_id'=>$user->teacher->id,
            'date'=>$request->date,
            'start_date'=>$request->start_date,
            'end_date'=>$request->end_date,
            'teachers_work_hours_list_id'=>0,
            'status'=>1,
        ]);
        alert()->success('اطلاعات با موفقیت ثبت شد .', __('web/messages.success'));
        return redirect()->route('teacher.work.hours');
    }

    public  function deleteSave(Request $request)
    {
        $user=Auth::user();
        $workhours=TeachersWorkHours::find($request->id);
        if(!isset($workhours->id) OR $workhours->user_id!=$user->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.work.hours');
        }

        TeachersWorkHours::find($request->id)->delete();
        alert()->success('ساعت کارکرد با موفقیت حذف شد .', __('web/messages.success'));
        return redirect()->route('teacher.work.hours');

    }

    public function listCreateSave(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'price_hours' => ['required'],
            'hours' => ['required'],
            'totalSum' => ['required'],
            'user_id' => ['required'],
        ]);
        $user=User::find($request->user_id);
        $cardNumberBank=TeachersCardNumberBank::where('user_id','=',$user->id)->first();
        if(!isset($cardNumberBank->id) or empty($cardNumberBank))
        {
            alert()->error('معلم هنوز شماره کارت بانکی خود را ثبت نکرده است .',__('web/messages.alert'));
            return redirect()->route('teachers.index');
        }
        $teachersWorkHoursList=TeachersWorkHoursList::create([
            'user_id'=>$user->id,
            'teacher_id'=>$user->teacher->id,
            'name'=>$request->name,
            'description'=>$request->description,
            'price_hours'=>$request->price_hours,
            'hours'=>$request->hours,
            'a_description'=>$request->a_description,
            'a_price'=>$request->a_price,
            'k_description'=>$request->k_description,
            'k_price'=>$request->k_price,
            'totalSum'=>$request->totalSum,
            'card_name'=>$cardNumberBank->name,
            'hesab_number'=>$cardNumberBank->hesab_number,
            'card_number'=>$cardNumberBank->card_number,
            'sheba_number'=>$cardNumberBank->sheba_number,
            'bank_name'=>$cardNumberBank->bank_name,
            'status'=>1,
        ]);
        TeachersWorkHours::where([['user_id','=',$user->id],['status','=','1']])->update([
            'teachers_work_hours_list_id'=>$teachersWorkHoursList->id,
            'status'=>2,
        ]);
        alert()->success('فیش پرداختی با موفقیت ثبت شد .', __('web/messages.success'));
        return redirect()->route('admin.work.hours.list.show');

    }

    public function listShow(Request $request)
    {
        $teachersWorkHoursList=TeachersWorkHoursList::all();
        return view('admin.work-hours.list-show',compact('teachersWorkHoursList'));
    }

    public function listDelete(Request $request)
    {
        $teachersWorkHoursList=TeachersWorkHoursList::find($request->id);
        if(!isset($teachersWorkHoursList->id) or empty($teachersWorkHoursList->id))
        {
            alert()->error('خطا رخ داده است .',__('web/messages.alert'));
            return redirect()->route('admin.work.hours.list.show');
        }

        TeachersWorkHours::where([['teachers_work_hours_list_id','=',$teachersWorkHoursList->id],['status','=','2']])->update([
            'teachers_work_hours_list_id'=>0,
            'status'=>1,
        ]);
        $teachersWorkHoursList->delete();
        alert()->success('فیش پرداختی با موفقیت حذف شد .', __('web/messages.success'));
        return redirect()->route('admin.work.hours.list.show');

    }


    public function listPay(Request $request)
    {
        $teachersWorkHoursList=TeachersWorkHoursList::find($request->id);
        if(!isset($teachersWorkHoursList->id) or empty($teachersWorkHoursList->id))
        {
            alert()->error('خطا رخ داده است .',__('web/messages.alert'));
            return redirect()->route('admin.work.hours.list.show');
        }

        TeachersWorkHours::where([['teachers_work_hours_list_id','=',$teachersWorkHoursList->id],['status','=','2']])->update(
            [
                'status'=>5,
            ]);
        $teachersWorkHoursList->update([
            'status'=>5,
        ]);
        alert()->success('فیش پرداختی با موفقیت ثبت پرداخت شد .', __('web/messages.success'));
        return redirect()->route('admin.work.hours.list.show');

    }

    public function listShowPay(Request $request)
    {
        $teachersWorkHoursList=TeachersWorkHoursList::where('status','=',1)->get();
        return view('admin.work-hours.list-show-pay',compact('teachersWorkHoursList'));

    }

    public function listShowDetails(Request $request)
    {
        $teachersWorkHoursList=TeachersWorkHoursList::find($request->id);
        if(!isset($teachersWorkHoursList->id) or empty($teachersWorkHoursList->id))
        {
            alert()->error('خطا رخ داده است .',__('web/messages.alert'));
            return redirect()->route('admin.work.hours.list.show');
        }

        $workHours=TeachersWorkHours::where('teachers_work_hours_list_id','=',$teachersWorkHoursList->id)->get();

        $user=User::find($teachersWorkHoursList->user_id);
        $cardNumberBank=TeachersCardNumberBank::where('user_id','=',$user->id)->first();
        if(!isset($cardNumberBank->id) or empty($cardNumberBank))
        {
            alert()->error('معلم هنوز شماره کارت بانکی خود را ثبت نکرده است .',__('web/messages.alert'));
            return redirect()->route('admin.work.hours.list.show');
        }
        return view('admin.work-hours.list-show-details',compact('workHours','user','cardNumberBank','teachersWorkHoursList'));
    }




}
