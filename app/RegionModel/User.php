<?php

namespace App\RegionModel;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\RegionModel\User
 *
 * @property int $id
 * @property int|null $role_id
 * @property string $name
 * @property string $allpass
 * @property string $city
 * @property string $region
 * @property string $country
 * @property string $status
 * @property string $email
 * @property string|null $avatar
 * @property string $password
 * @property string $token
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserAttributes[] $attributes
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\RegionModel\UserAttributes $values
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereAllpass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
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
}
