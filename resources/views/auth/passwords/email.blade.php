@extends('layouts.app')
<style>
    body {
        height: 100% !important;
    }

    .login-warn {
        display: block !important;
    }
</style>
@section('content')

    <div class="index-sec1400 page-content d-content">
        @if (session('status'))
            <div id="warn" class="login-warn"> {{ session('status') }}</div>
        @endif
            @if ($errors->has('email'))
                <div id="warn" class="login-warn"> {{ $errors->first('email') }}</div>
            @endif
        <div class="about-con">
            <div class="page-map">
                <img src="/home/images/icon-home.png" alt=""/>
                <a href="/">{{$lan==1?'首页':'Home'}}</a>
                /
                {{$lan==1?'重置密码?':'Retrieve password'}}
            </div>
            <div class="login-form">
                <h1>{{$lan==1?'重置密码?':'Retrieve password'}}</h1>
                <p class="login-tips">{{$lan==1?'想起密码?':'Remember your password?'}}<a href="{{ route('login') }}">{{$lan==1?'登录':'Sign in'}}</a></p>
                <div class="login-form-con">
                    <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <div class="login-input">
                            <div><h5>{{$lan==1?'邮箱':'Email'}}</h5></div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder=""/>
                        </div>
                        <div class="login-btn">
                            <button type="submit" id="register">{{$lan==1?'下一步':'Next step'}}</button>
                            <div id="loading" class="login-btn-loading"><img src="/home/images/loading.gif" alt=""/></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include("layouts._footer")

@endsection
