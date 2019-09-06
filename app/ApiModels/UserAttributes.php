<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;
use App\Blog;

class UserAttributes extends Model
{
    protected $primaryKey  = 'user_id';
    protected $table = 'users_attributes';
    protected $fillable = [
        'name', 'email', 'password',
        'status','contactfase',
        'company','filename','region',
        'number','city','login',
        'address','description','site','token','user_id',
    ];

    public function values()
    {
       return $this->belongsTo(\App\User::class,'user_id');
    }

    public function blog(){
        return $this->belongsTo(Blog::class,'user_id');
    }

    public function citys(){
        return $this->belongsTo(City::class,'city');
    }
}
