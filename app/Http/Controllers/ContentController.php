<?php

namespace App\Http\Controllers;

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
        view()->share([
            'lan' => $this->language
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

    /**
     * @param $id
     * @return mixed
     */
    public function content_detail($id)
    {
        $article = Article::find($id);
        if ($article->is_login) {
            if (!auth()->user()) {
                return redirect(route('login'));
            }
        }
        return $article;
        view('content_detail');
    }
}
