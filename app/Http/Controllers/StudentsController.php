<?php

namespace App\Http\Controllers;

use App\Field;
use App\Http\Controllers\Controller;
use App\Students;
use App\StudentsFields;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class StudentsController extends Controller
{
    public function level1()
    {
        //Cookie::queue('student_code', 124891, 720);
        $result=$this->checkCodeCookie(1);

        if($result=='true')
        {
            $fields = Field::all();
            $studentFields = StudentsFields::where('flag_cookie', '=', Cookie::get('student_flag_cookie'))->orderBy('id')->get();
            return view('web.pages.students-level-1', compact('fields','studentFields'));
        }else{
            return redirect()->route($result);
        }
    }


    public function checkCodeCookie($level=1)
    {
        $student_flag_cookie=Cookie::get('student_flag_cookie');
        if(!empty($student_flag_cookie) )
        {
            $student = Students::where('flag_cookie','=',$student_flag_cookie)->get()->first();
            if(!isset($student['flag_cookie']))
            {
                if($level==1)
                    return 'true';
                return 'web.students.level.1';

            }else{

                Cookie::queue('student_flag_cookie', $student['flag_cookie'], 720);

                if($student['status']==1 )
                {
                    if($level==2)
                    {
                        return 'true';
                    }else{
                        alert()->success(__('web/messages.success_sabt_level_1_students'),__('web/messages.success'));
                        return 'web.students.level.2';
                    }

                }
                if($student['status']==2 )
                {
                    if($level==3)
                    {
                        return 'true';
                    }else{
                        alert()->success(__('web/messages.success_sabt_level_2_students'),__('web/messages.success'));
                        return 'web.students.level.3';
                    }

                }
                if($student['status']==3 )
                {
                    if($level==4)
                    {
                        return 'true';
                    }else{
                        alert()->success(__('web/messages.success_sabt_level_3_students'),__('web/messages.success'));
                        return 'web.students.level.4';
                    }

                }
            }
        }
        if($level==1)
            return 'true';
        return 'web.students.level.1';
    }
}
