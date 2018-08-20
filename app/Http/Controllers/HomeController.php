<?php

namespace App\Http\Controllers;

use App\Match;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = Match::all();
        return view('home.index', compact('matches'));
    }
}
