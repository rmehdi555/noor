<?php

namespace App\Http\Controllers\Teacher;

use App\ClassRooms;
use App\ClassRoomsStudents;
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

        if(!isset($request->description) or empty($request->description))
            $request->description=NULL;
        $exam=Exams::create([
            'user_id'=>$user->id,
            'title'=>$request->title,
            'description'=>$request->description,
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
        if(!isset($request->description) or empty($request->description))
            $request->description=NULL;

        $exam->update([
            'title'=>$request->title,
            'description'=>$request->description,
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
            ExamsQuestionsOptions::where('exams_questions_id','=',$examsQuestion->id)->delete();
            alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
            return redirect()->route('teacher.exams.show',$exam->id);
        }else{
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.exams.list');
        }


    }


    public function response(Request $request,$id)
    {
        $classRoomsTeachers=ClassRoomsTeachers::find($id);
        $user=Auth::user();
        $user=User::find($user->id);
        if(!isset($classRoomsTeachers->id) or $classRoomsTeachers->teacher_id!=$user->teacher->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        $exam=Exams::find($classRoomsTeachers->classRooms->exam_id);
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        if($exam->start_exam>now())
        {
            alert()->error('هنوز زمان شروع آزمون فرانرسیده است .',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        if($exam->end_exam<now().'-5 minutes')
        {
            alert()->error('زمان آزمون به اتمام رسیده است .',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        $examsQuestionsTest=ExamsQuestions::where([['type','=','test'],['status','=','1'],['exams_id','=',$exam->id]])->get();
        $examsQuestionsAdj=ExamsQuestions::where([['type','=','adj'],['status','=','1'],['exams_id','=',$exam->id]])->get();
        $countAdj=count($examsQuestionsAdj);
        if($classRoomsTeachers->status>2)
        {
            alert()->error('شما قبلا در آزمون شرکت کرده اید',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');        }
        if($classRoomsTeachers->status==1 and count($examsQuestionsTest)>0)
        {
            return view('teacher.pages.exams.response-test',compact('exam','classRoomsTeachers','examsQuestionsTest','countAdj'));
        }
        if($classRoomsTeachers->status==2 and count($examsQuestionsAdj)<1)
        {
            //آزمون فقط تستی بوده
            alert()->error('شما قبلا در آزمون شرکت کرده اید',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        if($classRoomsTeachers->status==2 or count($examsQuestionsTest)<1)
        {
            return view('teacher.pages.exams.response-adj',compact('exam','classRoomsTeachers','examsQuestionsAdj'));
        }


    }

    public function responseTestSave(Request $request)
    {

        $classRoomsTeachers=ClassRoomsTeachers::find($request->class_rooms_teachers);
        $user=Auth::user();
        $user=User::find($user->id);
        if(!isset($classRoomsTeachers->id) or $classRoomsTeachers->teacher_id!=$user->teacher->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        $exam=Exams::find($request->exams_id);
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        if($exam->start_exam>now())
        {
            alert()->error('هنوز زمان شروع آزمون فرانرسیده است .',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        if($exam->end_exam<now().'-5 minutes')
        {
            alert()->error('به دلیل اتمام زمان آزمون پاسخ های شما ثبت نخواهد شد .',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        $examsQuestionsTest=ExamsQuestions::where([['type','=','test'],['status','=','1'],['exams_id','=',$exam->id]])->get();

        $mark_all=0;
        foreach ($examsQuestionsTest as $question)
        {
            if(isset($request['test_response_'.$question->id]))
            {
                $mark=0;
                if($question->response==$request['test_response_'.$question->id])
                {
                    $mark=$question->mark;
                }
                $mark_all+=$mark;
                ExamsResponseTeachers::create([
                    'user_id'=>$user->id,
                    'teacher_id'=>$user->teacher->id,
                    'class_rooms_id'=>$classRoomsTeachers->class_rooms_id,
                    'class_rooms_teachers_id'=>$classRoomsTeachers->id,
                    'exams_id'=>$exam->id,
                    'exams_questions_id'=>$question->id,
                    'exams_questions_type'=>$question->type,
                    'response'=>$request['test_response_'.$question->id],
                    't_mark'=>$mark,
                    'status'=>1,
                ]);
            }

        }
        $classRoomsTeachers->update([
            'status'=>2,
            't_mark'=>$mark_all,
            'mark'=>$mark_all,
        ]);

        $examsQuestionsAdj=ExamsQuestions::where([['type','=','adj'],['status','=','1'],['exams_id','=',$exam->id]])->get();
        if(count($examsQuestionsAdj)<1)
        {
            alert()->success('پاسخ های شما با موفقیت ثبت گردید. ',__('web/messages.success'));
            return redirect()->route('teacher.class.teacher.list');
        }else{
            return redirect()->route('teacher.exams.response',$classRoomsTeachers->id);
        }

    }


    public function responseAdjSave(Request $request)
    {
        $classRoomsTeachers=ClassRoomsTeachers::find($request->class_rooms_teachers);
        $user=Auth::user();
        $user=User::find($user->id);
        if(!isset($classRoomsTeachers->id) or $classRoomsTeachers->teacher_id!=$user->teacher->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        $exam=Exams::find($request->exams_id);
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        if($exam->start_exam>now())
        {
            alert()->error('هنوز زمان شروع آزمون فرانرسیده است .',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        if($exam->end_exam<now().'-5 minutes')
        {
            alert()->error('به دلیل اتمام زمان آزمون پاسخ های شما ثبت نخواهد شد .',__('web/messages.alert'));
            return redirect()->route('teacher.class.teacher.list');
        }
        $examsQuestionsAdj=ExamsQuestions::where([['type','=','adj'],['status','=','1'],['exams_id','=',$exam->id]])->get();

        foreach ($examsQuestionsAdj as $question)
        {
            if(isset($request['adj_response_'.$question->id]))
            {

                ExamsResponseTeachers::create([
                    'user_id'=>$user->id,
                    'teacher_id'=>$user->teacher->id,
                    'class_rooms_id'=>$classRoomsTeachers->class_rooms_id,
                    'class_rooms_teachers_id'=>$classRoomsTeachers->id,
                    'exams_id'=>$exam->id,
                    'exams_questions_id'=>$question->id,
                    'exams_questions_type'=>$question->type,
                    'response'=>$request['adj_response_'.$question->id],
                    't_mark'=>0,
                    'status'=>1,
                ]);
            }

        }
        $classRoomsTeachers->update([
            'status'=>3,
        ]);

            alert()->success('پاسخ های شما با موفقیت ثبت گردید. ',__('web/messages.success'));
            return redirect()->route('teacher.class.teacher.list');

    }


    public function showResult(Request $request)
    {
        $request->validate([
            'user_type' => ['required'],
        ]);
        if($request->user_type=='teacher')
        {
            $classRoomsTeachers=ClassRoomsTeachers::find($request->class_rooms_teachers_id);
            if(!isset($classRoomsTeachers->id))
            {
                alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
                return redirect()->route('teacher.class.list');
            }
            $classRooms=ClassRooms::find($request->class_rooms_id);
            if(!isset($classRooms->id))
            {
                alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
                return redirect()->route('teacher.class.list');
            }
            $exam=Exams::find($request->exams_id);
            if(!isset($exam->id))
            {
                alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
                return redirect()->route('teacher.class.list');
            }
            $examsResponseTeachers=ExamsResponseTeachers::where([['class_rooms_teachers_id','=',$classRoomsTeachers->id],['exams_id','=',$exam->id],['class_rooms_id','=',$classRooms->id]])->get();
            $examsResponseTeachersArray=array();
            foreach ($examsResponseTeachers as $examsResponseTeacher)
            {
                $examsResponseTeachersArray[$examsResponseTeacher->exams_questions_id]=$examsResponseTeacher;
            }
            $SID=410;
            //dd($exam->examsQuestions()[1]->examsQuestionsOptions()->get());
            return view('teacher.pages.exams.show-result-teacher',compact('exam','examsResponseTeachers','classRoomsTeachers','examsResponseTeachersArray','classRooms','SID'));


        }elseif($request->user_type=='student')
        {
            $classRoomsStudents=ClassRoomsStudents::find($request->class_rooms_students_id);
            if(!isset($classRoomsStudents->id))
            {
                alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
                return redirect()->route('teacher.class.list');
            }
            $classRooms=ClassRooms::find($request->class_rooms_id);
            if(!isset($classRooms->id))
            {
                alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
                return redirect()->route('teacher.class.list');
            }
            $exam=Exams::find($request->exams_id);
            if(!isset($exam->id))
            {
                alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
                return redirect()->route('teacher.class.list');
            }
            $examsResponseStudents=ExamsResponseStudents::where([['class_rooms_students_id','=',$classRoomsStudents->id],['exams_id','=',$exam->id],['class_rooms_id','=',$classRooms->id]])->get();
            $examsResponseStudentsArray=array();
            foreach ($examsResponseStudents as $examsResponseTeacher)
            {
                $examsResponseStudentsArray[$examsResponseTeacher->exams_questions_id]=$examsResponseTeacher;
            }
            $SID=410;
            //dd($exam->examsQuestions()[1]->examsQuestionsOptions()->get());
            return view('teacher.pages.exams.show-result-student',compact('exam','examsResponseStudents','classRoomsStudents','examsResponseStudentsArray','classRooms','SID'));


        }else{
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }

    }

    public function showResultSave(Request $request)
    {
        $request->validate([
            't_mark' => ['required'],
            'a_mark' => ['required'],
            'mark' => ['required'],
            'user_type' => ['required'],
        ]);
        if ($request->user_type == 'teacher') {
            $classRoomsTeachers = ClassRoomsTeachers::find($request->class_rooms_teachers_id);

            if (!isset($classRoomsTeachers->id)) {
                alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید', __('web/messages.alert'));
                return redirect()->route('teacher.class.list');
            }
            if (isset($request->flag_mark) and !empty($request->flag_mark)) {
                foreach ($request->flag_mark as $examsResponseTeacherId) {
                    $examsResponseTeacher = ExamsResponseTeachers::find($examsResponseTeacherId);
                    if (isset($examsResponseTeacher->id) and $examsResponseTeacher->class_rooms_teachers_id == $classRoomsTeachers->id and isset($request['mark_' . $examsResponseTeacherId])) {
                        $examsResponseTeacher->update([
                            'mark' => $request['mark_' . $examsResponseTeacherId],
                        ]);
                    }

                }
            }
            //dd($classRoomsTeachers);
            $classRoomsTeachers->update([
                't_mark' => $request->t_mark,
                'a_mark' => $request->a_mark,
                'mark' => $request->mark,
            ]);

            return redirect()->route('teacher.class.show', $classRoomsTeachers->class_rooms_id);

        } elseif ($request->user_type == 'student') {
            $classRoomsStudents = ClassRoomsStudents::find($request->class_rooms_students_id);

            if (!isset($classRoomsStudents->id)) {
                alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید', __('web/messages.alert'));
                return redirect()->route('teacher.class.list');
            }
            if (isset($request->flag_mark) and !empty($request->flag_mark)) {
                foreach ($request->flag_mark as $examsResponseStudentId) {
                    $examsResponseStudent = ExamsResponseStudents::find($examsResponseStudentId);
                    if (isset($examsResponseStudent->id) and $examsResponseStudent->class_rooms_students_id == $classRoomsStudents->id and isset($request['mark_' . $examsResponseStudentId])) {
                        $examsResponseStudent->update([
                            'mark' => $request['mark_' . $examsResponseStudentId],
                        ]);
                    }

                }
            }
            //dd($classRoomsStudents);
            $classRoomsStudents->update([
                't_mark' => $request->t_mark,
                'a_mark' => $request->a_mark,
                'mark' => $request->mark,
            ]);

            return redirect()->route('teacher.class.show', $classRoomsStudents->class_rooms_id);

        } else {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید', __('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }

    }








    }
