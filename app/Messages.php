<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Messages extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','user_id_sender','user_id_reciver', 'title','visited_reciver','status'
    ];

    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function userSender()
    {
        return $this->hasOne(User::class,'id','user_id_sender');
    }

    public function userReciver()
    {
        return $this->hasOne(User::class,'id','user_id_reciver');
    }
    public function messagesDetails()
    {
        return $this->hasMany(MessagesDetails::class,'message_id','id');
    }
}
