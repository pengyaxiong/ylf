<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
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
                'city.required' => '地址不能为空!',
                'subject.required' => '问题不能为空!',
                'message.required' => '信息不能为空!',
            ];
            $rules = [
                'name' => 'required',
                'email' => 'required',
                'city' => 'required',
                'subject' => 'required',
                'message' => 'required',
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

        return ['status' => 1, 'msg' => '提交成功'];
    }

    /**
     * @param Request $request
     * @return array
     */
    public function email_code(Request $request)
    {
        $email = $request->email;
        $type = $request->type;

        $user_info = User::where(array('email' => $email))->exists();
        if ($type=='password'){
            if (!$user_info) {
                return ['code' => 500, 'message' => '未找到该邮箱用户'];
            }
        }else{
            if ($user_info) {
                return ['code' => 500, 'message' => '该邮箱已经注册过'];
            }
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

        $languageCookie = Cookie::forever('language',$language);

        return Response::make()->withCookie($languageCookie);


    }
}
