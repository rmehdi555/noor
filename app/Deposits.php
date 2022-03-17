<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposits extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'price','user_type','deposits_type_id','user_id','payment_id','title','year','month','status',
    ];
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
