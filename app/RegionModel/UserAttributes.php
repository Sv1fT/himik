<?php

namespace App\RegionModel;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RegionModel\UserAttributes
 *
 * @property int $id
 * @property string $name
 * @property string $filename
 * @property int $user_id
 * @property string $company
 * @property string $region
 * @property string $country
 * @property string $city
 * @property string $address
 * @property string $number
 * @property string $description
 * @property string $site
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\User $values
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereSite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\UserAttributes whereUserId($value)
 * @mixin \Eloquent
 */
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
}
