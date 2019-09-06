<?php
/**
 * Created by PhpStorm.
 * User: Sv1fT
 * Date: 16.11.2016
 * Time: 18:33
 */

namespace App\RegionModel;


use Illuminate\Database\Eloquent\Model;

class Subcategory extends  Model
{
    protected $table = "subcategory";

    public function category()
    {
        return $this->belongsTo('\App\Subcategory','category');
    }
}