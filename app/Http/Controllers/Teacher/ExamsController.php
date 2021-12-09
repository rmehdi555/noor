<?php

namespace App\Http\Controllers\Teacher;

use App\Exams;
use App\ExamsQuestions;
use App\ExamsQuestionsOptions;
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

    public function edit(Request $request,$id)
    {
        $exam=Exams::find($id);
        $user=Auth::user();
        if(!isset($exam->id) or $exam->user_id!=$user->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.exams.list');
        }
        $examQuestions=ExamsQuestions::where('exams_id','=',$exam->id)->orderBy('id','DESC')->get();
        $examSumMark=ExamsQuestions::where([['exams_id','=',$exam->id],['status','>',0]])->sum('mark');
        return view('teacher.pages.exams.edit',compact('exam','examQuestions','examSumMark'));
    }
    public function editSave(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'start_exam' => ['required'],
            'end_exam' => ['required'],
            'exam_id' => ['required'],
        ]);
        $exam=Exams::find($request->exam_id);
        $user=Auth::user();
        if(!isset($exam->id) or $exam->user_id!=$user->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.exams.list');
        }
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


        $exam->update([
            'title'=>$request->title,
            'start_exam' => $start_exam,
            'end_exam'=>$end_exam,
        ]);
        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
        return redirect()->route('teacher.exams.show',$exam->id);
    }


    public function show(Request $request,$id)
    {
        $exam=Exams::find($id);
        $user=Auth::user();
        if(!isset($exam->id) or $exam->user_id!=$user->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.exams.list');
        }
        $examQuestions=ExamsQuestions::where('exams_id','=',$exam->id)->orderBy('id','DESC')->get();
        $examSumMark=ExamsQuestions::where([['exams_id','=',$exam->id],['status','>',0]])->sum('mark');
        return view('teacher.pages.exams.show',compact('exam','examQuestions','examSumMark'));
    }

    public function questionsCreate(Request $request,$id)
    {
        $exam=Exams::find($id);
        $user=Auth::user();
        if(!isset($exam->id) or $exam->user_id!=$user->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.exams.list');
        }
        $examQuestions=ExamsQuestions::where('exams_id','=',$exam->id)->orderBy('id','DESC')->get();
        $examSumMark=ExamsQuestions::where([['exams_id','=',$exam->id],['status','>',0]])->sum('mark');
        return view('teacher.pages.exams.question-create',compact('exam','examQuestions','examSumMark'));
    }

    public function questionsCreateSave(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'type' => ['required'],
            'status' => ['required'],
            'mark' => ['required'],
            'exams_id' => ['required'],
        ]);
        if(!isset($request->response) or empty($request->response))
            $request->response="0";
        $exam=Exams::find($request->exams_id);
        $user=Auth::user();
        if(!isset($exam->id) or $exam->user_id!=$user->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.exams.list');
        }
        if($request->type=="test")
        {
            $examsQuestion=ExamsQuestions::create([
                'user_id'=>$user->id,
                'exams_id'=>$exam->id,
                'type'=>$request->type,
                'title'=>$request->title,
                'mark' =>$request->mark,
                'response'=>$request->test_response,
                'status' =>$request->status,
            ]);

            for($i=1;$i<=$request->type_adj_number;$i++)
            {
                if(isset($request->titleTest[$i-1]) and !empty($request->titleTest[$i-1]))
                {
                    $response=0;
                    if($request->test_response==$i)
                        $response=1;
                    $xamsQuestionsOption=ExamsQuestionsOptions::create([
                        'user_id'=>$user->id,
                        'exams_id'=>$exam->id,
                        'exams_questions_id'=>$examsQuestion->id,
                        'type'=>$request->type,
                        'title'=>$request->titleTest[$i-1],
                        'response'=>$response,
                        'status' =>1,
                    ]);

                }
            }

            alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
            return redirect()->route('teacher.exams.show',$exam->id);

        }elseif($request->type=="adj")
        {
            $xamsQuestion=ExamsQuestions::create([
                'user_id'=>$user->id,
                'exams_id'=>$exam->id,
                'type'=>$request->type,
                'title'=>$request->title,
                'mark' =>$request->mark,
                'response'=>$request->response,
                'status' =>$request->status,
            ]);
            alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
            return redirect()->route('teacher.exams.show',$exam->id);
        }else{
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.exams.list');
        }


    }

    public function questionsEdit(Request $request,$id)
    {
        $examsQuestion=ExamsQuestions::find($id);
        $user=Auth::user();
        if(!isset($examsQuestion->id) or $examsQuestion->user_id!=$user->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.exams.list');
        }

        $exam=Exams::find($examsQuestion->exams_id);
        if(!isset($exam->id) or $exam->user_id!=$user->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.exams.list');
        }
        $examsQuestionsOptions=ExamsQuestionsOptions::where('exams_questions_id','=',$examsQuestion->id)->get();
        return view('teacher.pages.exams.question-edit',compact('exam','examsQuestion','examsQuestionsOptions'));
    }

    public function questionsEditSave(Request $request)
    {
        $request->validate([
            'title' => ['required'],
            'type' => ['required'],
            'status' => ['required'],
            'mark' => ['required'],
            'exams_id' => ['required'],
        ]);
        if(!isset($request->response) or empty($request->response))
            $request->response="0";
        $examsQuestion=ExamsQuestions::find($request->exams_questions_id);
        $user=Auth::user();
        if(!isset($examsQuestion->id) or $examsQuestion->user_id!=$user->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.exams.list');
        }

        $exam=Exams::find($examsQuestion->exams_id);
        if(!isset($exam->id) or $exam->user_id!=$user->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.exams.list');
        }
        if($request->type=="test")
        {
            $examsQuestion->update([
                'type'=>$request->type,
                'title'=>$request->title,
                'mark' =>$request->mark,
                'response'=>$request->test_response,
                'status' =>$request->status,
            ]);
            ExamsQuestionsOptions::where('exams_questions_id','=',$examsQuestion->id)->delete();

            for($i=1;$i<=$request->type_adj_number;$i++)
            {
                if(isset($request->titleTest[$i-1]) and !empty($request->titleTest[$i-1]))
                {
                    $response=0;
                    if($request->test_response==$i)
                        $response=1;
                    $xamsQuestionsOption=ExamsQuestionsOptions::create([
                        'user_id'=>$user->id,
                        'exams_id'=>$exam->id,
                        'exams_questions_id'=>$examsQuestion->id,
                        'type'=>$request->type,
                        'title'=>$request->titleTest[$i-1],
                        'response'=>$response,
                        'status' =>1,
                    ]);

                }
            }

            alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
            return redirect()->route('teacher.exams.show',$exam->id);

        }elseif($request->type=="adj")
        {
            $examsQuestion->update([
                'user_id'=>$user->id,
                'exams_id'=>$exam->id,
                'type'=>$request->type,
                'title'=>$request->title,
                'mark' =>$request->mark,
                'response'=>$request->response,
                'status' =>$request->status,
            ]);
            alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
            return redirect()->route('teacher.exams.show',$exam->id);
        }else{
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.exams.list');
        }


    }









}
