<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContactUs extends Model
{
    use SoftDeletes;
    protected  $fillable=['name','family','email','phone','body','status'];
    protected $dates = ['deleted_at'];
}
