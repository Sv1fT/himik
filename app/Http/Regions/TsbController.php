<?php

namespace App\Http\Controllers\Regions;

use App\Advert;
use App\Category;
use App\City;
use App\Country;
use App\Delivery;
use App\Job;
use App\Notifications\WorkoutAssigned;
use App\Subcategory;
use App\User;
use App\UserAttributes;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use PDO;
use App\Region;

class TsbController extends Controller
{
    public function ShowPage($account)
    {

        $region0 = Region::where('slug', $account)->get()->toArray();
        $region1 = City::where('slug', $account)->get()->toArray();
        $region2 = Country::where('slug', $account)->get()->toArray();

        $region = array_merge($region0, $region1, $region2);

        $test = Advert::join('category', 'advert.category', '=', 'category.id')->
        where('advert.category', 'category.id')->
        where('advert.region', $region[0]['id'])->
        orwhere('advert.city', $region[0]['id'])->
        orwhere('advert.country', $region[0]['id'])->get();

        $category = Category::select('category.*', DB::raw('(select count(*) from advert where advert.category = category.id and advert.city=' . $region[0]['id'] . ' or advert.region=' . $region[0]['id'] . ' or advert.country=' . $region[0]['id'] . ') as count_sub'))
            ->where('category.id', '<>', '36')
            ->orderBy('title', 'ASC')
            ->get();


        // dd($category);


        $title = str_slug($category[0]->title, "-");

        $subcategory = Subcategory::
        select(DB::raw('count(*) as subcategory_count'))
            ->get();


        $subcat_all = Subcategory::
        where('subcategory.id', '<>', 339)
            ->orderBy('title', 'ASC')
            ->get();

        $count = DB::table('delivery')->select(DB::raw('count(distinct(email)) as count'))->get();


        return view('tsb')->with('category', $category)->with('subcategory', $subcategory)->with('url', $title)->with('subcat_all', $subcat_all)->with('counts', $count);
    }

    public function ShowPageRegions($account, $id)
    {
        $region_title = Region::where('id', $id)->first();

        $advertcount = Advert::select(DB::raw('count(*) as advert_count'))
            ->where('advert.region', '=', $id)
            ->get();

        $category = Category::select('category.*', DB::raw('(select count(*) from advert where advert.category = category.id and advert.region = ' . $id . ') as count_sub'))
            ->where('category.id', '<>', '36')
            ->orderBy('title', 'ASC')
            ->get();

        $users = User::select(DB::raw('count(*) as user_count'))
            ->get();

        $title = str_slug($category[0]->title, "-");

        $subcategory = Subcategory::select(DB::raw('count(*) as subcategory_count'))
            ->get();

        $advert = Advert::with('types')->
        select('advert.*', 'category.title AS categorytitle', 'region.name AS region_title', 'advert.show AS `show`')
            ->join('region', 'advert.region', '=', 'region.id')
            ->join('category', 'advert.category', '=', 'category.id')
            ->join('users', 'advert.user_id', '=', 'users.id')
            ->where('advert.country', $id)
            ->orwhere('advert.city', $id)
            ->orwhere('advert.region', $id)
            ->where('advert.status', 1)
            ->orderBy('advert.updated_at', 'desc')->paginate(15);


        return view('regions.tsb')->with('regions_title', $region_title)->with('advert', $advert)->with('advertcount', $advertcount)->with('users', $users)->with('category', $category)->with('subcategory', $subcategory)->with('url', $title);
    }

    public function ShowPageCountry($account, $id)
    {
        $region_title = Country::where('id', $id)->first();

        $advertcount = Advert::select(DB::raw('count(*) as advert_count'))
            ->where('advert.region', '=', $id)
            ->get();

        $category = Category::select('category.*', DB::raw('(select count(*) from advert where advert.category = category.id and advert.region = ' . $id . ') as count_sub'))
            ->where('category.id', '<>', '36')
            ->orderBy('title', 'ASC')
            ->get();

        $users = User::select(DB::raw('count(*) as user_count'))
            ->get();

        $title = str_slug($category[0]->title, "-");

        $subcategory = Subcategory::select(DB::raw('count(*) as subcategory_count'))
            ->get();

        $advert = Advert::with('types')->
        select('advert.*', 'category.title AS categorytitle', 'region.name AS region_title', 'advert.show AS `show`')
            ->join('region', 'advert.region', '=', 'region.id')
            ->join('category', 'advert.category', '=', 'category.id')
            ->join('users', 'advert.user_id', '=', 'users.id')
            ->where('advert.country', $id)
            ->orwhere('advert.city', $id)
            ->orwhere('advert.region', $id)
            ->where('advert.status', 1)
            ->orderBy('advert.updated_at', 'desc')->paginate(15);


        return view('regions.tsb')->with('regions_title', $region_title)->with('advert', $advert)->with('advertcount', $advertcount)->with('users', $users)->with('category', $category)->with('subcategory', $subcategory)->with('url', $title);
    }

