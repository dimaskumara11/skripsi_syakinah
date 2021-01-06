<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class Logout extends Controller
{
    public function index(Session $sess){
        $sess->flush();
        return redirect(route("login"));
    }
}
