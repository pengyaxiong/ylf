@extends('layouts.app')

@section('content')

    <div class="index-sec1400 page-content d-content">
        <div class="about-con">
            <div class="page-map">
                <img src="/home/images/icon-home.png" alt=""/>
                <a href="/">{{$lan==1?'首页':'Home'}}</a>
                /
                {{$lan==1?'联系我们':'Contact Us'}}
            </div>
            <h1 class="page-tit">{{$lan==1?'联系我们':'Contact US'}}</h1>
            <div class="contact-con">
                <div class="contact-form">
                    <div class="contact-form-item">
                        <span>{{$lan==1?'联系姓名':'Your Name'}}</span>
                        <input type="text" id="name" placeholder=""/>
                    </div>
                    <div class="contact-form-item">
                        <span>{{$lan==1?'联系地址':'Your City'}}</span>
                        <input type="text" id="city" placeholder=""/>
                    </div>
                    <div class="contact-form-item">
                        <span>{{$lan==1?'联系邮箱':'Your E-mail'}}</span>
                        <input type="email" id="email" placeholder=""/>
                    </div>
                    <div class="contact-form-item">
                        <span>{{$lan==1?'问题':'Subject'}}</span>
                        <input type="text" id="subject" placeholder=""/>
                    </div>
                    <div class="contact-form-item">
                        <span>{{$lan==1?'信息':'Message'}}</span>
                        <textarea id="message" placeholder=""></textarea>
                    </div>
                    <div class="contact-form-btn">{{$lan==1?'提交':'Submit'}}</div>
                </div>
                <div class="contact-tips">
                    <h3>{{$lan==1?'我们迫不及待想听到你的声音!':"We can't wait to hear from you!"}}</h3>
                    <h5>{{$lan==1?'请与我们联系。':'Please use the form to contact us.'}}</h5>
                    <div>
                        <p>{{$lan==1?'所有的字段都需要填写。':'All fields are mandatory.'}}</p>
                        <p>{{$lan==1?'你的信息不会被交付给我们如果你不提供一个有效的电子邮件地址。':'Your message will not be delivered to us if you don’t provide a valid E-Mail address.'}}</p>
                    </div>
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
        $(".contact-form-btn").click(function () {

            $.post("/api/contact", {
                "name": $("#name").val(),
                "email": $("#email").val(),
                "city": $("#city").val(),
                "subject": $("#subject").val(),
                "message": $("#message").val()
            }, function (data) {
                if (data.status) {
                    swal("success!", data.msg, "success");
                    console.log(data);
                } else {
                    swal("error!", data.msg, "error");
                }
            }, 'json');
        });
    </script>
@endsection