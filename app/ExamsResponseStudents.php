<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamsResponseStudents extends Model
{
    protected $fillable = [
        'user_id','student_id','exams_id','exams_questions_id','exams_questions_type','response','mark', 'status'
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
