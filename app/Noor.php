<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Noor extends Model
{
    use SoftDeletes;
    protected $fillable = ['price','type', 'user_id', 'name', 'family', 'f_name', 'meli_number',
        'phone','user_type','user_code','email','email','mobile','description','status '];
    protected $dates = ['deleted_at'];

}
