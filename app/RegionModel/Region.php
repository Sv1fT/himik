<?php

namespace App\RegionModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;

/**
 * App\RegionModel\Region
 *
 * @property int $id
 * @property int $country_id
 * @property string $name
 * @property string $type
 * @property string $filename
 * @property int $show_region
 * @property string $slug
 * @property string $crt_date
 * @property \Carbon\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Region whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Region whereCrtDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Region whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Region whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Region whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Region whereShowRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Region whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Region whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Region whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Region extends Model
{
    protected $table = 'region';

    public function getRegions($name)
    {


        $array = Region::select('region.name')->where('title','LIKE','%'.$name."%")->get()->toArray();



        $regiones = json_decode(json_encode($array), True);


        return $regiones;
    }
}
