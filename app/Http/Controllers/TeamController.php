<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
class TeamController extends Controller
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

        $teams = Team::orderby('sort_order')->paginate(env(3));

        return  view('team',compact('teams'));
    }
}
