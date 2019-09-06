<?php

namespace App\ApiModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PDO;
use App\ApiModels\Region;

class Region extends Model
{
    protected $table = 'region';

    public static function region()
    {
    	$array = Region::select('name')->where('country_id',0)->get()->toArray();

    	$regiones = json_decode(json_encode($array), True);


        return $regiones;

    }

    public function getRegions($name)
    {


        $array = Region::select('region.name')->where('name','LIKE','%'.$name."%")->get()->toArray();



        $regiones = json_decode(json_encode($array), True);


        return $regiones;
    }

    public function country()
    {
        return $this->belongsTo(\App\Country::class,'country_id','id');
    }
}
