<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamsQuestionsOptions extends Model
{
    protected $fillable = [
        'user_id','exams_id','exams_questions_id','title','type', 'status'
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
