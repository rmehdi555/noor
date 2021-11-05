<?php

namespace App\Http\Controllers\Teacher;

use Adlino\Locations\Facades\locations;
use App\Cities;
use App\ClassRooms;
use App\ClassRoomsStudents;
use App\Field;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Controller;
use App\Payment;
use App\Provinces;
use App\SiteDetails;
use App\StudentsFields;
use App\Teachers;
use App\TeachersDocuments;
use App\TeachersFields;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use SoapClient;

/* class
 * status=1 تازه ایجاد شده
 * status=2 در حال برگذاری
 * status=4 آزمون
 * status=5 اتمام رسیده
 */
class ClassController extends TeacherController
{

    public function create()
    {
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        return view('teacher.pages.class-create', compact('fields','provinces','cities'));
    }

    public function createSave(Request $request)
    {
        $request->validate([
            'field_main' => ['required', 'numeric'],
            'field_child' => ['required','numeric'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'number_students' => ['required', 'string', 'max:255'],
            'old' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ]);
        $user=Auth::user();
        $field=Field::find($request->field_child);
        if(!isset($field->id))
        {
            alert()->error(__('web/messages.not_exist_student_field'),__('web/messages.alert'));
            return redirect()->route('teacher.class.create');
        }
        if($field->id==0)
        {
            alert()->error(__('web/messages.disabled_student_field'),__('web/messages.alert'));
            return redirect()->route('teacher.class.create');
        }

        $classRoom=ClassRooms::create([
            'user_id'=>$user->id,
            'field_id' => $request->field_child,
            'field_parent_id'=>$request->field_main,
            'name'=>$request->name,
            'description'=>$request->description,
            'number_students'=>$request->number_students,
            'old'=>$request->old,
            'city'=>$request->city,
            'province'=>$request->province,
            'address'=>$request->address,
            'status' => '1',
        ]);
        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
        return redirect()->route('teacher.class.show',$classRoom->id);
    }

    public function list()
    {
        $user=Auth::user();
        $classes=ClassRooms::where([['user_id','=',$user->id],['status','>',0]])->orderBy('id','DESC')->get();
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        return view('teacher.pages.class-list', compact('fields','provinces','cities','classes'));
    }

    public function show(Request $request,$id)
    {
        $classRoms=ClassRooms::find($id);
        if(!isset($classRoms->id))
        {

            alert()->error(__('not_exist'));
            return redirect()->route('teacher.class.list');
        }
        $user=Auth::user();
        if($classRoms->user_id!=$user->id) {
            alert()->error(__('not_exist'));
            return redirect()->route('teacher.class.list');
        }
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        $students=ClassRoomsStudents::where('class_rooms_id','=',$classRoms->id)->orderBy('id','DESC')->get();
        $studentsRegister=StudentsFields::where([['status','=',2],['field_id','=',$classRoms->field_id],['field_parent_id','=',$classRoms->field_parent_id]])->orderBy('id','DESC')->get();
        return view('teacher.pages.class-show', compact('fields','provinces','cities','classRoms','students','studentsRegister'));
    }

       public function registerSave(Request $request)
    {
        $request->validate([
            'studentFieldId' => ['required', 'numeric'],
            'classRoomsId'=> ['required', 'numeric'],
        ]);
        $user=Auth::user();
        $user=User::find($user->id);
        $classRoom=ClassRooms::find($request->classRoomsId);
        if(!isset($classRoom->id))
        {
            alert()->error(__('کلاس به درستی انتخاب نشده'),__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $field=StudentsFields::find($request->studentFieldId);
        if(!isset($field->id))
        {
            alert()->error(__('قرآن آموز به درستی انتخاب نشده'),__('web/messages.alert'));
            return redirect()->route('teacher.class.show',$classRoom->id);
        }
        ClassRoomsStudents::create([
            'user_id'=>$user->id,
            'field_id' => $field->field_id,
            'field_parent_id'=>$field->field_parent_id,
            'student_id'=>$field->student_id,
            'students_field_id'=>$field->id,
            'class_rooms_id'=>$classRoom->id,
            'teacher_id'=>$user->teacher->id,
            'status' => '1',
        ]);
        $field->update([
            'status'=>'3',
        ]);
        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
        return redirect()->route('teacher.class.show',$classRoom->id);
    }


    public function registerDelete(Request $request)
    {
        $request->validate([
            'class_room_student_id' => ['required', 'numeric'],
        ]);
        $user=Auth::user();
        $classRoomsStuden=ClassRoomsStudents::find($request->class_room_student_id);
        if(!isset($classRoomsStuden->id))
        {
            alert()->error(__('قرآن آموز به درستی انتخاب نشده'),__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        $field=StudentsFields::find($classRoomsStuden->students_field_id);
        if(!isset($field->id))
        {
            alert()->error(__('قرآن آموز به درستی انتخاب نشده'),__('web/messages.alert'));
            return redirect()->route('teacher.class.show',$classRoomsStuden->class_rooms_id);
        }
        $field->update([
            'status'=>'2',
        ]);
        $classRoomsStuden->update([
            'user_id_delete'=>$user->id,
        ]);
        $classRoomsStuden->forceDelete();
        alert()->success('حذف قرآن آموز از کلاس با موفقیت انجام شد', __('web/messages.success'));
        return redirect()->route('teacher.class.show',$classRoomsStuden->class_rooms_id);
    }


}
