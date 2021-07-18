<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeachersSpecialization extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'specialization_id', 'teacher_id', 'price','status'];
    protected $dates = ['deleted_at'];

    public function specialization()
    {
        return $this->hasMany(Specialization::class,'id','specialization_id');
    }

}
