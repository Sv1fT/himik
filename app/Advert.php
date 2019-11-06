<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use \SleepingOwl\Admin\Traits\OrderableModel;

class Advert extends Model
{
    protected $fillable = ['title', 'content', 'price', 'type', 'mass', 'user_id', 'category', 'status', 'subcategory', 'sity', 'region', 'number', 'email', 'show','filename'];
    protected $table = 'advert';

    protected $timestamp = false;

    public function roles()
    {
        return $this->belongsToMany(AdvertType::class);
    }

    public function roless()
    {
        return $this->hasOne(AdvertType::class);
    }

    public function users()
    {
        return $this->belongsTo(\App\UserAttributes::class,'user_id','user_id');
    }

    public function types()
    {
        return $this->hasMany('App\AdvertType');
    }

    public function citys()
    {
        return $this->belongsTo(\App\City::class,'city','id');
    }


    public function getCountadvert()
    {
        return Advert::select('advert.*','category.title AS categorytitle','region.name AS region_title','advert.show AS `show`',DB::raw('count(*) as advert_count'))
            ->join('region', 'advert.region','=','region.id')
            ->join('category', 'advert.category','=','category.id')
            ->where('advert.user_id','=',Auth::user()->id)

            ->get();


    }

    public function getAdverts()
    {
        return Advert::with('types')->where('advert.show','=','1')
            ->where('advert.user_id','=',Auth::user()->id)
            ->orderBy('updated_at','DESC')->paginate(7);
    }

    public function category()
    {
        return Category::where('id','<>',36)->orderBy('title','asc')->get();
    }

    public function subcategory()
    {
        return Subcategory::orderBy('title','asc')->get();
    }

}
