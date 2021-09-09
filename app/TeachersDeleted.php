<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeachersDeleted extends Model
{
    use SoftDeletes;
    protected $fillable = ['flag_cookie', 'user_id','teacher_id', 'name', 'family', 'f_name', 'sh_number','meli_number', 'sh_sodor', 'tavalod_date', 'married',
        'phone_1', 'phone_2', 'phone_f', 'phone_m', 'tel', 'city', 'province',
        'address','post_number','education','job','email','number_of_children','sex','status','old_id'];
    protected $dates = ['deleted_at'];
}
