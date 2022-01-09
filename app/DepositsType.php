<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepositsType extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'price','user_type','type','title','status',
    ];
    protected $dates = ['deleted_at'];
}
