<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamsResponseStudents extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','student_id','class_rooms_id','class_rooms_students_id','exams_id','exams_questions_id','exams_questions_type','response','t_mark','a_mark','mark', 'status'
    ];

    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function exams()
    {
        return $this->hasMany(Exams::class,'id','exams_id');
    }
    public function examsQuestions()
    {
        return $this->hasMany(ExamsQuestions::class,'id','exams_questions_id');
    }
}
