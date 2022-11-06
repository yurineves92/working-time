<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Information about the site and a few more things. 
     */
    public function index()
    {
        return view('index');
    }

    /**
     * About for me
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Contact for developer
     */
    public function contact()
    {
        return view('contact');
    }
}
