<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;
use App\City;

class City extends Model
{
    protected $table = 'city';

    public static function city($region_id)
    {
        $array = City::select('name')->where('region_id',$region_id)->get()->toJson();

        $city = json_decode($array);
        
        return $city;

    }

    public function region()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }

}
