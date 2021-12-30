<?php

namespace App\Http\Controllers\Teacher;

use Adlino\Locations\Facades\locations;
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
 * status=2 در حال برگزاری
 * status=4 آزمون
 * status=5 اتمام رسیده
 */
class ClassController extends TeacherController
{

    public function create()
    {
        $fields = Field::where('type','=','student')->get();;
        $provinces = Provinces::all();
        $cities = Cities::all();
        $markTypes=MarkType::where('status','=',1)->get();
        $exams=Exams::all();
        return view('teacher.pages.class-create', compact('fields','provinces','cities','markTypes','exams'));
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
            'mark_type_id'=>['required', 'numeric'],
            'act_list_name'=>['required'],
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
        $markType=MarkType::find($request->mark_type_id);
        if(!isset($markType->id))
        {
            alert()->error('نوع نمره دهی را انتخاب نمایید',__('web/messages.alert'));
            return redirect()->route('teacher.class.create');
        }

        $classRoom=ClassRooms::create([
            'user_id'=>$user->id,
            'field_id' => $request->field_child,
            'field_parent_id'=>$field->parent_id,
            'name'=>$request->name,
            'mark_type'=>$markType->type,
            'mark_type_id'=>$request->mark_type_id,
            'description'=>$request->description,
            'number_students'=>$request->number_students,
            'old'=>$request->old,
            'city'=>$request->city,
            'province'=>$request->province,
            'address'=>$request->address,
            'exam_id'=>$request->exam_id,
            'act_list_name'=>$request->act_list_name,
            'type'=>'student',
            'status' => '1',
        ]);
        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
        return redirect()->route('teacher.class.show',$classRoom->id);
    }

    public function edit(Request $request,$id)
    {
        $classRoom=ClassRooms::find($id);
        $user=Auth::user();
        if(!isset($classRoom->id) or $user->id!=$classRoom->user_id)
        {
            alert()->error(__('not_exist'));
            return redirect()->route('teacher.class.list');
        }
        $fields = Field::where('type','=','student')->get();;
        $provinces = Provinces::all();
        $cities = Cities::all();
        $markTypes=MarkType::where('status','=',1)->get();
        $exams=Exams::all();
        return view('teacher.pages.class-edit', compact('fields','provinces','cities','markTypes','classRoom','exams'));
    }

