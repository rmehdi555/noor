<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsersDeleted extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','family', 'email', 'phone', 'password','active','level','status','user_name','email_verified_at','phone_verified_at',
        'priority','old_id'
    ];
}
