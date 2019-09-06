<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends \TCG\Voyager\Models\User
{

    use Notifiable;

    public function attributes()
    {
        return $this->hasMany('App\UserAttributes');
    }

    public function values()
    {
        return $this->belongsTo(UserAttributes::class, 'id');
    }

    public function scopeGetUsers($query)
    {
        dd($query);
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'status','showuser','contactfase',
        'company','filename','region',
        'number','sity','login',
        'adress','description','site','token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','remember_token','token',
    ];


    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function generateToken()
    {
        $this->api_token = str_random(60);
        $this->save();

        return $this->api_token;
    }
}
