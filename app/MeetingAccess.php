<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeetingAccess extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id_reciver','meeting_id','visited_reciver','status'
    ];

    protected $dates = ['deleted_at'];

    public function userReciver()
    {
        return $this->hasOne(User::class,'id','user_id_reciver');
    }
}
