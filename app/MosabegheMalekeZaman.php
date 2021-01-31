<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MosabegheMalekeZaman extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'name', 'family', 'f_name','meli_number',
        'phone',  'city', 'province', 'address','status'];
    protected $dates = ['deleted_at'];

}
