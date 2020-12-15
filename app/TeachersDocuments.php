<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeachersDocuments extends Model
{
    use SoftDeletes;
    protected $fillable = ['title','flag_cookie', 'user_id', 'url', 'status'];
    protected $dates = ['deleted_at'];
}
