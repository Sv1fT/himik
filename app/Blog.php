<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Blog extends Model
{
    protected $table = "blog";

    public function getBlog()
    {
        return $this->blog()->get();
    }

    public function values()
    {
        return $this->belongsTo(UserAttributes::class, 'user_id','user_id');
    }

    public function getBlogItem()
    {
        $data = Blog::where('user_id','=',Auth::user()->id)->orderBy('id','desc')->paginate(5);

        

        return $data;
    }


    public function scopeBlog($query)
    {
        $query->where('user_id','=',Auth::user()->id);
    }
}
