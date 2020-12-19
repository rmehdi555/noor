<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Shetabit\Visitor\Traits\Visitor;

class User extends Authenticatable
{
    use Notifiable;
    use Visitor;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','family', 'email', 'phone', 'password','active','level','status','user_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function product()
    {
        return $this->hasMany(Products::class);
    }
    public function siteDetails()
    {
        return $this->hasMany(SiteDetails::class);
    }
    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
    public function productCategories()
    {
        return $this->hasMany(ProductCategories::class);
    }
    public function slider()
    {
        return $this->hasMany(Slider::class);
    }

    public function isAdmin()
    {
        return $this->level=='admin'?true:false;
    }
    public function isStudent()
    {
        return $this->level=='student'?true:false;
    }
    public function isTeacher()
    {
        return $this->level=='teacher'?true:false;
    }

    public function activationCode()
    {
        return $this->hasMany(ActivationCode::class);
    }
    public function webPages()
    {
        return $this->hasMany(WebPages::class);
    }
    public function menuCategories()
    {
        return $this->hasMany(MenuCategories::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function newsCategories()
    {
        return $this->hasMany(NewsCategories::class);
    }
    public function news()
    {
        return $this->hasMany(News::class);
    }
    public function fields()
    {
        return $this->hasMany(Field::class);
    }
    public function student()
    {
        return $this->hasOne(Students::class, 'user_id');
    }
    public function teacher()
    {
        return $this->hasOne(Teachers::class, 'user_id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }
    public function studentsDocuments()
    {
        return $this->hasOne(StudentsDocuments::class, 'user_id');
    }
    public function teacherDocuments()
    {
        return $this->hasOne(TeachersDocuments::class, 'user_id');
    }

}
