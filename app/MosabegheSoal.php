<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MosabegheSoal extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'title','mosabeghe_name','type'];

    protected $dates = ['deleted_at'];

    public function javabs()
    {
        return $this->hasMany(MosabegheSoalJavab::class,'soal_id','id');
    }
}
