@extends('layouts.app')

@section('content')

    <div class="index-sec1400 page-content d-content">
        <div class="about-con">
            <div class="page-map">
                <img src="/home/images/icon-home.png" alt=""/>
                <a href="/">{{$lan==1?'首页':'Home'}}</a>
                /
                {{$lan==1?'团队':'Team'}}
            </div>
            <h1 class="page-tit">{{$lan==1?'我们的团队':'OUR TEAM'}}</h1>
            <div>
                @foreach($teams as $team)
                    <div class="team-item">
                        <img class="team-item-img" src="{{\Storage::disk(config('admin.upload.disk'))->url($team->image)}}" alt=""/>
                        <div class="team-item-profile">
                            <h2>{{$team->name}}</h2>
                            <h5>{{$team->department}}</h5>
                            <div>
                                {{$team->description}}
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <!-- 分页 -->
            {!! $teams->appends(Request::all())->links('layouts._page') !!}

        </div>
    </div>
    @include("layouts._footer")

@endsection

@section('js')

@endsection