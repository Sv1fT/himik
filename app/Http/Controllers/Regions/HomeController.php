<?php

namespace App\Http\Controllers\Regions;

use App\City;
use App\Country;
use App\RegionModel\Home;
use App\RegionModel\Advert;
use App\RegionModel\Region;
use App\RegionModel\User;
use Date\DateFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index(Home $home,$account)
    {
        
        $region_tab0 = Region::where('region.slug',$account)->get()->toArray();
        $region_tab1 = City::where('slug',$account)->get()->toArray();
        $region_tab2 = Country::where('slug',$account)->get()->toArray();

        $region_tab = array_merge($region_tab0,$region_tab1,$region_tab2);


        session()->put('regiones',$region_tab[0]['name']);
        session()->put('regiones_id',$region_tab[0]['id']);
        session()->put('type_regions',$region_tab[0]);

        $test0 = Region::where('region.slug','=',$account)->get()->toArray();
        $test1 = City::where('slug','=',$account)->get()->toArray();
        $test2 = Country::where('slug','=',$account)->get()->toArray();

        $test = array_merge($test1,$test0,$test2);



        $this->data['advertcount'] = $home->getCountadvert($test[0]['id']);
        $this->data['users'] = $home->getUsers($test[0]['id']);


        $this->data['category'] = $home->getCategory($test[0]['id']);
        $this->data['subcategory'] = $home->getSubcategory($test[0]['id']);

        $this->data['newadvert'] = $home->getNewadvert($test[0]['id']);
        $this->data['newadvertUpdate'] = $home->getNewadvertUpdate($test[0]['id']);
        $this->data['blog'] = $home->getBlog($test[0]['id']);
        $this->data['regions'] = $home->getRegions($test[0]['id']);

        $this->data['regiones'] = $home->getRegion($test[0]['slug']);
        $this->data['sledier'] = $home->getSlider();
        $this->data['productDay'] = $home->productDay();
        $this->data['vacants'] = $home->Vacants($test);
        $this->data['resume'] = $home->Resume($test);


        Carbon::setLocale('ru');
        #$this->data['blog'][0]['time'] = Carbon::createFromFormat('Y-m-d H:i:s',$this->data['blog'][0]->created_at)->diffForHumans();

        return view('home',$this->data);
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
