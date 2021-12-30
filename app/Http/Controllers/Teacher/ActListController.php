<?php

namespace App\Http\Controllers\Teacher;

use Adlino\Locations\Facades\locations;
use App\ActListHefz;
use App\ActListHefzT;
use App\ActListPublic;
use App\Cities;
use App\ClassRooms;
use App\ClassRoomsStudents;
use App\ClassRoomsTeachers;
use App\Exams;
use App\Field;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Controller;
use App\MarkType;
use App\Payment;
use App\Providers\MyProvider;
use App\Provinces;
use App\SiteDetails;
use App\Students;
use App\StudentsFields;
use App\Teachers;
use App\TeachersDocuments;
use App\TeachersFields;
use App\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use SoapClient;

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
            case 'act_list_heft_t':
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
                $listHefz=ActListHefz::where('class_rooms_students_id','=',$classRoomsStudents->id)->get();
                return view('teacher.pages.act.list-hefz',compact('listHefz','classRooms','classRoomsStudents','student'));
                break;
            case 'act_list_heft_t':
                $listHefzT=ActListHefzT::where('class_rooms_students_id','=',$classRoomsStudents->id)->get();
                return view('teacher.pages.act.list-hefz-t',compact('listHefzT','classRooms','classRoomsStudents','student'));
                break;
            default:
                alert()->error('نوع لیست کلاس وجود ندارد',__('web/messages.alert'));
                return redirect()->route('teacher.class.list');
        }
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
                $listHefz=ActListHefz::where('class_rooms_students_id','=',$classRoomsStudents->id)->get();
                return view('teacher.pages.act.list-hefz',compact('listHefz','classRooms','classRoomsStudents','student'));
                break;
            case 'act_list_heft_t':
                $listHefzT=ActListHefzT::where('class_rooms_students_id','=',$classRoomsStudents->id)->get();
                return view('teacher.pages.act.list-hefz-t',compact('listHefzT','classRooms','classRoomsStudents','student'));
                break;
            default:
                alert()->error('نوع لیست کلاس وجود ندارد',__('web/messages.alert'));
                return redirect()->route('teacher.class.list');
        }
    }
}
