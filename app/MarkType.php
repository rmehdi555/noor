<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MarkType extends Model
{
    public function markTypeGrade()
    {
        return $this->hasMany(MarkTypeGrade::class,'mark_type_id','id');
    }
}
