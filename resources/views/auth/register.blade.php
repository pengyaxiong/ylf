@extends('layouts.app')
<style>
    body{
        height:100% !important;
    }
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
        @if ($errors->has('code'))
            <div id="warn" class="login-warn">{{ $errors->first('code') }}</div>
        @endif
        <div class="about-con">
            <div class="page-map">
                <img src="/home/images/icon-home.png" alt=""/>
                <a href="/">{{$lan==1?'首页':'Home'}}</a>
                /
                {{$lan==1?'注册':'Sign up'}}
            </div>
            <div class="login-form">
                <h1>{{$lan==1?'注册 VS Partners':'Sign up to VS Partners'}}</h1>
                <p class="login-tips">{{$lan==1?'已有账号?':'Have an account already?'}}<a href="{{ route('login') }}"> {{$lan==1?'登录':'Sign in'}}</a></p>
                <div class="login-form-con">
                    <div id="wxLogin" class="login-wx"><img src="/home/images/icon-wechat.png" alt=""/> {{$lan==1?'通过微信账号登录':'Sign in with Wechat'}}</div>
                    <p class="login-divider">or</p>
                    <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @csrf
                        <div class="login-input">
                            <div><h5>{{$lan==1?'邮箱':'Email'}}</h5></div>
                            <div class="register-code">
                                <input  id="email" type="email" name="email" value="{{ old('email') }}" placeholder=""/>
                                <div class="register-code-btn">
                                    <button type="button" id="captcha">{{$lan==1?'验证码':'Captcha'}}</button>
                                    <div id="captLoading" class="login-btn-loading"><img src="/home/images/loading.gif" alt=""/></div>
                                </div>
                            </div>
                        </div>
                        <div class="login-input">
                            <div><h5>{{$lan==1?'输入验证码':'Enter the captcha'}}</h5></div>
                            <input id="code" name="code" value="{{ old('code') }}" type="text" placeholder=""/>
                        </div>
                        <div class="login-input">
                            <div><h5>{{$lan==1?'密码':'Password'}}</h5></div>
                            <input id="pwd" type="password" name="password" placeholder=""/>
                        </div>
                        <div class="login-input">
                            <div><h5>{{$lan==1?'重复密码':'Confirm Password'}}</h5></div>
                            <input id="password-confirm" type="password" name="password_confirmation" placeholder=""/>
                        </div>
                        <div class="login-btn">
                            <button id="register" type="submit">{{$lan==1?'注册':'Sign up'}}</button>
                            <div id="loading" class="login-btn-loading"><img src="/home/images/loading.gif" alt=""/></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include("layouts._footer")
@endsection

@section('js')
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $(function () {
            $('#captcha').click(function () {
                var email = $("#email").val();
                var reg = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/;
                if (reg.test(email)) {
                    $('#captLoading').show();
                    $.post("/api/email_code", {
                        "email": email
                    }, function (data) {
                        if (data.status) {
                            swal("success!", data.msg, "success");
                            console.log(data);
                            var n = 59;
                            var t = setInterval(function () {
                                if (n <= 0) {
                                    $('#captcha').text('Captcha');
                                    clearInterval(t);
                                    $('#captLoading').hide();
                                } else {
                                    $('#captcha').text(n-- + 's');
                                }
                            }, 1000);
                        } else {
                            swal("error!", data.msg, "error");
                        }
                    }, 'json');
                } else {
                    swal("error!", "邮箱格式不正确", "error");
                }
            });
        })
    </script>
@endsection
