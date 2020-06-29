<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Config;
use App\Models\Article;
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
        $config = Config::first();
        view()->share([
            'lan' => $this->language,
            '_content' => 'on',
            'config' => $config,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $where = function ($query) use ($request) {
            if ($request->has('category_id')) {
                $query->where('category_id', $request->category_id);
            }
            if ($request->has('keyword')) {
                $query->where('title', 'like','%'.$request->keyword.'%');
            }
        };

        $categories = Category::orderby('sort_order')->get();

        $category_id=$request->category_id?$request->category_id:$categories->first()->id;
        $articles = Article::where('language', $this->language)->where($where)->orderby('sort_order')->paginate(3);

        $page = isset($page) ? $request['page'] : 1;
        $articles = $articles->appends(array(
            'page' => $page,
            'category_id' => $request->category_id,
            'title' => $request->keyword,
        ));
        return view('content', compact('articles', 'categories','category_id'));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function content_detail($id)
    {
        $article = Article::find($id);
        $category=Category::find($article->category_id);
        if ($article->is_login) {
            if (!auth()->user()) {
                return redirect(route('login'));
            }
        }
        return view('content_detail',compact('article','category'));
    }
}
