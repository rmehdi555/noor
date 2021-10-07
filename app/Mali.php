<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mali extends Model
{
    use SoftDeletes;
    protected $fillable = ['price','description', 'user_id', 'type', 'table_name', 'payment_id','status'];
    protected $dates = ['deleted_at'];
}
