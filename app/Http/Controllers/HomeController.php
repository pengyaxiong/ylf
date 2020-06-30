<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Config;
use App\Models\Banner;
use App\Models\Business;
use App\Models\Mission;
use App\Models\Principle;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
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
        $config = Config::first();
        view()->share([
            'lan' => $this->language,
            '_index' => 'on',
            'config' => $config,
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
        $articles = Article::where('language', $this->language)->where('is_login', 1)->orderby('sort_order')->limit(2)->get();

        return view('home', compact('banners', 'mission', 'principle', 'business', 'articles'));
    }

    public function password()
    {
        return view('password');
    }

    public function reset_password(Request $request)
    {
        $email = $request->email;
        $code = $request->code;
        $password = $request->password;

        $code_ = Cache::get($email);

        if ($code_!=$code){
            return back()->with('notice','验证码错误');
        }

        if (!$password){
            return back()->with('notice','密码不能为空');
        }


        $user_info = User::where(array('email' => $email))->exists();
        if (!$user_info) {
            return back()->with('notice','未找到该邮箱用户');
        }

        User::where(array('email' => $email))->update([
            'password'=>Hash::make($password)
        ]);
        return back()->with('notice','修改成功');
    }
}
