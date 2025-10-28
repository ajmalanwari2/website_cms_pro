<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('web_pages.index');
    }

     public function about_us(){
        return view('web_pages.about_us');
    }

     public function setLocale($locale){
        if(in_array($locale, ['en', 'da', 'pa', 'ger'])){
            App::setLocale($locale);
            Session::put('locale', $locale);
        }
        return back();
    }
}
