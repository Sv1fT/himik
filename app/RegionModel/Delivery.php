<?php

namespace App\RegionModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * App\RegionModel\Delivery
 *
 * @property int $id
 * @property string $email
 * @property string $category
 * @property string $subcategory
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Delivery whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Delivery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Delivery whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Delivery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Delivery whereSubcategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\RegionModel\Delivery whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Delivery extends Model
{
    use Notifiable;

    protected $fillable = ['category', 'email', 'subcategory'];

    protected $table = 'delivery';

    public function routeNotificationForMail()
    {
        return $this->email;
    }
}
