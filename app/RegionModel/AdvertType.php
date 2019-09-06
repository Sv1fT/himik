<?php

namespace App\RegionModel;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RegionModel\AdvertType
 *
 * @property int $id
 * @property int $advert_id
 * @property int $user_id
 * @property string $type
 * @property string $mass
 * @property string $price
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\AdvertType whereAdvertId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\AdvertType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\AdvertType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\AdvertType whereMass($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\AdvertType wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\AdvertType whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\AdvertType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\AdvertType whereUserId($value)
 * @mixin \Eloquent
 */
class AdvertType extends Model
{
    protected $table= 'type';
}
