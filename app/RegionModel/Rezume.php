<?php

namespace App\RegionModel;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RegionModel\Rezume
 *
 * @property int $id
 * @property string $fio
 * @property string $email
 * @property string $number
 * @property string $age
 * @property string $city
 * @property string $region
 * @property string $filename
 * @property string $pereezd
 * @property string $category
 * @property string $dolzhnost
 * @property string $price
 * @property string $slug
 * @property string $status
 * @property string $opit
 * @property string $education
 * @property string $language
 * @property string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\RegionModel\Region $regions
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereDolzhnost($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereFio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereOpit($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume wherePereezd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Rezume whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Rezume extends Model
{
    public function regions()
    {
        return $this->belongsTo(Region::class, 'region','id');
    }

    public function attributes()
    {
        return $this->belongsTo(UserAttributes::class, 'user_id','user_id');
    }
}
