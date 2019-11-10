<?php

namespace App\Http\Controllers;

use App\Advert;
use App\City;
use App\Job;
use App\Region;
use App\Subcategory;
use App\User;
use Illuminate\Http\Request;

class AdvertController extends Controller
{
    public function ShowAdvert($id){

        $name = Subcategory::where('slug',$id)->take(1)->get();

        $advert = Advert::with('types','citys')->
        select('advert.*','category.title AS categorytitle','region.name AS region_title','advert.show AS `show`')
            ->join('region', 'advert.region','=','region.id')
            ->join('category', 'advert.category','=','category.id')
            ->join('users','advert.user_id','=','users.id')
            ->where('subcategory',$name[0]['id'])
            ->where('advert.status',1)
            ->orderBy('advert.id','desc')->paginate(15);
        







        $advertcategory = Advert::
        select('advert.*','category.title AS categorytitle','subcategory.title AS subcategorytitle','region.name AS region_title')
            ->join('region', 'advert.region','=','region.id')
            ->join('category', 'advert.category','=','category.id')
            ->join('subcategory', 'advert.subcategory','=','subcategory.id')
            ->join('users','advert.user_id','=','users.id')
            ->where('subcategory','=',$name[0]['id'])
            ->orderBy('advert.id','desc')->take(1)->get();





        //if (Auth::check())
        //{
        //    $pdo = DB::table('izbrannoe')
        //        ->select('izbrannoe.*',DB::raw('(select count(*) from izbrannoe,advert where izbrannoe.advert_id = advert.id and izbrannoe.user_id = '.Auth::user()->id.') as count_izb'))
        //        ->join('advert','advert.id','=','advert_id')->where('izbrannoe.user_id','=',Auth::user()->id)->get();
        //}
        //else
        //{
        //   $pdo = DB::table('izbrannoe')
        //       ->select('izbrannoe.*',DB::raw('(select count(*) from izbrannoe,advert where izbrannoe.advert_id = advert.id) as count_izb'))
        //       ->join('advert','advert.id','=','advert_id')->get();
        //}





        return view('advert.advert')->with('advert',$advert)->with('titlecategory',$advertcategory)->with('opisan',$name);
    }

    public function redirect_advert($id)
    {
        return redirect('/'.$id);
    }

    public function showAdvertsnow($id)
    {


        $advert = Advert::with('types')->
        select('advert.*','category.title AS categorytitle','region.name AS region_title',
            'advert.show AS `show`')
            ->join('region', 'advert.region','=','region.id')
            ->join('category', 'advert.category','=','category.id')
            ->join('users','advert.user_id','=','users.id')
            ->where('advert.slug',$id)->get();

        #dd($advert);

        if(count($advert) > 0){

        $new_text = preg_replace("/\b((http(s?):\/\/)|(www\.))([\w\.]+)([\/\w+\.]+)([\?\w+\.\=]+)([\&\w+\.\=]+)\b/i", "<a href=\"http$3://$4$5$6$7$8\" target=\"_blank\">$2$4$5$6$7$8</a>", $advert[0]->content);




        $new = Advert::with('citys')->
        select('advert.*',
            'category.title AS categorytitle',
            'region.name AS region_title',

            'advert.show AS `show`')
            ->join('region', 'advert.region','=','region.id')
            ->join('category', 'advert.category','=','category.id')
            ->join('users','advert.user_id','=','users.id')
            ->where('advert.id','<>',$advert[0]->id)
            ->where('users.id','=',$advert[0]->user_id)->orderBy('id','desk')->paginate(5);
        #dd($new);
        $vacants = Job::where('status',1)->where('user_id',$advert[0]->user_id)->get();



        $user = User::with('attributes')->where('id',$advert[0]['user_id'])->get();
        foreach ($user as $users)
        {
            foreach ($users->attributes as $item)
            {
                $region = Region::select('name')->where('id',$item->region)->get();
                $city = City::select('name')->where('id',$item->city)->get();
            }
        }
        $counts = Advert::where('slug',$id)->get();
        foreach ($counts as $item)
        {
            $counts_id = Advert::find($item->id);

            $counts_id->views = $item->views + 1;
            $counts_id->views_day = $item->views_day + 1;

            $counts_id->save(['timestamps' => false ]);
        }


            return view('advert.advertshow',compact('advert','new','user','region','city','vacants'));
        }
        else{
            abort(404);
        }
    }

    public function shortContent()
    {
        $advert = Advert::all();

        foreach ($advert as $item){
            $new_advert = Advert::find($item->id);
            $new_advert->short_content = str_limit($item->content,80);
            $new_advert->save();
        }
    }
}