    public function ShowSubcategory($account, $id)
    {
        $region0 = Region::where('slug', $account)->get()->toArray();
        $region1 = City::where('slug', $account)->get()->toArray();
        $region2 = Country::where('slug', $account)->get()->toArray();

        $region = array_merge($region0, $region1, $region2);


        $category = Category::where('slug', $id)->get();

        if (!$region1) {

        } else {
            $subcategory = Subcategory::select('subcategory.*', DB::raw('(select count(*) from advert where advert.subcategory = subcategory.id and advert.city = ' . $region[0]['id'] . ') as count_adv'), 'category.title as category_title')
                ->join('category', 'category.id', '=', 'subcategory.category_id')
                ->where('category_id', '=', $category[0]['id'])
                ->orderBy('title', 'ASC')
                ->get();
        }
        if (!$region0) {

        } else {
            $subcategory = Subcategory::select('subcategory.*', DB::raw('(select count(*) from advert where advert.subcategory = subcategory.id and advert.region = ' . $region[0]['id'] . ') as count_adv'), 'category.title as category_title')
                ->join('category', 'category.id', '=', 'subcategory.category_id')
                ->where('category_id', '=', $category[0]['id'])
                ->orderBy('title', 'ASC')
                ->get();
        }
        if (!$region2) {

        } else {
            $subcategory = Subcategory::select('subcategory.*', DB::raw('(select count(*) from advert where advert.subcategory = subcategory.id and advert.country = ' . $region[0]['id'] . ') as count_adv'), 'category.title as category_title')
                ->join('category', 'category.id', '=', 'subcategory.category_id')
                ->where('category_id', '=', $category[0]['id'])
                ->orderBy('title', 'ASC')
                ->get();
        }


        $title = str_slug($subcategory[0]->title, "-");

        return view('subcategory')->with('subcategory', $subcategory)->with('url', $title)->with('opisan', $category);
    }

    public function ShowSubcategoryRegions($id, $region)
    {

        $subcategory = Subcategory::select('subcategory.*', DB::raw('(select count(*) from advert where advert.subcategory = subcategory.id and advert.region = ' . $id . ') as count_adv'), 'category.title as category_title')
            ->join('category', 'category.id', '=', 'subcategory.category')
            ->where('category', '=', $region)
            ->get();

        $title = str_slug($subcategory[0]->title, "-");

        return view('regions.subcategory')->with('subcategory', $subcategory)->with('url', $title);
    }


    public function ShowAdvert($account, $id)
    {

        $region0 = Region::where('slug', $account)->get()->toArray();
        $region1 = City::where('slug', $account)->get()->toArray();
        $region2 = Country::where('slug', $account)->get()->toArray();

        $region = array_merge($region0, $region1, $region2);

        $name = Subcategory::where('slug', $id)->get();
        $advert = Advert::with('types')->
        select('advert.*', 'category.title AS categorytitle', 'region.name AS region_title', 'advert.show AS `show`')
            ->join('region', 'advert.region', '=', 'region.id')
            ->join('city', 'advert.city', '=', 'city.id')
            ->join('country', 'advert.country', '=', 'country.id')
            ->join('category', 'advert.category', '=', 'category.id')
            ->join('users', 'advert.user_id', '=', 'users.id')
            ->where('region.id', $region[0]['id'])
            ->orwhere('country.id', $region[0]['id'])
            ->orwhere('city.id', $region[0]['id'])
            ->where('subcategory', $name[0]['id'])
            ->where('advert.status', 1)
            ->orderBy('advert.id', 'desc')->paginate(15);
        #dd($advert);

        $advertcategory = Advert::
        select('advert.*', 'category.title AS categorytitle', 'subcategory.title AS subcategorytitle', 'region.name AS region_title')
            ->join('region', 'advert.region', '=', 'region.id')
            ->join('category', 'advert.category', '=', 'category.id')
            ->join('subcategory', 'advert.subcategory', '=', 'subcategory.id')
            ->join('users', 'advert.user_id', '=', 'users.id')
            ->where('subcategory', '=', $name[0]['id'])
            ->orderBy('advert.id', 'desc')->take(1)->get();


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


        return view('advert')->with('advert', $advert)->with('titlecategory', $advertcategory)->with('opisan', $name);
    }

