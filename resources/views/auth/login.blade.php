@extends('layouts.app')
<style>
    .login-warn {
        display: block !important;
    }
</style>
@section('content')
    <div class="index-sec1400 page-content d-content">

        @if ($errors->has('email'))
            <div id="warn" class="login-warn">{{ $errors->first('email') }}</div>
        @endif
        @if ($errors->has('password'))
                <div id="warn" class="login-warn">{{ $errors->first('password') }}</div>
        @endif
        <div class="about-con">
            <div class="page-map">
                <img src="/home/images/icon-home.png" alt=""/>
                <a href="/">{{$lan==1?'首页':'Home'}}</a>
                /
                {{$lan==1?'登录':'Sign in'}}
            </div>
            <div class="login-form">
                <h1>{{$lan==1?'登录 VS Partners':'Sign in to VS Partners'}}</h1>
                <p class="login-tips">{{$lan==1?'没有一个帐户吗?':"Don't have an account?"}}<a href="{{ route('register') }}"> {{$lan==1?'现在注册':'Sign up now'}}</a></p>
                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="login-form-con">
                        <div id="wxLogin" class="login-wx"><img src="/home/images/icon-wechat.png" alt=""/>
                            {{$lan==1?'通过微信账号登录':'Sign in with Wechat'}}
                        </div>
                        <p class="login-divider">or</p>
                        <div class="login-input">
                            <div><h5> {{$lan==1?'邮箱':'Email'}}</h5></div>
                            <input id="name" type="text"  name="email" value="{{ old('email') }}" placeholder=""/>
                        </div>
                        <div class="login-input">
                            <div><h5> {{$lan==1?'密码':'Password'}}</h5><a href="{{ route('password.request') }}">{{$lan==1?'忘记密码?':'Forgot password?'}}</a></div>
                            <input id="pwd" name="password" type="password" placeholder=""/>
                        </div>
                    </div>
                    <div class="login-btn">
                        <button id="login" type="submit">{{$lan==1?'登录':'Sign in'}}</button>
                        <div id="loading" class="login-btn-loading"><img src="/home/images/loading.gif" alt=""/></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include("layouts._footer")
@endsection
@section('js')
    <script>
        $(function () {
            $('#wxLogin').on('click', function () {
//      var appId='wxb9e37a2d93c3ce33';
                var appId = 'wxbdc5610cc59c1631';
                var url = 'index.html';  // 需要在 index.html 中
                var state = 112233
                requestCode(appId, url, state)
            })
        })
    </script>
@endsection