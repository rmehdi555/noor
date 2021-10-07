<?php

namespace App\Http\Controllers\Student;

use App\Field;
use App\Http\Controllers\Controller;
use App\StudentsFields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class StudentsFieldsController extends Controller
{
    public function add(Request $request)
    {
        $user=Auth::user();
        $field=Field::find($request->field_child);
        if(!isset($field->id))
        {
            alert()->error(__('web/messages.not_exist_student_field'),__('web/messages.alert'));
            return redirect()->route('student.class.register');
        }
        if($field->id==0)
        {
            alert()->error(__('web/messages.disabled_student_field'),__('web/messages.alert'));
            return redirect()->route('student.class.register');
        }

        $studentFields = StudentsFields::where([['user_id', '=',$user->id],['status','=',1]])->orderBy('id')->get();
        foreach ($studentFields as $item)
        {
            if($field->id==$item->field_id)
            {
                alert()->error(__('web/messages.before_select_student_field'),__('web/messages.alert'));
                return redirect()->route('student.class.register');
            }
            if($field->parent_id!=0 AND $field->parent_id==$item->field_parent_id)
            {
                alert()->error(__('web/messages.before_select_student_field_parent'),__('web/messages.alert'));
                return redirect()->route('student.class.register');
            }
        }

        StudentsFields::create([
            'title' => $field->title,
            'flag_cookie'=>$user->student->flag_cookie,
            'user_id'=>$user->id,
            'field_id'=>$field->id,
            'student_id'=>$user->student->id,
            'field_parent_id'=>$field->parent_id,
            'price'=>$field->price,
            'status' => '1',
        ]);
        alert()->success(__('web/messages.success_add_student_field'), __('web/messages.success'));
        return redirect()->route('student.class.register');
    }
    public function delete(Request $request,$id)
    {
        $user=Auth::user();
        $studentField=StudentsFields::where([['id','=',$id],['user_id','=',$user->id],['status','=',1]])->get()->first();
        if(!isset($studentField->id))
        {
            alert()->error(__('web/messages.not_exist_student_field'),__('web/messages.alert'));
            return redirect()->route('student.class.register');
        }
        $studentField=StudentsFields::where([['id','=',$id],['user_id','=',$user->id],['status','=',1]])->delete();
        alert()->success(__('web/messages.success_delete'),__('web/messages.success'));
        return redirect()->route('student.class.register');
    }
}
