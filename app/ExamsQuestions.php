<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamsQuestions extends Model
{
    protected $fillable = [
        'user_id','exams_id','title','type', 'mark','response','status'
    ];

    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function exam()
    {
        return $this->hasMany(User::class,'id','exams_id');
    }
}
