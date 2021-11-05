<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Practices extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','class_rooms_id', 'title','visited','status'
    ];

    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function classRoom()
    {
        return $this->hasOne(ClassRooms::class,'id','class_rooms_id');
    }
    public function practicesDetails()
    {
        return $this->hasMany(PracticesDetails::class,'practice_id','id');
    }
}
