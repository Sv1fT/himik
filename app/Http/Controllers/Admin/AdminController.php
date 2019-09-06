<?php

namespace App\Http\Controllers\Admin;

use App\Advert;
use App\Blog;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $countusers = count(User::all());
        $countadverts = count(Advert::all());
        $countblog = count(Blog::all());

        return view('admin.dashboard')->with(compact('countusers','countadverts','countblog'));
    }
}
