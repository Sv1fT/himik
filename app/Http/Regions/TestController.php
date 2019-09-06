<?php

namespace App\Http\Controllers\Regions;

use App\City;
use App\Region;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Http\Request;
use App\Advert;
use App\Subcategory;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;


class TestController extends Controller
{
    public function index()
    {
        $advert = Advert::get();


        Carbon::setLocale('ru');
        $dt = Carbon::createFromFormat('Y-m-d H:i:s',$advert[0]->created_at)->diffForHumans();






        dd($dt);

    }

    public function postAdd($account,$id)
    {
        $array = Subcategory::where('category','=',$id)->get();



        return $array;
    }

    public function regionSelect($account,$id)
    {
        $array = City::where('region_id',$id)->get();
        return $array;
    }

    public function countrySelect($account,$id)
    {
        $array = Region::where('country_id',$id)->get();

        return $array;
    }

    public function reklams()
    {
        return view('reklama');
    }

    public function mailsend(Request $request)
    {
        $fio = $request->input('fio');
        $number = $request->input('number');
        $email = $request->input('email');
        $description = $request->input('description');

        Mail::send('emails.reklama',['fio'=>$fio, 'number'=>$number,'email'=>$email,'description'=>$description], function ($u) use ($request){
            $u->to('opt.himik.feedback@gmail.com','123')->subject('Заказ рекламы');
        });
        return redirect()->back();
    }

    public function emailsend(Request $request)
    {

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

        #DB::table('mailsend')->create('');
        Mail::send('emails.feedback',['url'=>$url,'name'=>$name,'email'=>$email,'phone'=>$phone,'content'=>$description], function ($u) use ($request){
            $u->to($request->input('user_email'),'123')->subject('Вам ответили');
        });
        return Redirect::back();
    }
}
