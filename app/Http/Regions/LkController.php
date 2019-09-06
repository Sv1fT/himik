<?php

namespace App\Http\Controllers\Regions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LkController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            return view('lk.profile');
        }
        else
        {
            return redirect('login');
        }

    }

}
