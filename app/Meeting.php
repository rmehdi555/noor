<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','title','description','file_url','status'
    ];

    protected $dates = ['deleted_at'];


    public function meetingAccess()
    {
        return $this->hasMany(MeetingAccess::class,'meeting_id','id')->get();
    }
}
