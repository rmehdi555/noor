<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketsDetails extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','ticket_id','description','file_url','status'
    ];

    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
