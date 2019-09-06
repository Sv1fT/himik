<?php
/**
 * Created by PhpStorm.
 * User: Sv1fT
 * Date: 16.11.2016
 * Time: 18:22
 */

namespace App\RegionModel;


use App\City;
use App\Country;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;


/**
 * App\RegionModel\Home
 *
 * @mixin \Eloquent
 */
class Home extends Model
{

    public function getCountadvert($test)
    {
        return Advert::where('status',1)->where('region',$test)->orWhere('city',$test)->orWhere('country',$test)->count();

    }

    public function getUsers($test)
    {

        return UserAttributes::where('users_attributes.city',$test)->orwhere('users_attributes.region',$test)->orwhere('users_attributes.country',$test)->count();
    }

    public function getCategory()
    {
        return Category::where('id','<>','36')->count();
    }

    public function getSubcategory()
    {
        return Subcategory::all()->count();
    }

    public function getNewadvert($test)
    {
        return Advert::with('citys','types')->where('advert.show','=','1')->where('status',1)
            ->where('region',$test)
            ->orwhere('city',$test)
            ->orwhere('country',$test)
            ->take(3)->orderBy('created_at','DESC')->get();
    }

    public function getNewadvertUpdate($test)
    {
        return Advert::with('citys','types')->where('advert.show','=','1')->where('status',1)
            ->where('region',$test)
            ->orwhere('city',$test)
            ->orwhere('country',$test)
            ->take(3)->orderBy('date','desc')->get();
    }

    public function getBlog()
    {

        $data = Blog::latest()->where('active',1)->take(5)->get()->groupBy(function($date) {
            return $date->created_at->formatLocalized('%d %B %Y');
        });



       return $data;


    }

    public function getRegions()
    {
        return Region::orderBy('id','DESC')->get();
    }

    public function getRegion($test)
    {

        $data0 = Region::where('slug',$test)->get()->toArray();
        $data1 = City::where('slug',$test)->get()->toArray();
        $data2 = Country::where('slug',$test)->get()->toArray();

        $data = array_merge($data0,$data1,$data2);


        return $data;
    }

    public function getSlider()
    {
        return User::with('attributes')
            ->select('users.*',DB::raw('(select count(*) from advert where user_id = users.id) as count_sub'))
            ->where('status','<','4')
            ->where('id','!=',2)
            ->orderBy('count_sub','DESC')
            ->take(15)
            ->paginate(5);


    }

    public function productDay()
    {
        return Advert::with('types','citys')->where('view_status',3)->take(1)->get();
    }

    public function Vacants($test)
    {

        return Job::orderBy('id','DESC')->where('status',1)
            ->where('region',$test[0]['name'])
            ->orwhere('city',$test[0]['name'])
            ->orwhere('country',$test[0]['name'])->take(3)->get();
    }

    public function Resume($test)
    {
        return Rezume::with('attributes')->where('status',1)
            ->where('region',$test[0]['name'])
            ->orwhere('city',$test[0]['name'])
            ->orwhere('country',$test[0]['name'])->orderBy('id','DESC')->take(4)->get();
    }

}
