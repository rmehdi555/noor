<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exams extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','title','start_exam', 'end_exam','status'
    ];

    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function examsQuestions()
    {
        return $this->hasMany(ExamsQuestions::class,'exams_id','id');
    }
}
