<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deposits extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'price','deposits_type_id','user_id','payment_id','title','status',
    ];
    protected $dates = ['deleted_at'];
    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
