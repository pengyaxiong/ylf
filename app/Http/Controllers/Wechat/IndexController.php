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
use Illuminate\Support\Facades\Log;
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
                $category_id=$request->category_id?$request->category_id:$categories->first()->id;
                $query->where('category_id', $category_id);
            }
            if ($request->has('keyword')) {
                $query->where('title', 'like', '%' . $request->keyword . '%');
            }

        };

        $articles = Article::where('language', $request->language)->where($where)->orderby('sort_order')->paginate($request->total);

        $categories = Category::orderby('sort_order')->get();

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
            'category_id' => $request->category_id,
            'title' => $request->keyword,
        ));

        return $this->array(['articles' => $articles,'categories' => $categories]);
    }

    public function content_detail(Request $request, $id)
    {
        $article = Article::find($id);
        $openid = $request->openid;
        if ($article->is_login) {

            if (!$openid) {
                return ['code' => 500, 'message' => '登录后查看'];
            }else{
                $user=User::where('openid',$openid)->find();
                if ($article->grade>$user->grade){
                    return ['code' => 500, 'message' => '您的权限不够'];
                }
            }
        }
        return $this->array(['article' => $article]);
    }

    public function user(Request $request)
    {

        $id = $request->id;
        $user = User::find($id);
        if (!$user) {
            return ['code' => 500, 'message' => '登录后查看'];
        }

        return $this->array(['user' => $user]);
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


}
