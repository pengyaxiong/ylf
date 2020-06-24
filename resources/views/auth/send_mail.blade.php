<html>
<style>
    *{
        font-family: 微软雅黑;
    }
</style>
<body >
<div style="border:3px solid cornflowerblue;width: 96%;margin: auto auto;">
    <div style="padding: 1% 1% 1% 1%;width: 98%;">
        <h2>亲爱的{{ $user }}:</h2>
        <div>
            <p style="margin-left: 20px;">您好！很高兴您能使用我们提供的邮箱验证服务。</p>
            <p style="margin-left: 20px">感谢您使用此服务,您的  <span style="font-size: 18px;color: red">验证码为：{{$info}}</span></p>
            <p style="margin-left: 20px">如果服务器尚未响应，一定要换个新版本浏览器再试试哦！</p>
        </div>
    </div>
</div>
</body>
</html>