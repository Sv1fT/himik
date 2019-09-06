<?php
/**
 * Created by PhpStorm.
 * User: Sv1fT
 * Date: 16.11.2016
 * Time: 18:33
 */

namespace App\RegionModel;


use Illuminate\Database\Eloquent\Model;

/**
 * App\RegionModel\Category
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Category whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model
{
    protected $table = "category";
}