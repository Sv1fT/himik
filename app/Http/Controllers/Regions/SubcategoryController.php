<?php

namespace App\Http\Controllers\Regions;

use App\Category;
use App\City;
use App\Country;
use App\RegionModel\Region;
use App\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubcategoryController extends Controller
{
    public function ShowSubcategory($account,$id){
        $region0 = Region::where('slug',$account)->get()->toArray();
        $region1 = City::where('slug',$account)->get()->toArray();
        $region2 = Country::where('slug',$account)->get()->toArray();

        $region = array_merge($region0,$region1,$region2);



        $category = Category::where('slug',$id)->get();

        if(!$region1)
        {

        }
        else {
            $subcategory =Subcategory::select('subcategory.*',DB::raw('(select count(*) from advert where advert.subcategory = subcategory.id and advert.city = '.$region[0]['id'].') as count_adv'),'category.title as category_title')
                ->join('category', 'category.id','=','subcategory.category_id')
                ->where('category_id','=',$category[0]['id'])
                ->orderBy('title','ASC')
                ->get();
        }
        if(!$region0)
        {

        }
        else {
            $subcategory =Subcategory::select('subcategory.*',DB::raw('(select count(*) from advert where advert.subcategory = subcategory.id and advert.region = '.$region[0]['id'].') as count_adv'),'category.title as category_title')
                ->join('category', 'category.id','=','subcategory.category_id')
                ->where('category_id','=',$category[0]['id'])
                ->orderBy('title','ASC')
                ->get();
        }
        if(!$region2)
        {

        }
        else {
            $subcategory =Subcategory::select('subcategory.*',DB::raw('(select count(*) from advert where advert.subcategory = subcategory.id and advert.country = '.$region[0]['id'].') as count_adv'),'category.title as category_title')
                ->join('category', 'category.id','=','subcategory.category_id')
                ->where('category_id','=',$category[0]['id'])
                ->orderBy('title','ASC')
                ->get();
        }


        $title = str_slug($subcategory[0]->title, "-");

        return view('subcategory.subcategory')->with('subcategory',$subcategory)->with('url',$title)->with('opisan',$category);
    }
}