    public function editSave(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'number_students' => ['required', 'string', 'max:255'],
            'old' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'mark_type_id'=>['required', 'numeric'],
            'act_list_name'=>['required'],
        ]);
        $classRoom=ClassRooms::find($request->class_room_id);
        $user=Auth::user();
        if(!isset($classRoom->id) or $user->id!=$classRoom->user_id)
        {
            alert()->error(__('not_exist'));
            return redirect()->route('teacher.class.list');
        }

        $markType=MarkType::find($request->mark_type_id);
        if(!isset($markType->id))
        {
            alert()->error('نوع نمره دهی را انتخاب نمایید',__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }

        $classRoom->update([
            'name'=>$request->name,
            'mark_type'=>$markType->type,
            'mark_type_id'=>$request->mark_type_id,
            'description'=>$request->description,
            'number_students'=>$request->number_students,
            'old'=>$request->old,
            'city'=>$request->city,
            'province'=>$request->province,
            'address'=>$request->address,
            'exam_id'=>$request->exam_id,
            'act_list_name'=>$request->act_list_name,
            'status' => $request->status,
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
        $classRooms=ClassRooms::find($id);
        if(!isset($classRooms->id))
        {

            alert()->error(__('not_exist'));
            return redirect()->route('teacher.class.list');
        }
        $user=Auth::user();
        if($classRooms->user_id!=$user->id) {
            alert()->error(__('not_exist'));
            return redirect()->route('teacher.class.list');
        }
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        $students=ClassRoomsStudents::where('class_rooms_id','=',$classRooms->id)->orderBy('id','DESC')->get();
        $studentsRegister=StudentsFields::where([['status','=',2],['field_id','=',$classRooms->field_id],['field_parent_id','=',$classRooms->field_parent_id]])->orderBy('id','DESC')->get();

        $teachers=Teachers::all();
        $teachersR=ClassRoomsTeachers::where('class_rooms_id','=',$classRooms->id)->orderBy('id','DESC')->get();


        return view('teacher.pages.class-show', compact('fields','provinces','cities','classRooms','students','studentsRegister','teachers','teachersR'));
    }

    public function registerSave(Request $request)
    {
        $request->validate([
            'classRoomsId'=> ['required', 'numeric'],
        ]);
        $user=Auth::user();
        $user=User::find($user->id);
        $classRoom=ClassRooms::find($request->classRoomsId);
        if(!isset($classRoom->id) or $user->id!=$classRoom->user_id)
        {
            alert()->error(__('کلاس به درستی انتخاب نشده'),__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }
        if($classRoom->type=="student")
        {
            $teacher=User::find($classRoom->user_id);
            if(!isset($teacher->id))
            {
                alert()->error(__('معلم این کلاس به درستی انتخاب نشده است'),__('web/messages.alert'));
                return redirect()->route('teacher.class.show',$classRoom->id);
            }
            $field=StudentsFields::find($request->studentFieldId);
            if(!isset($field->id))
            {
                alert()->error(__('قرآن آموز به درستی انتخاب نشده'),__('web/messages.alert'));
                return redirect()->route('teacher.class.show',$classRoom->id);
            }
            ClassRoomsStudents::create([
                'user_id'=>$teacher->id,
                'field_id' => $field->field_id,
                'field_parent_id'=>$field->field_parent_id,
                'student_id'=>$field->student_id,
                'students_field_id'=>$field->id,
                'class_rooms_id'=>$classRoom->id,
                'teacher_id'=>$teacher->teacher->id,
                'status' => '1',
            ]);
            $field->update([
                'status'=>'3',
            ]);
        }else{

            $teacher=User::find($classRoom->user_id);
            if(!isset($teacher->id))
            {
                alert()->error(__('معلم این کلاس به درستی انتخاب نشده است'),__('web/messages.alert'));
                return redirect()->route('teacher.class.show',$classRoom->id);
            }
            $teacherld=Teachers::find($request->teacher_id);
            if(!isset($teacherld->id))
            {
                alert()->error(__('معلم به درستی انتخاب نشده'),__('web/messages.alert'));
                return redirect()->route('teacher.class.show',$classRoom->id);
            }
            ClassRoomsTeachers::create([
                'user_id'=>$teacher->id,
                'field_id' => $classRoom->field_id,
                'field_parent_id'=>$classRoom->field_parent_id,
                'class_rooms_id'=>$classRoom->id,
                'teacher_id'=>$teacherld->id,
                'status' => '1',
            ]);
        }

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
        $classRoomsStuden->delete();
        alert()->success('حذف قرآن آموز از کلاس با موفقیت انجام شد', __('web/messages.success'));
        return redirect()->route('teacher.class.show',$classRoomsStuden->class_rooms_id);
    }
    public function registerTeacherDelete(Request $request)
    {
        $request->validate([
            'class_room_student_id' => ['required', 'numeric'],
        ]);
        $user=Auth::user();
        $classRoomsTracher=ClassRoomsTeachers::find($request->class_room_student_id);
        if(!isset($classRoomsTracher->id))
        {
            alert()->error(__('معلم به درستی انتخاب نشده'),__('web/messages.alert'));
            return redirect()->route('teacher.class.list');
        }

        $classRoomsTracher->update([
            'user_id_delete'=>$user->id,
        ]);
        $classRoomsTracher->delete();
        alert()->success('حذف معلم از کلاس با موفقیت انجام شد', __('web/messages.success'));
        return redirect()->route('teacher.class.show',$classRoomsTracher->class_rooms_id);
    }

    public function teacherList()
    {
        $user=Auth::user();
        $user=User::find($user->id);
        $classes=ClassRoomsTeachers::where([['teacher_id','=',$user->teacher->id],['status','>',0]])->orderBy('id','DESC')->get();
        return view('teacher.pages.class-teacher-list', compact('classes'));

    }


}
