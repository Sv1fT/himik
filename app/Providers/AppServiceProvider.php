<?php

namespace App\Providers;

use App\Category;
use App\City;
use App\Country;
use App\Goods;
use App\Region;
use App\UserAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use SimpleXMLElement;
use SleepingOwl\Admin\Form\Panel\Header;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Request $request)
    {
        $account = $request->header('host');

        if($account != 'opt-himik.ru' && $account != 'localhost'){
            $account = explode(".",$account);
            $region_tab0 = Region::where('region.slug',$account)->get()->toArray();
            $region_tab1 = City::where('slug',$account)->get()->toArray();
            $region_tab2 = Country::where('slug',$account)->get()->toArray();

            $region_tab = array_merge($region_tab0,$region_tab1,$region_tab2);

            if(isset($region_tab)){
                session()->put('regiones',$region_tab[0]['name']);
                session()->put('regiones_id',$region_tab[0]['id']);
                session()->put('type_regions',$region_tab[0]);
            }

        }
        else{
            if (Session::has('regiones') && Session::has('regiones_id') && Session::has('type_regions'))
            {
                Session::forget('regiones');
                Session::forget('regiones_id');
                Session::forget('type_regions');
            }

        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
