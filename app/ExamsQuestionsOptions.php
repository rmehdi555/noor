<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamsQuestionsOptions extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','exams_id','exams_questions_id','title','type','response', 'status'
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
