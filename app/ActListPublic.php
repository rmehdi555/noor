<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActListPublic extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','user_id_teacher', 'user_id_student', 'class_rooms_id','class_rooms_students_id','date','description','mark','presence','status'
    ];

    protected $dates = ['deleted_at'];
}
