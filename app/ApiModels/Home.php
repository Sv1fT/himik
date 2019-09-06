<?php
/**
 * Created by PhpStorm.
 * User: Sv1fT
 * Date: 16.11.2016
 * Time: 18:22
 */

namespace App\ApiModels;


use Laravelrus\LocalizedCarbon\LocalizedCarbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;


/**
 * App\Home
 *
 * @mixin \Eloquent
 */
class Home extends Model
{

    public function getCountadvert()
    {
        return Advert::where('status',1)->get()->count();

    }

    public function getUsers()
    {
        return User::all()->count();
    }

    public function getCategory()
    {
        return Category::where('id','<>','36')->count();
    }

    public function getSubcategory()
    {
        return Subcategory::all()->count();
    }

    public function getNewadvertCreate()
    {
        return Advert::with('citys','types')
            ->where('advert.show','=','1')
            ->where('status',1)
            ->take(3)
            ->orderBy('created_at','desc')
            ->get();
    }
    public function getNewadvertUpdate()
    {
        return Advert::with('citys','types')->where('advert.show','=','1')->where('status',1)
            ->take(3)->orderBy('date','desc')->get();
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
            $date = LocalizedCarbon::parse($date->created_at)->formatLocalized('%d %f %Y');
            return $date;
        });





       return $data;


    }

    public function getRegions()
    {
        return Region::orderBy('id','DESC')->first();
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