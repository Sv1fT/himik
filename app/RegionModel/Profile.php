<?php

namespace App\RegionModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * App\RegionModel\Profile
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Profile user()
 * @mixin \Eloquent
 */
class Profile extends Model
{


    public function getProfile()
    {
        return UserAttributes::where('user_id',Auth::id())->get();
    }

    public function getRegion()
    {
        return Region::where('country','=','0')->where('id','<>','120')->orderBy('title','ASC')->get();
    }

    public function scopeUser($query)
    {
        $query->where('id','=',Auth::user()->id);
    }
}
