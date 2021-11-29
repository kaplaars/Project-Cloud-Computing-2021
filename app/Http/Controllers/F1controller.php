<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class F1controller extends Controller
{
//view oproepen----------------------
    public function homepage(){
        return view('homepage');
    }
    public function highlights(){
        return view('highlights');
    }
    public function championschip(){
        return view('championschip');
    }
    public function calender(){
        return view('calender');
    }
//-----------------------------------
}
