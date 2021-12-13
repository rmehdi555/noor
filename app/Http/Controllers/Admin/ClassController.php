<?php

namespace App\Http\Controllers\Admin;

use App\Cities;
use App\ClassRooms;
use App\ClassRoomsStudents;
use App\ClassRoomsTeachers;
use App\Exams;
use App\ExamsQuestions;
use App\Field;
use App\MarkType;
use App\Provinces;
use App\StudentsFields;
use App\Teachers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/* class
 * status=1 تازه ایجاد شده
 * status=2 در حال برگزاری
 * status=4 آزمون
 * status=5 اتمام رسیده
 */
class ClassController extends AdminController
{

    public function create()
    {
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        $markTypes=MarkType::where('status','=',1)->get();
        $teachers=Teachers::all();
        $exams=Exams::all();
        $SID=400;
        return view('admin.class.create', compact('fields','provinces','cities','markTypes','SID','teachers','exams'));
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
        ]);
        $user=Auth::user();
        $field=Field::find($request->field_child);
        if(!isset($field->id))
        {
            alert()->error(__('web/messages.not_exist_student_field'),__('web/messages.alert'));
            return redirect()->route('admin.class.create');
        }
        if($field->id==0)
        {
            alert()->error(__('web/messages.disabled_student_field'),__('web/messages.alert'));
            return redirect()->route('admin.class.create');
        }
        $markType=MarkType::find($request->mark_type_id);
        if(!isset($markType->id))
        {
            alert()->error('نوع نمره دهی را انتخاب نمایید',__('web/messages.alert'));
            return redirect()->route('admin.class.create');
        }
        if(!isset($request->exam_id) or empty($request->exam_id))
            $request->exam_id=0;

        $classRoom=ClassRooms::create([
            'user_id'=>$request->teacher_id,
            'field_id' => $request->field_child,
            'field_parent_id'=>$request->field_main,
            'name'=>$request->name,
            'mark_type'=>$markType->type,
            'mark_type_id'=>$request->mark_type_id,
            'description'=>$request->description,
            'number_students'=>$request->number_students,
            'old'=>$request->old,
            'exam_id'=>$request->exam_id,
            'city'=>$request->city,
            'province'=>$request->province,
            'address'=>$request->address,
            'type'=>$request->type,
            'status' =>$request->status,
        ]);
        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
        return redirect()->route('admin.class.show',$classRoom->id);
    }


    public function edit(Request $request,$id)
    {
        $classRoom=ClassRooms::find($id);
        if(!isset($classRoom->id))
        {
            alert()->error(__('not_exist'));
            return redirect()->route('admin.class.list');
        }
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        $markTypes=MarkType::where('status','=',1)->get();
        $teachers=Teachers::all();
        $exams=Exams::all();
        $SID=400;
        return view('admin.class.edit', compact('fields','provinces','cities','markTypes','SID','teachers','exams','classRoom'));
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
        ]);
        $classRoom=ClassRooms::find($request->class_room_id);
        if(!isset($classRoom->id))
        {
            alert()->error(__('not_exist'));
            return redirect()->route('admin.class.list');
        }
        $user=Auth::user();

        $markType=MarkType::find($request->mark_type_id);
        if(!isset($markType->id))
        {
            alert()->error('نوع نمره دهی را انتخاب نمایید',__('web/messages.alert'));
            return redirect()->route('admin.class.list');
        }
        if(!isset($request->exam_id) or empty($request->exam_id))
            $request->exam_id=0;

        $classRoom->update([
            'name'=>$request->name,
            'mark_type'=>$markType->type,
            'mark_type_id'=>$request->mark_type_id,
            'description'=>$request->description,
            'number_students'=>$request->number_students,
            'old'=>$request->old,
            'exam_id'=>$request->exam_id,
            'address'=>$request->address,
            'type'=>$request->type,
            'status' =>$request->status,
        ]);
        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
        return redirect()->route('admin.class.show',$classRoom->id);
    }


    public function list(Request $request)
    {
        $SID=400;
        $user=Auth::user();
        $classes=ClassRooms::all();
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        return view('admin.class.list', compact('fields','provinces','cities','classes','SID'));
    }

    public function show(Request $request,$id)
    {
        $SID=400;
        $classRooms=ClassRooms::find($id);
        if(!isset($classRooms->id))
        {
            alert()->error(__('not_exist'));
            return redirect()->route('admin.class.list');
        }
        $user=Auth::user();
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        $teachers=Teachers::all();
        $students=ClassRoomsStudents::where('class_rooms_id','=',$classRooms->id)->orderBy('id','DESC')->get();
        $teachersR=ClassRoomsTeachers::where('class_rooms_id','=',$classRooms->id)->orderBy('id','DESC')->get();
        $studentsRegister=StudentsFields::where([['status','=',2],['field_id','=',$classRooms->field_id],['field_parent_id','=',$classRooms->field_parent_id]])->orderBy('id','DESC')->get();
        return view('admin.class.show', compact('fields','provinces','cities','classRooms','students','studentsRegister','SID','teachers','teachersR'));
    }

    public function registerSave(Request $request)
    {
        $request->validate([
            'classRoomsId'=> ['required', 'numeric'],
        ]);
        $user=Auth::user();
        $user=User::find($user->id);
        $classRoom=ClassRooms::find($request->classRoomsId);
        if(!isset($classRoom->id))
        {
            alert()->error(__('کلاس به درستی انتخاب نشده'),__('web/messages.alert'));
            return redirect()->route('admin.class.list');
        }
        if($classRoom->type=="student")
        {
            $teacher=User::find($classRoom->user_id);
            if(!isset($teacher->id))
            {
                alert()->error(__('معلم این کلاس به درستی انتخاب نشده است'),__('web/messages.alert'));
                return redirect()->route('admin.class.show',$classRoom->id);
            }
            $field=StudentsFields::find($request->studentFieldId);
            if(!isset($field->id))
            {
                alert()->error(__('قرآن آموز به درستی انتخاب نشده'),__('web/messages.alert'));
                return redirect()->route('admin.class.show',$classRoom->id);
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
                return redirect()->route('admin.class.show',$classRoom->id);
            }
            $teacherld=Teachers::find($request->teacher_id);
            if(!isset($teacherld->id))
            {
                alert()->error(__('معلم به درستی انتخاب نشده'),__('web/messages.alert'));
                return redirect()->route('admin.class.show',$classRoom->id);
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
        return redirect()->route('admin.class.show',$classRoom->id);
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
            return redirect()->route('admin.class.list');
        }
        $field=StudentsFields::find($classRoomsStuden->students_field_id);
        if(!isset($field->id))
        {
            alert()->error(__('قرآن آموز به درستی انتخاب نشده'),__('web/messages.alert'));
            return redirect()->route('admin.class.show',$classRoomsStuden->class_rooms_id);
        }
        $field->update([
            'status'=>'2',
        ]);
        $classRoomsStuden->update([
            'user_id_delete'=>$user->id,
        ]);
        $classRoomsStuden->delete();
        alert()->success('حذف قرآن آموز از کلاس با موفقیت انجام شد', __('web/messages.success'));
        return redirect()->route('admin.class.show',$classRoomsStuden->class_rooms_id);
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
            return redirect()->route('admin.class.list');
        }

        $classRoomsTracher->update([
            'user_id_delete'=>$user->id,
        ]);
        $classRoomsTracher->delete();
        alert()->success('حذف معلم از کلاس با موفقیت انجام شد', __('web/messages.success'));
        return redirect()->route('admin.class.show',$classRoomsTracher->class_rooms_id);
    }


}