    public function showAdvertsnow($account, $id)
    {
        $advert = Advert::with('types')->
        select('advert.*', 'category.title AS categorytitle', 'region.name AS region_title',
            'advert.show AS `show`')
            ->join('region', 'advert.region', '=', 'region.id')
            ->join('category', 'advert.category', '=', 'category.id')
            ->join('users', 'advert.user_id', '=', 'users.id')
            ->where('advert.slug', $id)->get();

        #dd($advert);

        $new_text = preg_replace("/\b((http(s?):\/\/)|(www\.))([\w\.]+)([\/\w+\.]+)([\?\w+\.\=]+)([\&\w+\.\=]+)\b/i", "<a href=\"http$3://$4$5$6$7$8\" target=\"_blank\">$2$4$5$6$7$8</a>", $advert[0]->content);


        $new = Advert::
        select('advert.*',
            'category.title AS categorytitle',
            'region.name AS region_title',

            'advert.show AS `show`')
            ->join('region', 'advert.region', '=', 'region.id')
            ->join('category', 'advert.category', '=', 'category.id')
            ->join('users', 'advert.user_id', '=', 'users.id')
            ->where('advert.id', '<>', $advert[0]->id)
            ->where('users.id', '=', $advert[0]->user_id)->orderBy('id', 'desk')->paginate(5);

        $vacants = Job::where('user_id', $advert[0]->user_id)->get();

        $user = User::with('attributes')->where('id', $advert[0]['user_id'])->get();
        foreach ($user as $users) {
            foreach ($users->attributes as $item) {
                $region = Region::select('name')->where('id', $item->region)->get();
                $city = City::select('name')->where('id', $item->city)->get();
            }
        }

        $region_meta = Region::where('slug', $account)->get();


        return view('advertshow', compact('advert', 'new', 'region', 'city', 'user', 'account', 'region_meta', 'vacants'));
    }

    public function showSpros($account)
    {
        $region0 = Region::where('slug', $account)->get()->toArray();
        $region1 = City::where('slug', $account)->get()->toArray();
        $region2 = Country::where('slug', $account)->get()->toArray();

        $test = array_merge($region0, $region1, $region2);
        $spros = Advert::
        select('advert.*', 'region.name as region_title')
            ->join('region', 'advert.region', '=', 'region.id')
            ->where('advert.show', '=', '0')
            ->where('advert.status', 1)
            ->where('advert.region', $test[0]['id'])
            ->orwhere('advert.city', $test[0]['id'])
            ->orwhere('advert.country', $test[0]['id'])
            ->orderBy('advert.id', 'DESC')->paginate(15);

        $region = Region::where('country_id', '=', 0)->orderBy('name')->get();
        $city = City::orderBy('name')->get();

        $country = Country::whereIn('id', [0, 5, 21, 52, 78, 81, 89, 99, 101, 106, 121, 146, 191, 1])->orderBy('name')->get();

        return view('spros', compact('spros', 'region', 'country', 'city'));
    }

    public function postSpros(Request $request)
    {
        $spros = new Advert();

        $spros->title = $request->title;

        $spros->region = $request->region;
        $spros->country = $request->country;
        $spros->city = $request->sity;
        $spros->number = $request->number;
        $spros->email = $request->email;
        $spros->content = $request->content;
        $spros->category = '36';
        $spros->subcategory = '339';
        $spros->user_id = '2';
        $spros->show = '0';
        $spros->status = '0';

        $spros->save();

        Advert::where('id', $spros->id)->update(array('slug' => $request->title . '-' . $spros->id));

        return redirect()->back()->with('status', 'Ваше объявление на модерации');
    }

