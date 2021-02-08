<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MosabegheMalekeZamanNazar extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'title','value', 'user_meli_number','user_mosabeghe_id','type'];

    protected $dates = ['deleted_at'];
}
