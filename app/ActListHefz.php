<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActListHefz extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','user_id_teacher', 'user_id_student', 'class_rooms_id','class_rooms_students_id','date','description','mark_hefz','mark_dah_dars','mark_d1','j_d1','mark_d2','j_d2','mark','presence','status'
    ];

    protected $dates = ['deleted_at'];
}
