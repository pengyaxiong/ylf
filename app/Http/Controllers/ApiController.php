<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
class ApiController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }


    public function contact(Request $request)
    {
        try {
            $messages = [
                'name.required' => '姓名不能为空!',
                'email.required' => '邮箱不能为空!',
            ];
            $rules = [
                'phone' => 'required',
                'email' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                $error = $validator->errors()->first();

                return ['status' => 0, 'msg' => $error];
            }
            Contact::create($request->all());

        } catch (\Exception $exception) {

            Log::error($exception->getMessage());

            return ['status' => 0, 'msg' => $exception->getMessage()];
        }

        return $this->null();
    }

    /**
     * @param Request $request
     * @return array
     */
    public function email_code(Request $request)
    {
        $email = $request->email;

        $user_info = User::where(array('email' => $email))->exists();
        if ($user_info) {
            return ['status' => 0, 'msg' => '该手机号已经注册过'];
        }
        $num = rand(1000, 9999);

        $minutes = 24 * 60;
        Cache::store('database')->put($email, $num, $minutes);

        Mail::send('auth.send_mail', ['user' => $email, 'info' => $num], function ($message) use ($email) {
            $message->subject('邮箱验证');
            $message->to($email);
        });

        return ['status' => 1, 'msg' => '发送成功'];
    }


    public function language(Request $request)
    {
        $language=$request->language;

        setcookie('language', $language, 24*60*60, '/');

        //  Cookie::queue('language', 'cn', 24*60);

        return ['status' => 1, 'msg' => '切换'];

    }
}
