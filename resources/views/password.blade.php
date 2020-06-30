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
        @if (session('notice'))
            <div id="warn" class="login-warn"> {{ session('notice') }}</div>
        @endif

        <div class="about-con">
            <div class="page-map">
                <img src="/home/images/icon-home.png" alt=""/>
                <a href="/">{{$lan==1?'首页':'Home'}}</a>
                /
                {{$lan==1?'修改密码':'Reset password?'}}
            </div>
            <div class="login-form">
                <h1>{{$lan==1?'重置密码?':'Retrieve password'}}</h1>
                <div class="login-form-con">
                    <form method="POST" action="{{ route('reset_password') }}" aria-label="{{ __('Reset Password') }}">
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
                        <div class="login-btn">
                            <button type="submit" id="register">{{$lan==1?'重置密码':'Reset password'}}</button>
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
                        "email": email,
                        "type": 'password',
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