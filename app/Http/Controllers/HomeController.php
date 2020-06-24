<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Business;
use App\Models\Mission;
use App\Models\Principle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    private $language;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
        $lan = Cookie::get('language', 'cn');
        $this->language = $lan == 'cn' ? 1 : 0;

        view()->share([
           'lan'=> $this->language
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::where('language', $this->language)->orderby('sort_order')->limit(3)->get();
        $mission = Mission::where('language', $this->language)->orderby('sort_order')->first();
        $principle = Principle::where('language', $this->language)->orderby('sort_order')->first();
        $business = Business::where('language', $this->language)->orderby('sort_order')->limit(2)->get();

        return view('home', compact('banners'));
    }
}
