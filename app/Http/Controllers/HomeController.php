<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\State;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $data = Setting::where('id', 1)->first();
        return view ('home.index', compact('data'));

    }
    public function setup(){
        $states = State::all();
        $data = Setting::where('id', 1)->first();
        return view ('setup', compact('data', 'states'));

    }
}
