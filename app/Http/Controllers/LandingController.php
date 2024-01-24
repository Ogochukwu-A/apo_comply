<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    //
    public function index()
    {
        return view("welcome");
    }

    public function about()
    {
        return view("pages.about");
    }

    public function services()
    {
        return view("pages.services");
    }
    public function contact()
    {
        return view("pages.contact");
    }
}
