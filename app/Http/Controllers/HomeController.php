<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function about()
    {
        return view('website.about');
    }

    public function contact()
    {
        return view('website.contact');
    }
}
