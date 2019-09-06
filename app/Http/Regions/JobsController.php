<?php

namespace App\Http\Controllers\Regions;

use App\Country;
use App\City;
use App\Job;
use App\Razdel;
use App\Region;
use App\Rezume;
use App\Notifications\VacantMail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;

class JobsController extends Controller
{
    public function showPage($account)
    {
        $rezume = Rezume::orderBy('id','desk')->get();
        $razdel = Razdel::all();
        $vacant = Job::where('status',0)->paginate(7);
        $region_job = Region::orderBy('name','asc')->get();
        $country_job = Country::all();
        #dd($job);
        return view('jobs',compact('razdel','rezume','vacant', 'region_job', 'country_job'));
    }

    public function showResume($account,$name)
    {
        $jobs = Rezume::where('slug',$name)->get();
        $jobs_new = Rezume::where('slug','<>',$name)->paginate(5);
        return view('jobsshow',compact('jobs','jobs_new'));

    }

    public function showVacants($account,$id)
    {
        $vacant = Job::with('value')->where('status',0)->where('slug',$id)->get();
        $jobs_new = Job::with('value')->where('slug','<>',$id)->paginate(5);
        return view('lk.vacant_show',compact('vacant','jobs_new'));
    }

    public function showVacant($account)
    {
        $razdel = Razdel::all();
        $vacant = Job::where('status',0)->where('user_id',Auth::id())->paginate(7);
        $region = Region::orderBy('name','asc')->get();
        $country = Country::whereIn('id',[0,5,21,52,78,81,89,99,101,106,121,146,191,1])->orderBy('name','asc')->get();
        $city = City::orderBy('name','asc')->get();
        return view('lk.vacant',compact('razdel','vacant','region','city','country'));
    }

	public function MailerVacant($account,Request $request) {
    	$prev_url = URL::previous();
    	$vacant = Job::where('slug',$request->slug)->pluck('user_id');
    	$vacants = Job::where('slug',$request->slug)->pluck('name');
    	$vacants = $vacants[0];
    	$users = User::find($vacant[0]);
    	$name = $request->name;
    	$phone = $request->phone;
    	$email = $request->email;
    	$description = $request->content;
		Notification::send($users, new VacantMail($name,$phone,$email,$description,$prev_url,$vacants));

		return redirect()->back();
    }

    public function deleteVacant($account,$id)
    {
        Job::where('id',$id)->delete();

    }

    public function editVacant($account,$id)
    {

        $razdel = Razdel::all();
        $vacant = Job::where('id',$id)->get();
        $city = City::orderBy('name','asc')->get();
        return view('edit.vacant',compact('vacant','city','razdel'));
    }

    public function editVacantPost($account,Request $request,$id)
    {


        $vacant = Job::find($id);
        $vacant->city = $request->city;
        $vacant->category = $request->razdel;
        $vacant->country = Auth::user()->country;
        $vacant->region = Auth::user()->region;
        $vacant->name = $request->name;
        $vacant->slug = str_slug($request->name)."-".$id;
        $vacant->price = $request->price1;
        $vacant->price1 = $request->price2;
        $vacant->valute = $request->valute;
        $vacant->opit = $request->opit;
        $vacant->education = $request->education;
        $vacant->description = $request->description;
        $vacant->save();

        return redirect('vacant');
    }


    public function addVacantion($account,Request $request)
    {
        $vacant = new Job();
        $vacant['city'] = $request['city'];
        $vacant['region'] = Auth::user()->region;
        $vacant['country'] = Auth::user()->country;
        $vacant['user_id']= Auth::id();
        $vacant['category']= $request['razdel'];
        $vacant['name']= $request['name'];
        $vacant['price']= $request['price1'];
        $vacant['price1']= $request['price2'];
        $vacant['valute']= $request['valute'];
        $vacant['status']= 0;
        $vacant['opit']= $request['opit'];
        $vacant['education']= $request['education'];
        $vacant['description']= $request['description'];
        $vacant->save();

        $vacant_up = Job::find($vacant->id);
        $vacant_up['slug'] = str_slug($request['name'].'-'.$vacant->id);
        $vacant_up->save();
        return redirect()->back();
    }

    public function addRezume($account,Request $request)
    {
        #dd($request);
        $rezume = new Rezume();
        $rezume['city'] = $request['city'];
        if($request['pereezd'] == 'on')
            $rezume['pereezd'] = 'возможен переезд';
        else{
            $rezume['pereezd'] = 'Не готов к переезду';
        }
        $rezume['fio'] = $request['fio'];
        $rezume['email'] = $request['email'];
        $rezume['number'] = $request['number'];
        $rezume['age'] = $request['age'];
        $rezume['category'] = $request['razdel'];
        $rezume['dolzhnost'] = $request['dolzhnost'];
        $rezume['user_id']= Auth::id();
        $rezume['price'] = $request['price'];
        $rezume['opit'] = $request['opit'];
        $rezume['education'] = $request['education'];
        $rezume['language'] = $request['language'];
        $rezume['description'] = $request['description'];
        $rezume['status'] = '0';

        $rezume->save();

        $rezume_up = Rezume::find($rezume->id);
        $rezume_up['slug'] = str_slug($request['dolzhnost']."-".$rezume->id);
        $rezume_up->save();

        return redirect()->back();

    }
}
