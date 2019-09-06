<?php

namespace App\Http\Controllers\Api;

use App\City;
use App\Country;
use App\ApiModels\Home;
use App\Advert;
use App\Region;
use App\User;
use Date\DateFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function index(Home $home)
    {


        $this->data['advertcount'] = $home->getCountadvert();
        $this->data['users'] = $home->getUsers();
        $this->data['category'] = $home->getCategory();
        $this->data['subcategory'] = $home->getSubcategory();
        $this->data['newadvert'] = $home->getNewadvertCreate();
        $this->data['newadvertUpdate'] = $home->getNewadvertUpdate();
        $this->data['productDay'] = $home->productDay();
        $this->data['vacants'] = $home->Vacants();
        $this->data['resume'] = $home->Resume();

        #dd($this->data);

       # dd($this->data['newadvert'][2]);




        $this->data['blog'] = $home->getBlog();
        $this->data['regions'] = $home->getRegions();
        $this->data['sledier'] = $home->getSlider();

        Session::forget('regiones');




        Carbon::setLocale('ru');
        #$this->data['blog'][0]['time'] = Carbon::createFromFormat('Y-m-d H:i:s',$this->data['blog'][0]->created_at)->diffForHumans();


    	return response()->json([
            'home'=>$this->data
        ]);
    }

    public function verify($token)
    {
        $user = User::where('token','=',$token)->get();

        User::where('id',$user[0]['id'])->update(array('status'=>'1'));

        return redirect('/profile');
    }
    public function Logout(Request $request)
    {
//        dd("123123123");
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/');
    }




    public function EmailChange()
    {
        return view('auth.passwords.change_email');
    }

    public function PasswordChange()
    {
        return view('auth.passwords.change_pass');
    }

    public function EmailChanger(Request $request)
    {
        $data = User::where('email',$request->old_email)->first();


        if(count($data) >= 1)
        {
            $data = User::find($data->id);
            $data->email = $request->email;
            $data->save();

            return redirect()->back()->with('status','Email успешно изменен. Необходимо перезайти что бы изменения вступили в силу');
        }
        else
        {
            return redirect()->back()->with('danger','Учетных данных с данным email не найдено');
        }

    }

    public function PasswordChanger(Request $request)
    {

        $data = User::where('email',$request->email)->first();

        if(count($data) >= 1)
        {
            $data = User::find($data->id);
            $data->password = bcrypt($request->password);
            $data->save();

            return redirect()->back()->with('status','Пароль успешно изменен успешно изменен. Необходимо перезайти что бы изменения вступили в силу');
        }
        else
        {
            return redirect()->back()->with('danger','Учетных данных с данным email не найдено');
        }

    }
}
