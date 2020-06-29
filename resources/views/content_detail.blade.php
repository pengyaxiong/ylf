@extends('layouts.app')

@section('content')

    <div class="index-sec1400 page-content d-content">
        <div class="about-con">
            <div class="page-map">
                <img src="/home/images/icon-home.png" alt=""/>
                <a href="/">{{$lan==1?'首页':'Home'}}</a>
                /
                <a href="/content">{{$lan==1?'内容':'Content'}}</a>
                /
                {{$lan==1?$category->name_cn:$category->name_en}}
            </div>
            <h1 class="content-detail-tit">{{$article->title}}</h1>
            <p class="content-detail-sub">{{$lan==1?date('Y-m-d',strtotime($article->time)):date('M-d，Y',strtotime($article->time))}} | {{$article->author}}</p>
            <img class="content-detail-img" src="{{\Storage::disk(config('admin.upload.disk'))->url($article->image)}}" alt=""/>
            <div class="content-detail-text">{!! $article->contact !!}</div>
        </div>
    </div>
    @include("layouts._footer")

@endsection

@section('js')

@endsection