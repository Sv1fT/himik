<?php

namespace App\RegionModel;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RegionModel\Job
 *
 * @property int $id
 * @property string $user_id
 * @property string $city
 * @property string $category
 * @property string $name
 * @property string $region
 * @property string $country
 * @property string $slug
 * @property string $price
 * @property string $price1
 * @property string $valute
 * @property string $status
 * @property string $opit
 * @property string $education
 * @property string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\UserAttributes[] $attributes
 * @property-read \App\RegionModel\UserAttributes $value
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereOpit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job wherePrice1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Job whereValute($value)
 * @mixin \Eloquent
 */
class Job extends Model
{
    protected $table = 'vacant';

    public function value()
    {
        return $this->belongsTo(UserAttributes::class, 'user_id','user_id');
    }

    public function attributes()
    {
        return $this->hasMany('App\UserAttributes','user_id','user_id');
    }

    public function city_get()
    {
        return $this->belongsTo(City::class, 'city','id');
    }
}
