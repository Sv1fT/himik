<?php

namespace App\Http\Controllers\Regions;

use App\City;
use App\Mails;
use App\Region;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Advert;
use App\Subcategory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;


class TestController extends Controller
{
    public function index($account)
    {
        $advert = Advert::get();


        Carbon::setLocale('ru');
        $dt = Carbon::createFromFormat('Y-m-d H:i:s',$advert[0]->created_at)->diffForHumans();






        dd($dt);

    }

    public function SubcategorySelect($account,$id)
    {

        $array = Subcategory::where('category_id','=',$id)->orderBy('title','asc')->get();



        return $array;
    }

    public function regionSelect($account,$id)
    {
        $array = City::where('region_id',$id)->get();
        return $array;
    }

    public function citySelect($account,$id)
    {
        $array = City::where('name','LIKE','%'.$id."%")->get()->toArray();
        return $array;
    }

    public function countrySelect($account,$id)
    {
        $array = Region::where('country_id',$id)->get();

        return $array;
    }



    public function emailsend($account,Request $request)
    {



        #$emailu = DB::table('user')->where('id','=',$request->input('userid'))->get();
        $name = $request->input('name');
        $email = $request->input('email');
        $description = $request->input('content');
        $url = $_SERVER['HTTP_REFERER'];
        $phone = $request->input('phone');

        $city = file_get_contents('http://api.sypexgeo.net/json/' . $request->getClientIp());
        $city = json_decode($city);

        $mail = new Mails();
        $mail->name = $name;
        $mail->email=$email;
        $mail->massage=$description;
        $mail->number=$phone;
        $mail->url=$url;
        $mail->country=$city->country->name_ru;
        $mail->region=$city->region->name_ru;
        $mail->city=$city->city->name_ru;
        $mail->ip=$_SERVER['REMOTE_ADDR'];
        $mail->save();


        Mail::send('emails.feedback',['url'=>$url,'name'=>$name,'email'=>$email,'phone'=>$phone,'content'=>$description], function ($u) use ($request){
            $u->to($request->input('user_email'),'123')->subject('Вам ответили');
        });
        return Redirect::back();
    }

    public function emailsendVacant($account,Request $request)
    {

        $date = $request->url;
        $slug = $pieces = explode("/", $date);
        if($slug['3'] == 'vacant')
        {
            $user_name = Job::with('value')->where('slug',$slug['4'])->first();
        }
        else{
            $user_name = Rezume::with('attributes')->where('slug',$slug['4'])->first();
        }
                
        $user_mail = User::find($user_name->user_id);
        #$emailu = DB::table('user')->where('id','=',$request->input('userid'))->get();
        $name = $request->input('name');
        $email = $request->input('email');
        $description = $request->input('content');
        $url = $_SERVER['HTTP_REFERER'];
        $phone = $request->input('phone');

        $city = file_get_contents('http://api.sypexgeo.net/json/' . $request->getClientIp());
        $city = json_decode($city);

        $mail = new Mails();
        $mail->name = $name;
        $mail->email=$email;
        $mail->massage=$description;
        $mail->number=$phone;
        $mail->url=$url;
        $mail->country=$city->country->name_ru;
        $mail->region=$city->region->name_ru;
        $mail->city=$city->city->name_ru;
        $mail->ip=$_SERVER['REMOTE_ADDR'];
        $mail->save();

        if($slug['3'] == 'vacant')
        {
            Mail::send('emails.vacants',['user_name'=>$user_name->value->name,'url'=>$url,'name'=>$name,'email'=>$email,'phone'=>$phone,'content'=>$description], function ($u) use ($user_mail){
                $u->to($user_mail->email,'123')->subject('Вам ответили');
            });
        }
        else{
            Mail::send('emails.vacants',['user_name'=>$user_name->fio,'url'=>$url,'name'=>$name,'email'=>$email,'phone'=>$phone,'content'=>$description], function ($u) use ($user_name){
                $u->to($user_name->email,'123')->subject('Вам ответили');
            });
        }
        return Redirect::back();
    }

    public function update_advert_admin($account,Request $request)
    {
        $val = $request->id;
        foreach ($val as $item){

            Advert::where('id',$item)->update(['status'=>'1']);
        }

    }
}
