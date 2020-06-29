@extends('layouts.app')

@section('content')

    <div class="index-sec1400 page-content d-content">
        <div class="about-con">
            <div class="page-map">
                <img src="/home/images/icon-home.png" alt=""/>
                <a href="/">{{$lan==1?'首页':'Home'}}</a>
                /
                {{$lan==1?'内容':'Content'}}
            </div>
            <div class="content-nav">
                @foreach($categories as $category)
                    <span class="@if($category_id==$category->id) on @endif" onclick="location.href='/content?category_id={{$category->id}}'">{{$lan==1?$category->name_cn:$category->name_en}}</span>
                @endforeach
            </div>
            <div class="content-pub-head">
                <h1 id="title" class="page-tit d-left"> {{$lan==1?'出版物':'PUBLICATIONS'}}</h1>

                <form method="get" action="/content">
                    <div class="content-pub-search">
                        <img id="searchImg" src="/home/images/icon-search.png" alt=""/>
                        <input id="searchInput" value="{{Request::input('keyword')}}" name="keyword" type="search"
                               placeholder="Search"/>
                    </div>
                </form>
            </div>
            <div class="content-pub-body">
                <div class="content-pub-list">
                    @foreach($articles as $article)
                        <div class="content-pub-item">
                            <a href="{{route('content_detail',$article->id)}}">
                                <img src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}"
                                     alt=""/>
                                <h3 class="d-ellipsis-multiple">{{$article->title}}</h3>
                                <p>{{$lan==1?date('Y-m-d',strtotime($article->time)):date('M-d，Y',strtotime($article->time))}}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="page-pagination"></div>
            </div>

            <!-- 分页 -->
            {!! $articles->appends(Request::all())->links('layouts._page') !!}

        </div>
    </div>
    @include("layouts._footer")

@endsection

@section('js')

@endsection