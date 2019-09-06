<?php
/**
 * Created by PhpStorm.
 * User: Sv1fT
 * Date: 16.11.2016
 * Time: 18:33
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Subcategory extends  Model
{
    protected $table = "subcategory";

    public function category()
    {
        return $this->belongsTo('\App\Category','category_id');
    }
}