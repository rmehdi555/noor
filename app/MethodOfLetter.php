<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MethodOfLetter extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id','title','description','file_url','status'
    ];

    protected $dates = ['deleted_at'];

}
