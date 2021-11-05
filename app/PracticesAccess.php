<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PracticesAccess extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','practice_id', 'user_id_send', 'user_id_get','visited','status'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    public function practice()
    {
        return $this->hasOne(Practices::class,'id','practice_id');
    }
}
