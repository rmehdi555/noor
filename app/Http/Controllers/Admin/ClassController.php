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
use App\Providers\MyProvider;
use App\Provinces;
use App\StudentsFields;
use App\Teachers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hekmatinasser\Verta\Verta;

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
            'description' => ['nullable', 'string', 'max:255'],
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
            'field_parent_id'=>$field->parent_id,
            'name'=>$request->name,
            'mark_type'=>$markType->type,
            'mark_type_id'=>$request->mark_type_id,
            'description'=>$request->description,
            'number_students'=>$request->number_students,
            'old'=>$request->old,
            'exam_id'=>$request->exam_id,
            'act_list_name'=>$request->act_list_name,
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
            'description' => ['nullable', 'string', 'max:255'],
            'number_students' => ['required', 'string', 'max:255'],
            'old' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'province' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'mark_type_id'=>['required', 'numeric'],
            'act_list_name'=>['required'],
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
            'user_id'=>$request->teacher_id,
            'name'=>$request->name,
            'mark_type'=>$markType->type,
            'mark_type_id'=>$request->mark_type_id,
            'description'=>$request->description,
            'number_students'=>$request->number_students,
            'old'=>$request->old,
            'exam_id'=>$request->exam_id,
            'act_list_name'=>$request->act_list_name,
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

    public function registerCancel(Request $request)
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
        $classRoomsStuden->update([
            'status'=>6,
        ]);
        alert()->success('انصراف قرآن آموز از کلاس با موفقیت انجام شد', __('web/messages.success'));
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

    public function listTeacher(Request $request)
    {
        $SID=400;
        $user=Auth::user();
        $classes=ClassRooms::where('user_id','=',$request->id)->get();
        if(count($classes)<1)
        {
            alert()->error(__('معلم انتخاب شده هیچ کلاسی ثبت نکرده است.'),__('web/messages.alert'));
            return redirect()->route('teachers.index');
        }
        $fields = Field::all();
        $provinces = Provinces::all();
        $cities = Cities::all();
        return view('admin.class.list', compact('fields','provinces','cities','classes','SID'));
    }

    public function delete(Request $request)
    {
        $classRoom=ClassRooms::find($request->class_room_id);
        if(!isset($classRoom->id))
        {
            alert()->error(__('not_exist'));
            return redirect()->route('admin.class.list');
        }
        $students=ClassRoomsStudents::where('class_rooms_id','=',$classRoom->id)->orderBy('id','DESC')->get();
        $teachersR=ClassRoomsTeachers::where('class_rooms_id','=',$classRoom->id)->orderBy('id','DESC')->get();
        if(count($students)>0 OR count($teachersR) >0)
        {
            alert()->error(__('ابتدا اعضای کلاس رو حذف کنید سپس کلاس رو حذف نمایید.'));
            return redirect()->route('admin.class.list');
        }
        $classRoom->delete();
        alert()->success(__('web/messages.success_save_form'), __('web/messages.success'));
        return redirect()->route('admin.class.list');
    }


    public function registerReport(Request $request)
    {
        $request->validate([
            'from' => ['nullable'],
            'to' => ['nullable'],
            'teacher_id' => ['nullable'],
            'field_id' => ['nullable'],
            'cancel' => ['nullable'],
        ]);
        if(isset($request->from))
        {
            $request->from=MyProvider::convert_phone_number($request->from);
            $from=explode(' ',$request->from);
            $from_date=explode('-',$from[0]);
            $from_time=$from[1];
            $from_date=Verta::getGregorian($from_date[0],$from_date[1],$from_date[2]);
            $from_date=implode('-',$from_date);
            $from=$from_date.' '.$from_time;
        }
        if(isset($request->to))
        {
            $request->to=MyProvider::convert_phone_number($request->to);
            $to=explode(' ',$request->to);
            $to_date=explode('-',$to[0]);
            $to_time=$to[1];
            $to_date=Verta::getGregorian($to_date[0],$to_date[1],$to_date[2]);
            $to_date=implode('-',$to_date);
            $to=$to_date.' '.$to_time;

        }

        if(isset($from) and isset($to))
        {
            $students=ClassRoomsStudents::whereBetween('created_at',[$from,$to]);
        }
        if(isset($from) and !isset($to))
        {
            $students=ClassRoomsStudents::where('created_at','>=',$from);
        }
        if(!isset($from) and isset($to))
        {
            $students=ClassRoomsStudents::where('created_at','=<',$to);
        }
        if(!isset($from) and !isset($to))
        {
            if(!isset($request->teacher_id) and !isset($request->field_id) OR ($request->teacher_id==0 and $request->field_id==0))
            {
                $students=ClassRoomsStudents::all();
            }else{
                if(isset($request->teacher_id) and $request->teacher_id!=0)
                {
                    $students=ClassRoomsStudents::where('teacher_id','=',$request->teacher_id);
                }
                if(isset($request->field_id) and $request->field_id!=0)
                {
                    $students=ClassRoomsStudents::where('field_id','=',$request->field_id);
                }
                $students=$students->orderBy('id','DESC')->get();
            }

        }else{
            if(isset($request->teacher_id) and $request->teacher_id!=0)
            {
                $students=$students->where('teacher_id','=',$request->teacher_id);
            }
            if(isset($request->field_id) and $request->field_id!=0)
            {
                $students=$students->where('field_id','=',$request->field_id);
            }
            $students=$students->orderBy('id','DESC')->get();
        }

        $SID=411;
        $provinces = Provinces::all();
        $cities = Cities::all();
        $fields = Field::all();
        $teachers = Teachers::all();

        return view('admin.class.register-report', compact('students','provinces','cities','fields','teachers','SID'));




    }
}
