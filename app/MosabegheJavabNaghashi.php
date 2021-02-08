<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MosabegheJavabNaghashi extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'mosabeghe_name','file_url', 'description', 'user_meli_number','user_mosabeghe_id'];

    protected $dates = ['deleted_at'];

}
