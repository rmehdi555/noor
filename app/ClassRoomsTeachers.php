<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassRoomsTeachers extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','field_id', 'field_parent_id','class_rooms_id','teacher_id','t_mark','a_mark','mark','status','user_id_delete'
    ];

    protected $dates = ['deleted_at'];

    public function teacher()
    {
        return $this->hasOne(Teachers::class,'id','teacher_id');
    }
    public function classRoms()
    {
        return $this->hasOne(ClassRooms::class,'id','class_rooms_id');
    }
}
