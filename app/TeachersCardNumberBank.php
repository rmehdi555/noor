<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeachersCardNumberBank extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id','teacher_id', 'name', 'card_number', 'sheba_number','bank_name','status'];
    protected $dates = ['deleted_at'];
}
