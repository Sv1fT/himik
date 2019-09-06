<?php

namespace App\Http\Controllers\Regions;

use App\Advert;
use App\AdvertType;
use App\City;
use App\Country;
use App\Delivery;
use App\Notifications\AddAdvert;
use App\Notifications\WorkoutAssigned;
use App\Region;
use App\RegionModel\Category;
use App\Subcategory;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;

class MyAdvertController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Advert $advert,$account)
    {
        if(Auth::check())
        {
            $this->data['advert_count'] = $advert->getCountadvert();
            $this->data['category'] = $advert->category();
            $this->data['subcategory'] = $advert->subcategory();
            $this->data['adverts'] = $advert->getAdverts();



            return view('lk.myadvert',$this->data);
        }
        else
        {
            return redirect('login');
        }


    }

    public function add(Request $request)
    {

        #dd($request);

        $this->validate($request, [
            'name' => 'required',
            'content'=>'required',

            'file' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        foreach($request['type'] as $type)
        {
            $types = $type;
        }

        foreach ($request['mass'] as $masses)
        {
            $mass = $masses;
        }

        foreach ($request['price'] as $prices)
        {
            $price = $prices;
        }

        $title = strip_tags($request['name'],'<br>');
        $content = strip_tags($request['content'],'<br>');
        $types = strip_tags($types,'<br>');
        $mass = strip_tags($mass,'<br>');
        $price = strip_tags($price,'<br>');

        $user_id = Auth::user()->id;

        $blog = new Advert();

        if($request->file('file') != '')
        {
            $filename = str_random(6).'_'.$request->file('file')->getClientOriginalName();
            $Path = public_path( 'upload/'.$user_id.'/picture/picture/');
            $Path_load = 'upload/'.$user_id.'/picture/picture/';
            $request->file('file')->move($Path, $filename);
            $data = $request->except(['file']);
            $data['file'] = $Path_load.$filename;

        }
        else {
            $data['file'] = '';
        }

        $region0 = Auth::user()->region;
        $city0 = Auth::user()->city;
        $country0 = Auth::user()->country;

        $region = Region::where('name',$region0)->get()->toArray();
        $city = City::where('name',$city0)->get()->toArray();
        $country = Country::where('name',$country0)->get()->toArray();

        $мир = array_merge($region,$city,$country);


        $blog->title = $title;

        $blog->content = $content;
        $blog->category = $request['category'];
        $blog->subcategory = $request['subcategory'];
        $blog->region = $мир[0]['id'];
        $blog->city = $мир[1]['id'];
        $blog->country = $мир[2]['id'];
        $blog->show = '1';
        $blog->user_id = $user_id;


        $blog->filename = $data['file'];

        $blog->save();




        $advert_id = Advert::orderBy('id','desk')->first();

        $title = str_slug($title);

        Advert::where('id',$advert_id->id)->update(array('slug' => $title.'-'.$advert_id->id));

        $AdvertType = new AdvertType();
        $AdvertType->advert_id = $blog->id;
        $AdvertType->user_id = Auth::id();
        $AdvertType->type = $types;
        $AdvertType->mass = $mass;
        $AdvertType->price = $price;

        $AdvertType->save();



        $titlesubcategory = Subcategory::where('id','=',$request['subcategory'])->get();

        $getmail = Delivery::where('subcategory','=',$request['subcategory'])->where('category',$request['category'])->get();

        $category = Category::where('id',$blog->category)->get();



        $subcategory = Subcategory::where('id',$blog->subcategory)->get();

        Notification::send($getmail , new AddAdvert($blog,$titlesubcategory,$category,$subcategory));

        return Redirect::back();
    }

    public function editPost($account,Request $request,$id)
    {

        #dd($request);

        if(Auth::check())
        {
            $title = strip_tags($request['title'],'<br>');
            $content = strip_tags($request['content'],'<br>');
            $types = $request['type'];
            $mass = $request['mass'];
            $price = $request['price'];


#dd($types);

            $user_id = Auth::user()->id;
            $blog = Advert::find($id);


            if($request->file('file') != '')
            {
                $filename = str_random(6).'_'.$request->file('file')->getClientOriginalName();
                $Path = public_path( 'upload/'.$user_id.'/picture/picture/');
                $Path_load = 'upload/'.$user_id.'/picture/picture/';
                $request->file('file')->move($Path, $filename);
                $data = $request->except(['file']);
                $data['file'] = $Path_load.$filename;

            }
            else {

                #dd($request);
                $filename = Advert::select('filename')->where('user_id', '=', $user_id)->where('id', '=', $id)->get();

                if(!empty($request['imageChange']))
                {
                    #var_dump($filename[0]['filename']);
                    $data['file'] = $filename[0]->filename;


                }
                else{

                    if(!empty($filename[0]['filename']))
                    {
                        unlink($filename[0]['filename']);
                    }
                    else{

                    }

                    $data['file'] = '';
                }
                #$data['file'] = $filename[0]->filename;


            }

            $blog->title = $title;
            $blog->slug = str_slug($title).'-'.$id;
            $blog->content = $content;
            $blog->category = $request['category'];
            $blog->subcategory = $request['subcategory'];
            $blog->region = $request['region'];
            $blog->show = '1';
            $blog->user_id = $user_id;
            $blog->updated_at = Carbon::now();


            $blog->filename = $data['file'];

            $blog->save();




            $advert_id = Advert::orderBy('id','desk')->first();
            $title = str_slug($title);

            #Advert::where('id',$advert_id->id)->update(array('slug' => $title.'-'.$advert_id->id));

            $advert_type_count = AdvertType::where('advert_id',$id)->get();

            $advert_type_ids = AdvertType::select('id')->where('advert_id',$id)->get();

            if(count($advert_type_count) >= 2)
            {
                for($i = 0;$i<2;$i++)
                {

                    $AdvertType = AdvertType::find($advert_type_ids[$i]->id);

                    $AdvertType->advert_id = $blog->id;
                    $AdvertType->user_id = Auth::id();
                    $AdvertType->type = $types[$i];
                    $AdvertType->mass = $mass[$i];
                    $AdvertType->price = $price[$i];

                    $AdvertType->save();
                }
            }
            else
            {
                for($i = 0;$i<2;$i++)
                {
                    $AdvertType = new AdvertType();

                    #dd($AdvertType);
                    #dd($types[$i]);

                    $AdvertType->advert_id = $blog->id;
                    $AdvertType->user_id = Auth::id();
                    $AdvertType->type = $types[$i];
                    $AdvertType->mass = $mass[$i];
                    $AdvertType->price = $price[$i];

                    $AdvertType->save();
                }
            }


            #dd($items);
            return redirect('/myadvert');
        }
        else
        {
            return redirect('login');
        }


    }

    public function editGet($account,$id)
    {

        $category = Category::where('id','<>',36)->get();

        $subcategory = Subcategory::where('id','<>',339)->get();

        $items = Advert::with('types')->where('id','=',$id)
            ->where('user_id','=',Auth::user()->id)
            ->get();


        return view('edit.editadvert',compact('category','items','subcategory'));
    }

    public function deletePost($account,$id)
    {

        $blog = Advert::find($id);

        if(!empty($blog->filename))
        {
            unlink($blog->filename);
        }
        else{

        }

        $blog->delete();

        $advert_type_ids = AdvertType::select('id')->where('advert_id',$id)->first();


        $AdvertType = AdvertType::find($advert_type_ids->id);
        $AdvertType->delete();
    }

    public function refresh($account,$id)
    {
        Advert::where('user_id',$id)->update(array('date'=> Carbon::now()));
    }
}
