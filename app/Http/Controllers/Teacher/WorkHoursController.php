<?php

namespace App\Http\Controllers\Teacher;


use App\Providers\MyProvider;
use App\TeachersCardNumberBank;
use App\TeachersWorkHours;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkHoursController extends TeacherController
{
    public function index(Request $request)
    {
        $user=Auth::user();
        $cardNumberBank=TeachersCardNumberBank::where('user_id','=',$user->id)->first();
        if(!isset($cardNumberBank->id) or empty($cardNumberBank))
        {
            alert()->error('شما هنوز شماره کارت بانکی خود را ثبت نکرده اید / ابتدا مشخصات کارت بانکی خود را وارد نمایید .',__('web/messages.alert'));
            return redirect()->route('teacher.card.number.bank.create');
        }
        $workHours=TeachersWorkHours::where([['user_id','=',$user->id],['status','=','1']])->get();
        return view('teacher.pages.work-hours.index',compact('workHours'));
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


}