    public function addfollowers(Request $data)
    {


        $v = Validator::make($data->all(), [
            'category' => 'required',
            'subcategory' => 'required',
            'email' => 'required|email|max:255',
        ]);

        if ($v->fails()) {
            # dd($v->errors());
            return redirect()->back()->withErrors($v->errors());
        }
        $delivery = Delivery::create($data->except('_token'));

        $category = Category::where('id', $data->category)->pluck('title')->get();


        $subcategory = Subcategory::where('id', $data->subcategory)->pluck('title')->get();

        $sends = Delivery::select('email')->where('email', '=', $data->email)->get();


        Notification::send($sends, new WorkoutAssigned($delivery, $category, $subcategory));

        #$delivery = Delivery::create($request->all());

        #$delivery->email = $request->email;

        #$delivery->category = $request->category;

        #$delivery->subcategory = $request->subcategory;

        #$delivery->save();


        return back()->with('status', 'Вы подписались на рассылку');

    }

    #public function favoritePost($id,$name)
    #{
    #    $pdo = DB::table('izbrannoe')
    #        ->select('izbrannoe.*',DB::raw('(select count(*) from izbrannoe where izbrannoe.advert_id = '.$name.' and izbrannoe.user_id = '.$id.') as count_izb'))
    #        ->where('advert_id','=',$name)->where('user_id','=',$id)->get();
    #
    #    dd($pdo);
    #    $pdo1 = count($pdo);


    #   DB::table('izbrannoe')->insert(
    #       ['user_id' => $id, 'advert_id' => $name]
    #   );

    #   return view('advert')->with('count_izb',$pdo1);
    #}

    #public function favoriteDeletePost($id,$name)
    #{
    #   DB::table('izbrannoe')->where('user_id', '=', $id)->where('advert_id','=',$name)->delete();

    #}

    public function regionSelectPost($account, $name)
    {

        //$this->data['regions'] = $region->getRegions($name);
        $array0 = Region::where('name', 'LIKE', '%' . $name . "%")->get()->toArray();
        $array1 = City::where('name', 'LIKE', '%' . $name . "%")->get()->toArray();
        $array2 = Country::where('name', 'LIKE', '%' . $name . "%")->get()->toArray();

        $array = array_merge($array0, $array1, $array2);


        return $array;

    }

    //public function favouritesGet()
    //{
    //   $advert = DB::table('advert')
    //      ->select('advert.*','category.title AS categorytitle','region.name AS region_title','user.sity AS sity','advert.show AS `show`','user.number AS numbers','user.email AS email')
    //      ->join('region', 'advert.region','=','region.id')
    //     ->join('category', 'advert.category','=','category.id')
    //     ->join('user','advert.user_id','=','user.id')

    //            ->orderBy('advert.id','desc')->paginate(15);
    //
    //      $favourites = DB::table('izbrannoe')->where('izbrannoe.user_id','=',Auth::user()->id)
    //        ->join('advert','advert_id','=','advert.id')
    //      ->get();


    //        return view('lk.favourites')->with('advert',$favourites);

    //  }


    public function editPost(Request $request, $id)
    {

        $user_id = Auth::user()->id;
        if ($request->file('file') != '') {
            $filename = $request->file('file')->getClientOriginalName();
            $Path = public_path('image/archive/' . $user_id . '/register/picture');
            $Path_load = 'image/archive/' . $user_id . '/register/picture';
            $request->file('file')->move($Path, $filename);
            $data = $request->except(['file']);
            $data['file'] = $filename;
            $request->request->add(['filename' => $filename]);

        } else {

            $filename = Advert::select('filename')->where('user_id', '=', $user_id)->where('id', '=', $id)->get();

            $filename = $filename[0]->filename;

            $request->request->add(['filename' => $filename]);

            $carbon = Carbon::now();

            dd($carbon);

            $request->request->add(['updated_at' => $carbon]);

        }

        Advert::where('id', '=', $id)->where('user_id', '=', $user_id)->update($request->except('_token', 'file'));

        return redirect()->back();
    }

    public function deletePost($id)
    {

    }
}
