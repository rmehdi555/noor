<?php

namespace App\Http\Controllers\Admin;

use App\ClassRooms;
use App\ClassRoomsTeachers;
use App\Exams;
use App\ExamsQuestions;
use App\ExamsQuestionsOptions;
use App\ExamsResponseStudents;
use App\ExamsResponseTeachers;
use App\Providers\MyProvider;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* exams
 * status=1 فعال
 */
class ExamsController extends AdminController
{

    public function list()
    {
        $user=Auth::user();
        $exams=Exams::all();
        $SID=410;
        return view('admin.exams.list', compact('exams','SID'));
    }

    public function create()
    {
        $SID=410;
        return view('admin.exams.create',compact('SID'));
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
        return redirect()->route('admin.exams.show',$exam->id);
    }

    public function edit(Request $request,$id)
    {
        $SID=410;
        $exam=Exams::find($id);
        $user=Auth::user();
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.exams.list');
        }
        $examQuestions=ExamsQuestions::where('exams_id','=',$exam->id)->orderBy('id','DESC')->get();
        $examSumMark=ExamsQuestions::where([['exams_id','=',$exam->id],['status','>',0]])->sum('mark');
        return view('admin.exams.edit',compact('exam','examQuestions','examSumMark','SID'));
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
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.exams.list');
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
        return redirect()->route('admin.exams.show',$exam->id);
    }


    public function show(Request $request,$id)
    {
        $SID=410;
        $exam=Exams::find($id);
        $user=Auth::user();
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.exams.list');
        }
        $examQuestions=ExamsQuestions::where('exams_id','=',$exam->id)->orderBy('id','DESC')->get();
        $examSumMark=ExamsQuestions::where([['exams_id','=',$exam->id],['status','>',0]])->sum('mark');
        return view('admin.exams.show',compact('exam','examQuestions','examSumMark','SID'));
    }

    public function questionsCreate(Request $request,$id)
    {
        $exam=Exams::find($id);
        $SID=410;
        $user=Auth::user();
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.exams.list');
        }
        $examQuestions=ExamsQuestions::where('exams_id','=',$exam->id)->orderBy('id','DESC')->get();
        $examSumMark=ExamsQuestions::where([['exams_id','=',$exam->id],['status','>',0]])->sum('mark');
        return view('admin.exams.question-create',compact('exam','examQuestions','examSumMark','SID'));
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
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.exams.list');
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
            return redirect()->route('admin.exams.show',$exam->id);

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
            return redirect()->route('admin.exams.show',$exam->id);
        }else{
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.exams.list');
        }


    }

    public function questionsEdit(Request $request,$id)
    {
        $SID=410;
        $examsQuestion=ExamsQuestions::find($id);
        $user=Auth::user();
        if(!isset($examsQuestion->id) )
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.exams.list');
        }

        $exam=Exams::find($examsQuestion->exams_id);
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.exams.list');
        }
        $examsQuestionsOptions=ExamsQuestionsOptions::where('exams_questions_id','=',$examsQuestion->id)->get();
        return view('admin.exams.question-edit',compact('exam','examsQuestion','examsQuestionsOptions','SID'));
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
        if(!isset($examsQuestion->id) )
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.exams.list');
        }

        $exam=Exams::find($examsQuestion->exams_id);
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.exams.list');
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
            return redirect()->route('admin.exams.show',$exam->id);

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
            ExamsQuestionsOptions::where('exams_questions_id','=',$examsQuestion->id)->delete();
            alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
            return redirect()->route('admin.exams.show',$exam->id);
        }else{
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.exams.list');
        }


    }


    public function showResult(Request $request)
    {
//        class_rooms_teachers_id
//        class_rooms_id
//        exams_id
        $classRoomsTeachers=ClassRoomsTeachers::find($request->class_rooms_teachers_id);
        if(!isset($classRoomsTeachers->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.class.list');
        }
        $classRooms=ClassRooms::find($request->class_rooms_id);
        if(!isset($classRooms->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.class.list');
        }
        $exam=Exams::find($request->exams_id);
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.class.list');
        }
        $examsResponseTeachers=ExamsResponseTeachers::where([['class_rooms_teachers_id','=',$classRoomsTeachers->id],['exams_id','=',$exam->id],['class_rooms_id','=',$classRooms->id]])->get();
        $examsResponseTeachersArray=array();
        foreach ($examsResponseTeachers as $examsResponseTeacher)
        {
            $examsResponseTeachersArray[$examsResponseTeacher->exams_questions_id]=$examsResponseTeacher;
        }
        $SID=410;
        //dd($exam->examsQuestions()[1]->examsQuestionsOptions()->get());
        return view('admin.exams.show-result',compact('exam','examsResponseTeachers','classRoomsTeachers','examsResponseTeachersArray','SID'));

    }

    public function showResultSave(Request $request)
    {
        $request->validate([
            'class_rooms_teachers_id' => ['required'],
            't_mark' => ['required'],
            'a_mark' => ['required'],
            'mark' => ['required'],
        ]);
        $classRoomsTeachers=ClassRoomsTeachers::find($request->class_rooms_teachers_id);

        if(!isset($classRoomsTeachers->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('admin.class.list');
        }
        if(isset($request->flag_mark) and !empty($request->flag_mark))
        {
            foreach ($request->flag_mark as $examsResponseTeacherId )
            {
                $examsResponseTeacher=ExamsResponseTeachers::find($examsResponseTeacherId);
                if(isset($examsResponseTeacher->id) and $examsResponseTeacher->class_rooms_teachers_id == $classRoomsTeachers->id and isset($request['mark_'.$examsResponseTeacherId]))
                {
                    $examsResponseTeacher->update([
                        'mark'=>$request['mark_'.$examsResponseTeacherId],
                    ]);
                }

            }
        }
        //dd($classRoomsTeachers);
        $classRoomsTeachers->update([
            't_mark'=>$request->t_mark,
            'a_mark'=>$request->a_mark,
            'mark'=>$request->mark,
        ]);

        return redirect()->route('admin.class.show',$classRoomsTeachers->class_rooms_id);

    }

}
