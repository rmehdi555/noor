<?php

namespace App\Http\Controllers\Student;


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

class ActListController extends StudentController
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
            return redirect()->route('student.class.list');
        }
        $classRooms=ClassRooms::find($request->class_rooms_id);
        if(!isset($classRooms->id))
        {
            alert()->error('کلاس انتخابی وجود ندارد',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        $student=Students::find($classRoomsStudents->student_id);
    
        if(!isset($student->id) or $user->student->id!=$student->id)
        {
            alert()->error('قرآن آموز انتخابی وجود ندارد',__('web/messages.alert'));
            return redirect()->route('student.class.list');
        }
        switch ($classRooms->act_list_name)
        {
            case 'act_list_public':
                $listPublics=ActListPublic::where('class_rooms_students_id','=',$classRoomsStudents->id)->orderBy('id','desc')->get();
                return view('student.pages.act.list-public',compact('listPublics','classRooms','classRoomsStudents','student'));
                break;
            case 'act_list_hefz':
                $listHefz=ActListHefz::where('class_rooms_students_id','=',$classRoomsStudents->id)->orderBy('id','desc')->get();
                return view('student.pages.act.list-hefz',compact('listHefz','classRooms','classRoomsStudents','student'));
                break;
            case 'act_list_hefz_t':
                $listHefzT=ActListHefzT::where('class_rooms_students_id','=',$classRoomsStudents->id)->orderBy('id','desc')->get();
                return view('student.pages.act.list-hefz-t',compact('listHefzT','classRooms','classRoomsStudents','student'));
                break;
            default:
                alert()->error('نوع لیست کلاس وجود ندارد',__('web/messages.alert'));
                return redirect()->route('student.class.list');
        }
    }

}
