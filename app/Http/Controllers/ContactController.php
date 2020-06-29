<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class ContactController extends Controller
{
    private $language;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $lan = Cookie::get('language', 'cn');
        $this->language = $lan == 'cn' ? 1 : 0;
        $config=Config::first();
        view()->share([
            'lan'=> $this->language,
            '_contact'=> 'on',
            'config'=> $config,
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact');
    }
}
