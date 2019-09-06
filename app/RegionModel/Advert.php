<?php
/**
 * Created by PhpStorm.
 * User: Sv1fT
 * Date: 16.11.2016
 * Time: 18:32
 */

namespace App\RegionModel;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;


/**
 * App\RegionModel\Advert
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $date
 * @property string $content
 * @property int $user_id
 * @property string $filename
 * @property int $status
 * @property int $category
 * @property int $subcategory
 * @property string $region
 * @property string $number
 * @property string $city
 * @property string $country
 * @property string $email
 * @property string $site_uri
 * @property int $show
 * @property int $views
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\City $citys
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\RegionModel\AdvertType[] $roles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\AdvertType[] $types
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereSiteUri($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereSubcategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Advert whereViews($value)
 * @mixin \Eloquent
 */
class Advert extends Model
{

    protected $fillable = ['title', 'content', 'price', 'type', 'mass', 'user_id', 'category', 'subcategory', 'sity', 'region', 'number', 'email', 'show','filename'];
    protected $table = 'advert';

    public function roles()
    {
        return $this->belongsToMany(AdvertType::class);
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
        return DB::table('advert')
            ->select('advert.*','category.title AS categorytitle','region.name AS region_title','advert.show AS `show`',DB::raw('count(*) as advert_count'))
            ->join('region', 'advert.region','=','region.id')
            ->join('category', 'advert.category','=','category.id')
            ->where('advert.user_id','=',Auth::user()->id)

            ->get();


    }

    public function getAdverts()
    {
        return Advert::where('advert.show','=','1')
            ->where('advert.user_id','=',Auth::user()->id)
            ->orderBy('id','DESC')->paginate(7);
    }

    public function category()
    {
        return DB::table('category')->where('id','<>',36)->get();
    }

    public function subcategory()
    {
        return DB::table('subcategory')->get();
    }

    public function getOrderField()
    {
        return 'custom_order_field_name';
    }
}

