<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MosabegheMalekeZaman extends Model
{
    use SoftDeletes;
    protected $fillable = [ 'name', 'family', 'f_name','meli_number',
        'phone',  'city', 'province', 'address','status','type'];

    protected $dates = ['deleted_at'];

    public function Province()
    {
        return $this->hasOne(Provinces::class,'id','province');
    }
    public function City()
    {
        return $this->hasOne(Cities::class,'id','city');
    }
}
