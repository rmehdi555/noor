<?php

namespace App\Http\Controllers\Teacher;

use App\Exams;
use App\Providers\MyProvider;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* exams
 * status=1 فعال
 */
class ExamsController extends TeacherController
{

    public function list()
    {
        $user=Auth::user();
        $exams=Exams::where([['user_id','=',$user->id],['status','>',0]])->orderBy('id','DESC')->get();
        return view('teacher.pages.exams.list', compact('exams'));
    }

    public function create()
    {
        return view('teacher.pages.exams.create');
    }

    public function createSave(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'start_exam' => ['required'],
            'end_exam' => ['required'],
        ]);
        $user=Auth::user();
        $request->end_exam=MyProvider::convert_phone_number($request->end_exam);
        $end_exam=explode(' ',$request->end_exam);
        $end_exam_date=explode('-',$end_exam[0]);
        $end_exam_time=$end_exam[1];
        $end_exam_date=Verta::getGregorian($end_exam_date[0],$end_exam_date[1],$end_exam_date[2]);
        $end_exam_date=implode('-',$end_exam_date);
        $end_exam=$end_exam_date.' '.$end_exam_time;
        $request->start_exam=MyProvider::convert_phone_number($request->start_exam);
        $start_exam=explode(' ',$request->start_exam);
        $start_exam_date=explode('-',$start_exam[0]);
        $start_exam_time=$start_exam[1];
        $start_exam_date=Verta::getGregorian($start_exam_date[0],$start_exam_date[1],$start_exam_date[2]);
        $start_exam_date=implode('-',$start_exam_date);
        $start_exam=$start_exam_date.' '.$start_exam_time;


        $exam=Exams::create([
            'user_id'=>$user->id,
            'title'=>$request->title,
            'start_exam' => $start_exam,
            'end_exam'=>$end_exam,
            'status' => '1',
        ]);
        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
        return redirect()->route('teacher.exams.show',$exam->id);
    }






}
