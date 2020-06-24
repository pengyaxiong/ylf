<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class ContentController extends Controller
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
        return view('content');
    }

    public function content_detail()
    {
        return view('content_detail');
    }
}
