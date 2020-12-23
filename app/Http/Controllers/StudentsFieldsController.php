<?php

namespace App\Http\Controllers;

use App\Field;
use App\Http\Controllers\Controller;
use App\StudentsFields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class StudentsFieldsController extends Controller
{
    public function add(Request $request)
    {
        $field=Field::find($request->field_child);
        if(!isset($field->id))
        {
//            alert()->success(__('web/messages.success_sabt_level_1'),__('web/messages.success'));
//            alert()->success(__('web/messages.success_sabt_level_4'),$code_cookie);
            alert()->error(__('web/messages.not_exist_student_field'),__('web/messages.alert'));
            return redirect()->route('web.students.level.1');
        }
        if($field->id==0)
        {
            alert()->error(__('web/messages.disabled_student_field'),__('web/messages.alert'));
            return redirect()->route('web.students.level.1');
        }
        $student_flag_cookie=Cookie::get('student_flag_cookie');

        if(!empty($student_flag_cookie) )
        {
            $studentFields = StudentsFields::where('flag_cookie', '=', $student_flag_cookie)->orderBy('id')->get();
            foreach ($studentFields as $item)
            {
                if($field->id==$item->field_id)
                {
                    alert()->error(__('web/messages.before_select_student_field'),__('web/messages.alert'));
                    return redirect()->route('web.students.level.1');
                }
                if($field->parent_id!=0 AND $field->parent_id==$item->field_parent_id)
                {
                    alert()->error(__('web/messages.before_select_student_field_parent'),__('web/messages.alert'));
                    return redirect()->route('web.students.level.1');
                }
            }

        }else{
            $student_flag_cookie = StudentsFields::createCode();
        }
        StudentsFields::create([
            'title' => $field->title,
            'flag_cookie'=>$student_flag_cookie,
            'field_id'=>$field->id,
            'field_parent_id'=>$field->parent_id,
            'price'=>$field->price,
            'status' => '1',
        ]);
        Cookie::queue('student_flag_cookie', $student_flag_cookie, 720);
        //alert()->success(__('web/messages.success_sabt_level_1'),__('web/messages.success'));
        alert()->success(__('web/messages.success_add_student_field'), __('web/messages.success'));
        return redirect()->route('web.students.level.1');
    }
    public function delete(Request $request,$id)
    {

        $student_flag_cookie=Cookie::get('student_flag_cookie');
        $studentField=StudentsFields::where([['id','=',$id],['flag_cookie','=',$student_flag_cookie]])->get()->first();
        if(!isset($studentField->id))
        {
            alert()->error(__('web/messages.not_exist_student_field'),__('web/messages.alert'));
            return redirect()->route('web.students.level.1');
        }
        $studentField=StudentsFields::where([['id','=',$id],['flag_cookie','=',$student_flag_cookie]])->delete();
        alert()->success(__('web/messages.success_delete'),__('web/messages.success'));
        return redirect()->route('web.students.level.1');
    }
}
