<?php

namespace App\Http\Controllers\Teacher;


use App\ActListHefz;
use App\ActListHefzT;
use App\ActListPublic;
use App\ClassRooms;
use App\ClassRoomsStudents;
use App\Providers\MyProvider;
use App\Students;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActListController extends TeacherController
{
    public function actListShow(Request $request)
    {
        $request->validate([
            'class_rooms_students_id' => ['required'],
        ]);
        $user=Auth::user();
        $classRoomsStudents=ClassRoomsStudents::find($request->class_rooms_students_id);
        if(!isset($classRoomsStudents->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $classRooms=ClassRooms::find($request->class_rooms_id);
        if(!isset($classRooms->id) or $user->id!=$classRooms->user_id)
        {
            alert()->error('کلاس انتخابی وجود ندارد',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $student=Students::find($classRoomsStudents->student_id);
        if(!isset($student->id))
        {
            alert()->error('قرآن آموز انتخابی وجود ندارد',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        switch ($classRooms->act_list_name)
        {
            case 'act_list_public':
                $listPublics=ActListPublic::where('class_rooms_students_id','=',$classRoomsStudents->id)->orderBy('id','desc')->get();
                return view('teacher.pages.act.list-public',compact('listPublics','classRooms','classRoomsStudents','student'));
                break;
            case 'act_list_hefz':
                $listHefz=ActListHefz::where('class_rooms_students_id','=',$classRoomsStudents->id)->orderBy('id','desc')->get();
                return view('teacher.pages.act.list-hefz',compact('listHefz','classRooms','classRoomsStudents','student'));
                break;
            case 'act_list_hefz_t':
                $listHefzT=ActListHefzT::where('class_rooms_students_id','=',$classRoomsStudents->id)->orderBy('id','desc')->get();
                return view('teacher.pages.act.list-hefz-t',compact('listHefzT','classRooms','classRoomsStudents','student'));
                break;
            default:
                alert()->error('نوع لیست کلاس وجود ندارد',__('web/messages.alert'));
                return redirect()->route('teacher.class.list');
        }
    }

    public function actListSave(Request $request)
    {
        $request->validate([
            'act_type' => ['required'],
            'class_rooms_id' => ['required'],
            'class_rooms_students_id' => ['required'],
            'presence' => ['required'],
            'date' => ['required'],
        ]);
        $user=Auth::user();
        $request->date=MyProvider::convert_phone_number($request->date);
        $date=explode('-',$request->date);
        $date=Verta::getGregorian($date[0],$date[1],$date[2]);
        $date=implode('-',$date);
        $date=$date.' '.'00:00:00';


        $classRoomsStudents=ClassRoomsStudents::find($request->class_rooms_students_id);
        if(!isset($classRoomsStudents->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $classRooms=ClassRooms::find($request->class_rooms_id);
        if(!isset($classRooms->id)  or $user->id!=$classRooms->user_id)
        {
            alert()->error('کلاس انتخابی وجود ندارد',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $student=Students::find($classRoomsStudents->student_id);
        if(!isset($student->id))
        {
            alert()->error('قرآن آموز انتخابی وجود ندارد',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        switch ($request->act_type)
        {
            case 'act_list_public':
                $listPublic=ActListPublic::create([
                    'user_id'=>$user->id,
                    'user_id_teacher'=>$user->id,
                    'user_id_student'=>$student->id,
                    'class_rooms_id'=>$classRooms->id,
                    'class_rooms_students_id'=>$classRoomsStudents->id,
                    'date'=>$date,
                    'description'=>$request->description,
                    'mark'=>$request->mark,
                    'presence'=>$request->presence,
                ]);
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);
                break;
            case 'act_list_hefz':
                $listHefz=ActListHefz::create([
                    'user_id'=>$user->id,
                    'user_id_teacher'=>$user->id,
                    'user_id_student'=>$student->id,
                    'class_rooms_id'=>$classRooms->id,
                    'class_rooms_students_id'=>$classRoomsStudents->id,
                    'date'=>$date,
                    'description'=>$request->description,
                    'mark_hefz'=>$request->mark_hefz,
                    'mark_dah_dars'=>$request->mark_dah_dars,
                    'mark_d1'=>$request->mark_d1,
                    'j_d1'=>$request->j_d1=='NULL'?NULL:$request->j_d1,
                    'mark_d2'=>$request->mark_d2,
                    'j_d2'=>$request->j_d2=='NULL'?NULL:$request->j_d2,
                    'mark_d3'=>$request->mark_d3,
                    'j_d3'=>$request->j_d3=='NULL'?NULL:$request->j_d3,
                    'presence'=>$request->presence,
                ]);
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);
                break;
            case 'act_list_hefz_t':
                $listHefz=ActListHefzT::create([
                    'user_id'=>$user->id,
                    'user_id_teacher'=>$user->id,
                    'user_id_student'=>$student->id,
                    'class_rooms_id'=>$classRooms->id,
                    'class_rooms_students_id'=>$classRoomsStudents->id,
                    'date'=>$date,
                    'description'=>$request->description,
                    'mark_hefz'=>$request->mark_hefz,
                    'mark_do_dars'=>$request->mark_do_dars,
                    'mark_hasht_dars'=>$request->mark_hasht_dars,
                    'mark_d1'=>$request->mark_d1,
                    'j_d1'=>$request->j_d1=='NULL'?NULL:$request->j_d1,
                    'mark_d2'=>$request->mark_d2,
                    'j_d2'=>$request->j_d2=='NULL'?NULL:$request->j_d2,
                    'mark_d3'=>$request->mark_d3,
                    'j_d3'=>$request->j_d3=='NULL'?NULL:$request->j_d3,
                    'mark_d4'=>$request->mark_d4,
                    'j_d4'=>$request->j_d4=='NULL'?NULL:$request->j_d4,
                    'mark_d5'=>$request->mark_d5,
                    'j_d5'=>$request->j_d5=='NULL'?NULL:$request->j_d5,
                    'mark_d6'=>$request->mark_d6,
                    'j_d6'=>$request->j_d6=='NULL'?NULL:$request->j_d6,
                    'mark_hefz_t'=>$request->mark_hefz_t,
                    's_h_t'=>$request->s_h_t,
                    'presence'=>$request->presence,
                ]);
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);
                break;
            default:
                alert()->error('نوع لیست کلاس وجود ندارد',__('web/messages.alert'));
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);}
    }

    public function actListDelete(Request $request)
    {
        $request->validate([
            'act_id' => ['required'],
            'act_type' => ['required'],
        ]);
        $user=Auth::user();
        $classRoomsStudents=ClassRoomsStudents::find($request->class_rooms_students_id);
        if(!isset($classRoomsStudents->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $classRooms=ClassRooms::find($request->class_rooms_id);
        if(!isset($classRooms->id)  or $user->id!=$classRooms->user_id)
        {
            alert()->error('کلاس انتخابی وجود ندارد',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $student=Students::find($classRoomsStudents->student_id);
        if(!isset($student->id))
        {
            alert()->error('قرآن آموز انتخابی وجود ندارد',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        switch ($request->act_type)
        {
            case 'act_list_public':
                ActListPublic::find($request->act_id)->delete();
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);
                break;
            case 'act_list_hefz':
                ActListHefz::find($request->act_id)->delete();
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);
                break;
            case 'act_list_hefz_t':
                ActListHefzT::find($request->act_id)->delete();
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);
                break;
            default:
                alert()->error('نوع لیست کلاس وجود ندارد',__('web/messages.alert'));
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);
        }
    }
    public function actListEdit(Request $request)
    {
        $request->validate([
            'act_id' => ['required'],
            'act_type' => ['required'],
        ]);
        $user=Auth::user();
        $classRoomsStudents=ClassRoomsStudents::find($request->class_rooms_students_id);
        if(!isset($classRoomsStudents->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $classRooms=ClassRooms::find($request->class_rooms_id);
        if(!isset($classRooms->id)  or $user->id!=$classRooms->user_id)
        {
            alert()->error('کلاس انتخابی وجود ندارد',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $student=Students::find($classRoomsStudents->student_id);
        if(!isset($student->id))
        {
            alert()->error('قرآن آموز انتخابی وجود ندارد',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $act_type=$request->act_type;
        switch ($act_type)
        {
            case 'act_list_public':
                $act=ActListPublic::find($request->act_id);
                if(!isset($act->id))
                {
                    alert()->error('قرآن آموز انتخابی وجود ندارد',__('web/messages.alert'));
                    return redirect()->route('teacher.class.list');
                }
                return view('teacher.pages.act.list-edit',compact('act','classRooms','classRoomsStudents','student','act_type'));
                break;
            case 'act_list_hefz':
                $act=ActListHefz::find($request->act_id);
                if(!isset($act->id))
                {
                    alert()->error('قرآن آموز انتخابی وجود ندارد',__('web/messages.alert'));
                    return redirect()->route('teacher.class.list');
                }
                return view('teacher.pages.act.list-edit',compact('act','classRooms','classRoomsStudents','student','act_type'));
                break;
            case 'act_list_hefz_t':
                $act=ActListHefzT::find($request->act_id);
                if(!isset($act->id))
                {
                    alert()->error('قرآن آموز انتخابی وجود ندارد',__('web/messages.alert'));
                    return redirect()->route('teacher.class.list');
                }
                return view('teacher.pages.act.list-edit',compact('act','classRooms','classRoomsStudents','student','act_type'));
                break;
            default:
                alert()->error('نوع لیست کلاس وجود ندارد',__('web/messages.alert'));
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);
        }
    }


    public function actListEditSave(Request $request)
    {
        $request->validate([
            'act_type' => ['required'],
            'class_rooms_id' => ['required'],
            'class_rooms_students_id' => ['required'],
            'presence' => ['required'],
            'date' => ['required'],
            'act_id'=>['required'],
        ]);
        $user=Auth::user();
        $request->date=MyProvider::convert_phone_number($request->date);
        $date=explode('-',$request->date);
        $date=Verta::getGregorian($date[0],$date[1],$date[2]);
        $date=implode('-',$date);
        $date=$date.' '.'00:00:00';


        $classRoomsStudents=ClassRoomsStudents::find($request->class_rooms_students_id);
        if(!isset($classRoomsStudents->id))
        {
            alert()->error('خطا در اطلاعات رخ داده مجدد تلاش کنید',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $classRooms=ClassRooms::find($request->class_rooms_id);
        if(!isset($classRooms->id)  or $user->id!=$classRooms->user_id)
        {
            alert()->error('کلاس انتخابی وجود ندارد',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $student=Students::find($classRoomsStudents->student_id);
        if(!isset($student->id))
        {
            alert()->error('قرآن آموز انتخابی وجود ندارد',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        switch ($request->act_type)
        {
            case 'act_list_public':
                $act=ActListPublic::find($request->act_id);
                if(!isset($act->id))
                {
                    alert()->error('قرآن آموز انتخابی وجود ندارد',__('web/messages.alert'));
                    return redirect()->route('teacher.class.list');
                }
                $act->update([
                    'user_id'=>$user->id,
                    'user_id_teacher'=>$user->id,
                    'user_id_student'=>$student->id,
                    'class_rooms_id'=>$classRooms->id,
                    'class_rooms_students_id'=>$classRoomsStudents->id,
                    'date'=>$date,
                    'description'=>$request->description,
                    'mark'=>$request->mark,
                    'presence'=>$request->presence,
                ]);
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);
                break;
            case 'act_list_hefz':
                $act=ActListHefz::find($request->act_id);
                if(!isset($act->id))
                {
                    alert()->error('قرآن آموز انتخابی وجود ندارد',__('web/messages.alert'));
                    return redirect()->route('teacher.class.list');
                }
                $act->update([
                    'user_id'=>$user->id,
                    'user_id_teacher'=>$user->id,
                    'user_id_student'=>$student->id,
                    'class_rooms_id'=>$classRooms->id,
                    'class_rooms_students_id'=>$classRoomsStudents->id,
                    'date'=>$date,
                    'description'=>$request->description,
                    'mark_hefz'=>$request->mark_hefz,
                    'mark_dah_dars'=>$request->mark_dah_dars,
                    'mark_d1'=>$request->mark_d1,
                    'j_d1'=>$request->j_d1=='NULL'?NULL:$request->j_d1,
                    'mark_d2'=>$request->mark_d2,
                    'j_d2'=>$request->j_d2=='NULL'?NULL:$request->j_d2,
                    'mark_d3'=>$request->mark_d3,
                    'j_d3'=>$request->j_d3=='NULL'?NULL:$request->j_d3,
                    'presence'=>$request->presence,
                ]);
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);
                break;
            case 'act_list_hefz_t':
                $act=ActListHefzT::find($request->act_id);
                if(!isset($act->id))
                {
                    alert()->error('قرآن آموز انتخابی وجود ندارد',__('web/messages.alert'));
                    return redirect()->route('teacher.class.list');
                }
                $act->update([
                    'user_id'=>$user->id,
                    'user_id_teacher'=>$user->id,
                    'user_id_student'=>$student->id,
                    'class_rooms_id'=>$classRooms->id,
                    'class_rooms_students_id'=>$classRoomsStudents->id,
                    'date'=>$date,
                    'description'=>$request->description,
                    'mark_hefz'=>$request->mark_hefz,
                    'mark_do_dars'=>$request->mark_do_dars,
                    'mark_hasht_dars'=>$request->mark_hasht_dars,
                    'mark_d1'=>$request->mark_d1,
                    'j_d1'=>$request->j_d1=='NULL'?NULL:$request->j_d1,
                    'mark_d2'=>$request->mark_d2,
                    'j_d2'=>$request->j_d2=='NULL'?NULL:$request->j_d2,
                    'mark_d3'=>$request->mark_d3,
                    'j_d3'=>$request->j_d3=='NULL'?NULL:$request->j_d3,
                    'mark_d4'=>$request->mark_d4,
                    'j_d4'=>$request->j_d4=='NULL'?NULL:$request->j_d4,
                    'mark_d5'=>$request->mark_d5,
                    'j_d5'=>$request->j_d5=='NULL'?NULL:$request->j_d5,
                    'mark_d6'=>$request->mark_d6,
                    'j_d6'=>$request->j_d6=='NULL'?NULL:$request->j_d6,
                    'mark_hefz_t'=>$request->mark_hefz_t,
                    's_h_t'=>$request->s_h_t,
                    'presence'=>$request->presence,
                ]);
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);
                break;
            default:
                alert()->error('نوع لیست کلاس وجود ندارد',__('web/messages.alert'));
                return redirect()->route('teacher.act.list.show',['class_rooms_students_id'=>$classRoomsStudents->id,'class_rooms_id'=>$classRooms->id]);}
    }
}
