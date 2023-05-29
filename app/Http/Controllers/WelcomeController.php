<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(){
        $title="Homepage";
        return view('welcome',compact(['title']));
    }
}
