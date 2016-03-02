<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\League;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Home extends Controller
{
    public function Index(){

        $user = null;
        $id;


        if(Auth::check()){
           $id = Auth::id();
           $user = User::where('id',$id)->firstOrFail();
        } else {
           $user = null;
        }



        return view('home', compact('user'));
    }

    public function About(){

        return view('pages.about');

    }

}
