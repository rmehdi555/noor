<?php

/* classRoomstudent
 * status=1 تازه ایجاد شده
 * status=2 در حال برگذاری
 * status=4 آزمون
 * status=5 اتمام رسیده
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoomsStudents extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','field_id', 'field_parent_id', 'student_id','students_field_id','class_rooms_id','teacher_id','mark','status','user_id_delete'
    ];

    protected $dates = ['deleted_at'];


    public function student()
    {
        return $this->hasOne(Students::class,'id','student_id');
    }
    public function teacher()
    {
        return $this->hasOne(Teachers::class,'id','teacher_id');
    }
    public function classRoms()
    {
        return $this->hasOne(ClassRooms::class,'id','class_rooms_id');
    }
}
