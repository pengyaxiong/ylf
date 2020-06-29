<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="/home/css/index.css"/>
    <link rel="stylesheet" href="/home/css/idangerous.swiper-2.7.6.css"/>
    <script src="/home/js/jquery-1.8.3.min.js"></script>
    <script src="/home/js/idangerous.swiper-2.7.6.min.js"></script>
    <script src="/home/js/api.js"></script>
    <style>
        .header {
            -webkit-transition: all 0.5s;
            -moz-transition: all 0.5s;
            -ms-transition: all 0.5s;
            -o-transition: all 0.5s;
            transition: all 0.5s;
        }

        .header.transparent {
            background-color: transparent;
        }

        .index-body {
            padding-top: 0;
        }
    </style>
</head>
<body>
<div class="header" style="min-width:1130px;">
    <div class="header-con d-content d-middle">
        <a class="header-logo d-middle-item" href="/"><img src="/home/images/icon-logo.png" alt=""/></a>
        <div class="header-right d-middle-item">
            <div class="header-nav">
                <div class="header-nav-item {{@$_index,'on' or ''}} d-middle">
                    <a href="/" class="header-nav-item-text d-middle-item">{{$lan==1?'首页':'Home'}}</a>
                </div>
                <div class="header-nav-item {{@$_team,'on' or ''}} d-middle">
                    <a href="/team" class="header-nav-item-text d-middle-item">{{$lan==1?'团队':'Team'}}</a>
                </div>
                <div class="header-nav-item {{@$_content,'on' or ''}} d-middle">
                    {{--<a href="publication.html" class="header-nav-item-text d-middle-item">Content</a>--}}
                    <a href="/content" class="header-nav-item-text d-middle-item">{{$lan==1?'内容':'Content'}}</a>
                </div>
                <div class="header-nav-item {{@$_contact,'on' or ''}} d-middle">
                    {{--<a href="contact.html" class="header-nav-item-text d-middle-item">Contact</a>--}}
                    <a href="/contact" class="header-nav-item-text d-middle-item">{{$lan==1?'联系我们':'Contact'}}</a>
                </div>
            </div>
            @guest
                <div id="notLogin" class="header-login d-middle">
                    <div class="d-middle-item">
                        <div class="{{@$_login,'header-register' or ''}} header-login-item">
                            <a href="{{ route('login') }}" class="">{{$lan==1?'登录':'Sign in'}}</a>
                        </div>
                        <div class="{{@$_register,'header-register' or ''}}  header-login-item">
                            <a href="{{ route('register') }}" class="">{{$lan==1?'注册':'Sign up'}}</a>
                        </div>
                    </div>
                </div>
            @else
                <div id="hasLogin" class="header-login d-middle">
                    <img class="header-login-icon d-middle-item" src="/home/images/icon-user-s.png" alt=""/>
                    <div class="header-login-slide">
                        <p><a href="">Password{{ Auth::user()->email }}</a></p>
                        <p><a href="">Wechat</a></p>
                        <p><a id="logout" href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">{{$lan==1?'注销':'Sign out'}}</a>
                        </p>
                    </div>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                </div>
            @endguest
            <p id="change" class="dataText" data-text="language" data-lan="{{$lan==1?'en':'cn'}}">{{$lan==1?'中文':'English'}}</p>
        </div>
    </div>
</div>

@yield('content')

</body>
<script>
    // 语言切换
    $('#change').click(function () {
        var language = $(this).data('lan');
        // 默认文字切换
        // translate()
        // 动态数据切换
        $.ajax({
            url:"/api/language",
            type:"POST",
            data:{
                "language": language
            },
            success:function(data){
                $('body').append('<div class="loading-bg"><img class="loading-gif" src="/home/images/loading-big.gif" alt=""/></div>');
                var t = setTimeout(function () {
                    clearInterval(t)
                    window.location.reload();//刷新当前页面.
                }, 200)
            }

        });
    })
</script>
@yield('js')
</html>
