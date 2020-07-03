<?php

namespace App\Http\Controllers\Wechat;

use App\Models\Article;
use App\Models\Banner;
use App\Models\Business;
use App\Models\Category;
use App\Models\Config;
use App\Models\Contact;
use App\Models\Mission;
use App\Models\Principle;
use App\Models\Team;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{

    public function __construct()
    {

    }

    public function auth(Request $request)
    {
        //声明CODE，获取小程序传过来的CODE
        $code = $request->code;
        //配置appid
        $appid = env('WECHAT_MINI_PROGRAM_APPID', '');
        //配置appscret
        $secret = env('WECHAT_MINI_PROGRAM_SECRET', '');
        //api接口
        $api = "https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret={$secret}&js_code={$code}&grant_type=authorization_code";

        $str = json_decode($this->httpGet($api), true);

        $openid = $str['openid'];

        $user = User::where('openid', $openid)->first();

        if ($user) {
            $user->update([
                'openid' => $openid,
                'headimgurl' => $request->headimgurl,
                'nickname' => $request->nickname,
                'sex' => $request->sex,
            ]);

        } else {
            User::create([
                'openid' => $openid,
                'headimgurl' => $request->headimgurl,
                'nickname' => $request->nickname,
                'sex' => $request->sex,
            ]);

        }
        return $this->array($str, '授权成功');
    }

    //获取GET请求
    function httpGet($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        return $res;
    }


    public function home(Request $request)
    {
        $language = $request->language;
        $banners = Banner::where('language', $language)->orderby('sort_order')->limit(3)->get();
        $mission = Mission::where('language', $language)->orderby('sort_order')->first();
        $principle = Principle::where('language', $language)->orderby('sort_order')->first();
        $business = Business::where('language', $language)->orderby('sort_order')->limit(2)->get();
        $articles = Article::where('language', $language)->where('is_login', 1)->orderby('sort_order')->limit(2)->get();

        return $this->array(['banners' => $banners, 'mission' => $mission, 'principle' => $principle, 'business' => $business, 'articles' => $articles]);
    }

    public function configs()
    {
        $configs = Config::first();
        return $this->array(['configs' => $configs]);
    }


    public function team(Request $request)
    {
        $teams = Team::where('language', $request->language)->orderby('sort_order')->paginate($request->total);
        $page = isset($page) ? $request['page'] : 1;

        $teams = $teams->appends(array(
            'page' => $page,
            'language' => $request->language,
        ));

        return $this->array(['teams' => $teams]);
    }


    public function content(Request $request)
    {
        //多条件查找
        $where = function ($query) use ($request) {
            if ($request->has('category_id')) {

                $categories = Category::orderby('sort_order')->get();
                $category_id = $request->category_id ? $request->category_id : $categories->first()->id;
                $query->where('category_id', $category_id);
            }
            if ($request->has('keyword')) {
                $query->where('title', 'like', '%' . $request->keyword . '%');
            }

        };

        $articles = Article::where('language', $request->language)->where($where)->orderby('sort_order')->paginate($request->total);

        $categories = Category::orderby('sort_order')->get();

        foreach ($categories as $key=>$category){
            if ($request->language==1){
                $categories[$key]['name']=$category['name_cn'];
            }else{
                $categories[$key]['name']=$category['name_en'];
            }
        }
        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
            'category_id' => $request->category_id,
            'title' => $request->keyword,
        ));

        return $this->array(['articles' => $articles, 'categories' => $categories]);
    }

    public function content_detail(Request $request, $id)
    {
        if ($request->language==1){
            $login_error='登录后查看!';
            $pre_error='You donot have enough permissions!';
        }else{
            $login_error='After logging in to see!';
            $pre_error='The email cannot be empty!';
        }

        $article = Article::find($id);
        $id = $request->id;
        if ($article->is_login) {

            if (!$id) {
                return ['code' => 500, 'message' => $login_error];
            } else {
                $user = User::find($id);
                if ($article->grade > $user->grade) {
                    return ['code' => 500, 'message' => $pre_error];
                }
            }
        }
        return $this->array(['article' => $article]);
    }

    public function user(Request $request)
    {

        if ($request->language==1){
            $login_error='登录后查看!';
        }else{
            $login_error='After logging in to see!';
        }

        $id = $request->id;
        $user = User::find($id);
        if (!$user) {
            return ['code' => 500, 'message' => $login_error];
        }

        return $this->array(['user' => $user]);
    }

    public function contact(Request $request)
    {
        if ($request->language==1){
            $name_error='姓名不能为空!';
            $email_error='邮箱不能为空!';
            $city_error='地址不能为空!';
            $subject_error='问题不能为空!';
            $message_error='信息不能为空!';
        }else{
            $name_error='The name cannot be empty!';
            $email_error='The email cannot be empty!';
            $city_error='The city cannot be empty!';
            $subject_error='The subject cannot be empty!';
            $message_error='The message cannot be empty!';
        }
        try {
            $messages = [
                'name.required' => $name_error,
                'email.required' => $email_error,
                'city.required' => $city_error,
                'subject.required' => $subject_error,
                'message.required' => $message_error,
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

                return ['code' => 500, 'message' => $error];
            }
            Contact::create([
                'name' =>$request->name,
                'email' =>$request->email,
                'city' =>$request->city,
                'message' =>$request->message,
            ]);

        } catch (\Exception $exception) {

            Log::error($exception->getMessage());

            return ['code' => 500, 'message' => $exception->getMessage()];
        }

        return ['code' => 200, 'message' => '提交成功'];
    }

    public function email_code(Request $request)
    {
        if ($request->language==1){
            $no_error='未找到该邮箱用户!';
            $have_error='该邮箱已经注册过!';
        }else{
            $no_error='Not found the mail users!';
            $have_error='This email has been registered!';
        }

        $email = $request->email;
        $type = $request->type;

        $user_info = User::where(array('email' => $email))->exists();
        if ($type == 'password') {
            if (!$user_info) {
                return ['code' => 500, 'message' => $no_error];
            }
        } else {
            if ($user_info) {
                return ['code' => 500, 'message' => $have_error];
            }
        }

        $num = rand(1000, 9999);

        $minutes = 10;

        Cache::forget($email);
        Cache::store('database')->put($email, $num, $minutes);

        Mail::send('auth.send_mail', ['user' => $email, 'info' => $num], function ($message) use ($email) {
            $message->subject('邮箱验证');
            $message->to($email);
        });

        return ['code' => 200, 'message' => '发送成功'];
    }

    public function login(Request $request)
    {
        if ($request->language==1){
            $login_success='登录成功!';
            $login_error='账号密码错误!';
        }else{
            $login_success='Success!';
            $login_error='Password is wrong!';
        }

        $email = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {

            $user = Auth::user();

            return ['code' => 200, 'message' => $login_success,'data'=>$user];

        } else {
            return ['code' => 500, 'message' =>$login_error];
        }
    }

    public function register(Request $request)
    {
        if ($request->language==1){
            $code_error='验证码错误!';
            $password_error='密码不能为空!';
            $email_error='该邮箱已经注册!';
            $login_error='注册成功!';
        }else{
            $code_error='Verification code error!';
            $password_error='Password is wrong!';
            $email_error='This email has been registered!';
            $login_error='Success!';
        }


        $email = $request->email;
        $code = $request->code;
        $password = $request->password;

        $code_ = Cache::get($email);

        if ($code_ != $code) {
            return ['code' => 500, 'message' => $code_error];
        }

        if (!$password) {
            return ['code' => 500, 'message' => $password_error];
        }


        $user_info = User::where(array('email' => $email))->exists();
        if ($user_info) {
            return ['code' => 500, 'message' => $email_error];
        }

        User::create([
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        return ['code' => 200, 'message' => $login_error];
    }

    public function reset_password(Request $request)
    {
        if ($request->language==1){
            $code_error='验证码错误!';
            $password_error='密码不能为空!';
            $email_error='未找到该邮箱用户!';
            $login_error='修改成功!';
        }else{
            $code_error='Verification code error!';
            $password_error='Password is wrong!';
            $email_error='Not found the mail users!';
            $login_error='Success!';
        }

        $email = $request->email;
        $code = $request->code;
        $password = $request->password;

        $code_ = Cache::get($email);

        if ($code_ != $code) {
            return ['code' => 500, 'message' => $code_error];
        }

        if (!$password) {
            return ['code' => 500, 'message' =>$password_error];
        }


        $user_info = User::where(array('email' => $email))->exists();
        if (!$user_info) {
            return ['code' => 500, 'message' => $email_error];
        }

        User::where(array('email' => $email))->update([
            'password' => Hash::make($password)
        ]);
        return ['code' => 200, 'message' => $login_error];
    }
}
