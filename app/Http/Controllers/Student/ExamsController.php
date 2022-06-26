<?php

namespace App\Http\Controllers\Student;

use App\ClassRooms;
use App\ClassRoomsStudents;
use App\Exams;
use App\ExamsQuestions;
use App\ExamsQuestionsOptions;
use App\ExamsResponseStudents;
use App\Providers\MyProvider;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* exams
 * status=1 فعال
 */
class ExamsController extends StudentController
{


    public function response(Request $request,$id)
    {
        $classRoomsStudents=ClassRoomsStudents::find($id);
        $user=Auth::user();
        $user=User::find($user->id);
        if(!isset($classRoomsStudents->id) or $classRoomsStudents->student_id!=$user->student->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        $exam=Exams::find($classRoomsStudents->classRooms->exam_id);
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        if($exam->start_exam>now())
        {
            alert()->error('هنوز زمان شروع آزمون فرانرسیده است .',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        if($exam->end_exam<now().'- 5 minutes')
        {
            alert()->error('زمان آزمون به اتمام رسیده است .',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        $examsQuestionsTest=ExamsQuestions::where([['type','=','test'],['status','=','1'],['exams_id','=',$exam->id]])->get();
        $examsQuestionsAdj=ExamsQuestions::where([['type','=','adj'],['status','=','1'],['exams_id','=',$exam->id]])->get();
        $countAdj=count($examsQuestionsAdj);
        if($classRoomsStudents->status>2)
        {
            alert()->error('شما قبلا در آزمون شرکت کرده اید',__('web/messages.alert'));
            return redirect()->route('student.class.list');        }
        if($classRoomsStudents->status==1 and count($examsQuestionsTest)>0)
        {
            return view('student.pages.exams.response-test',compact('exam','classRoomsStudents','examsQuestionsTest','countAdj'));
        }
        if($classRoomsStudents->status==2 and count($examsQuestionsAdj)<1)
        {
            //آزمون فقط تستی بوده
            alert()->error('شما قبلا در آزمون شرکت کرده اید',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        if($classRoomsStudents->status==2 or count($examsQuestionsTest)<1)
        {
            return view('student.pages.exams.response-adj',compact('exam','classRoomsStudents','examsQuestionsAdj'));
        }


    }

    public function responseTestSave(Request $request)
    {

        $classRoomsStudents=ClassRoomsStudents::find($request->class_rooms_students);
        $user=Auth::user();
        $user=User::find($user->id);
        if(!isset($classRoomsStudents->id) or $classRoomsStudents->student_id!=$user->student->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        $exam=Exams::find($request->exams_id);
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        if($exam->start_exam>now())
        {
            alert()->error('هنوز زمان شروع آزمون فرانرسیده است .',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        if($exam->end_exam<now().'-5 minutes')
        {
            alert()->error('به دلیل اتمام زمان آزمون پاسخ های شما ثبت نخواهد شد .',__('web/messages.alert'));
            return redirect()->route('student.class.list');
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
                ExamsResponseStudents::create([
                    'user_id'=>$user->id,
                    'student_id'=>$user->student->id,
                    'class_rooms_id'=>$classRoomsStudents->class_rooms_id,
                    'class_rooms_students_id'=>$classRoomsStudents->id,
                    'exams_id'=>$exam->id,
                    'exams_questions_id'=>$question->id,
                    'exams_questions_type'=>$question->type,
                    'response'=>$request['test_response_'.$question->id],
                    't_mark'=>$mark,
                    'status'=>1,
                ]);
            }

        }
        $classRoomsStudents->update([
            'status'=>2,
            't_mark'=>$mark_all,
            'mark'=>$mark_all,
        ]);

        $examsQuestionsAdj=ExamsQuestions::where([['type','=','adj'],['status','=','1'],['exams_id','=',$exam->id]])->get();
        if(count($examsQuestionsAdj)<1)
        {
            alert()->success('پاسخ های شما با موفقیت ثبت گردید. ',__('web/messages.success'));
            return redirect()->route('student.class.list');
        }else{
            return redirect()->route('student.exams.response',$classRoomsStudents->id);
        }

    }


    public function responseAdjSave(Request $request)
    {
        $classRoomsStudents=ClassRoomsStudents::find($request->class_rooms_students);
        $user=Auth::user();
        $user=User::find($user->id);
        if(!isset($classRoomsStudents->id) or $classRoomsStudents->student_id!=$user->student->id)
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        $exam=Exams::find($request->exams_id);
        if(!isset($exam->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        if($exam->start_exam>now())
        {
            alert()->error('هنوز زمان شروع آزمون فرانرسیده است .',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        if($exam->end_exam<now().'-5 minutes')
        {
            alert()->error('به دلیل اتمام زمان آزمون پاسخ های شما ثبت نخواهد شد .',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        $examsQuestionsAdj=ExamsQuestions::where([['type','=','adj'],['status','=','1'],['exams_id','=',$exam->id]])->get();

        foreach ($examsQuestionsAdj as $question)
        {
            if(isset($request['adj_response_'.$question->id]))
            {

                ExamsResponseStudents::create([
                    'user_id'=>$user->id,
                    'student_id'=>$user->student->id,
                    'class_rooms_id'=>$classRoomsStudents->class_rooms_id,
                    'class_rooms_students_id'=>$classRoomsStudents->id,
                    'exams_id'=>$exam->id,
                    'exams_questions_id'=>$question->id,
                    'exams_questions_type'=>$question->type,
                    'response'=>$request['adj_response_'.$question->id],
                    't_mark'=>0,
                    'status'=>1,
                ]);
            }

        }
        $classRoomsStudents->update([
            'status'=>3,
        ]);

            alert()->success('پاسخ های شما با موفقیت ثبت گردید. ',__('web/messages.success'));
            return redirect()->route('student.class.list');

    }












}
