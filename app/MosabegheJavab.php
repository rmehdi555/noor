<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MosabegheJavab extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'soal_id','javab_id','javab_user_id','user_meli_number','user_mosabeghe_id'];

    protected $dates = ['deleted_at'];

    public function soalRow()
    {
        return $this->hasOne(MosabegheSoal::class,'id','soal_id')->first();
    }
}
