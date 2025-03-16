<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index(){
        $titulo = "Home";
        return view("modules.dashboard.home", compact("titulo"));
    }
}
