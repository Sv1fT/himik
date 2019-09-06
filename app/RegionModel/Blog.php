<?php

namespace App\RegionModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * App\RegionModel\Blog
 *
 * @property int $id
 * @property int $user_id
 * @property int $active
 * @property string $name
 * @property string $file
 * @property string $slug
 * @property string $content
 * @property string $url
 * @property string $filename
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property int|null $region
 * @property int|null $city
 * @property int|null $country
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog blog()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Blog whereUserId($value)
 * @mixin \Eloquent
 */
class Blog extends Model
{
    protected $table = "blog";

    public function getBlog()
    {
        return $this->blog()->get();
    }

    public function getBlogItem()
    {
        $data = Blog::where('active','=','0')->where('user_id','=',Auth::user()->id)->get();

        

        return $data;
    }


    public function scopeBlog($query)
    {
        $query->where('user_id','=',Auth::user()->id);
    }
}
