<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index(){
        session(["active_menu"=>"dashboard"]);
        return view('page.dashboard');
    }
}
