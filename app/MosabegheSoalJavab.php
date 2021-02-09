<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MosabegheSoalJavab extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'soal_id','title','type'];

    protected $dates = ['deleted_at'];
}
