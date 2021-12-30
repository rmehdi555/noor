<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActListHefzT extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','user_id_teacher', 'user_id_student', 'class_rooms_id','class_rooms_students_id','date','description','mark_hefz','mark_do_dars','mark_hasht_dars','mark_d1','j_d1','mark_d2','j_d2','mark_d3','j_d3','mark_d4','j_d4','mark_d5','j_d5','mark_d6','j_d6','mark_hefz_t','mark','presence','status'
    ];

    protected $dates = ['deleted_at'];
}
