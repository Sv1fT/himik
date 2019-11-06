<?php
/**
 * Created by PhpStorm.
 * User: Sv1fT
 * Date: 16.11.2016
 * Time: 18:22
 */

namespace App;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;


/**
 * App\Home
 *
 * @mixin \Eloquent
 */
class Home extends Model
{
    var $regions;

    public function __construct()
    {
        $this->regions = session()->get('regiones');
    }

    public function getCountadvert()
    {
        $advert = Advert::query();
        if(!empty($this->regions)){
            return $advert->where('region',$this->regions)
                ->orWhere('city',$this->regions)
                ->orWhere('country',$this->regions)->count();

        }else{
            return $advert->count();

        }
    }

    public function getUsers()
    {
        $user = UserAttributes::query();
        if(!empty($this->regions)){
            return $user->where('region',$this->regions)
                ->orWhere('city',$this->regions)
                ->orWhere('country',$this->regions)->count();

        }else{
            return $user->count();

        }
    }

    public function getCategory()
    {
        return Category::where('id','<>','36')->count();
    }

    public function getSubcategory()
    {
        return Subcategory::count();
    }

    public function getNewadvertCreate()
    {
//        $advert = Advert::query()->with('citys','types')->where('advert.show','=','1')
//        ->where('status',1)
//        ->take(3);
//
//        $advert1 = $advert->orderBy('created_at','desc')->get();
//
//        $advert2 = $advert->orderBy('date', 'desc')->get();
//        dd($advert2);
//        die;
//        $advert_merge = array_merge($advert1,$advert2);



        return $advert = Cache::remember('advert',10,function (){
            return Advert::with('citys','types')
                ->where('advert.show','=','1')
                ->where('status',1)
                ->take(3)
                ->orderBy('created_at','desc')
                ->get();
        });
    }
    public function getNewadvertUpdate()
    {
        return $advert_update = Cache::remember('advert_update',10,function () {
            return Advert::with('citys', 'types')->where('advert.show', '=', '1')->where('status', 1)
                ->take(3)->orderBy('date', 'desc')->get();
        });
    }

    public function productDay()
    {
        return Advert::with('citys','types')->where('view_status',3)->take(1)->get();
    }

    public function Vacants()
    {
        if (Auth::check()) {
            if (Auth::user()->status == 4) {
                return Job::orderBy('id', 'DESC')->take(3)->get();
            } else {
                return Job::orderBy('id', 'DESC')->where('status', 1)->take(3)->get();
            }
        }else{
            return Job::orderBy('id', 'DESC')->where('status', 1)->take(3)->get();
        }

    }

    public function Resume()
    {
        if (Auth::check())
        {
            if(Auth::user()->status == 4)
            {
                return Rezume::with('attributes')->orderBy('id','DESC')->take(5)->get();
            }
            else{
                return Rezume::with('attributes')->where('status',1)->orderBy('id','DESC')->take(5)->get();
            }
        }
        else{
            return Rezume::with('attributes')->where('status',1)->orderBy('id','DESC')->take(5)->get();
        }
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
        return $regions = Cache::remember('regions',10,function () {
            return Region::orderBy('id', 'DESC')->get();
        });
    }

    public function getSlider()
    {
        return User::with('attributes')
            ->select('users.*',DB::raw('(select count(*) from advert where user_id = users.id) as count_sub'))
            ->where('status','<','4')
            ->where('id','!=',2)
            ->orderBy('count_sub','DESC')
            ->take(15)
            ->get();


    }

}
