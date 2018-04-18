<!DOCTYPE html>
<!-- saved from url=(0032)http://www.iydu.net/wp-login.php -->
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN"><!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <script src="/home/js/jquery.min.js"></script>
    <script src="/home/js/jquery.cookie.js"></script>
    <title>登录 ‹ 云悦读 — WordPress</title>
    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(http://www.iydu.net/wp-content/themes/tinection/images/wordpress-logo.png);
            -webkit-background-size: 85px 85px;
            background-size: 85px 85px;
            width: 85px;
            height: 85px
        }</style>
    <link rel="dns-prefetch" href="http://s.w.org/">
    <link rel="stylesheet" href="{{ asset('home/css/login.css') }}" type="text/css" media="all">
    <meta name="robots" content="noindex,follow">
    <meta name="viewport" content="width=device-width">
</head>
<body class="login login-action-login wp-core-ui  locale-zh-cn" onload="getCookie();">
<div id="login">
    <h1><a href="http://www.iydu.net/" title="云悦读" tabindex="-1">云悦读</a></h1>

    <form name="loginform" id="loginform" action="{{ url('dologin') }}" method="post">
        {{ csrf_field() }}
        @if(session('msg'))
           <p style="color:red;">{{ session('msg') }}</p>
        @endif

        @if(session('active'))
            <p style="color:red;">{{ session('active') }}</p>
        @endif
        <p>
            <label for="user_login">用户名或电子邮件地址<br>
                <input type="text" name="user_name" id="user_name" class="input" value="" size="20"></label>
        </p>
        <p>
            <label for="user_pass">密码<br>
                <input type="password" name="user_pass" id="user_pass" class="input" value="" size="20"></label>
        </p>
        <p class="forgetmenot"><label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme"
                                                              value="forever"> 记住我的登录信息</label></p>
        <p class="submit">
            <input type="submit"  id="wp-submit" class="button button-primary button-large" value="登录">
        </p>
    </form>

    <p id="nav">
        <a href="{{ asset('forget') }}">忘记密码？</a>
    </p>

    <script type="text/javascript">
        function wp_attempt_focus() {
            setTimeout(function () {
                try {
                    d = document.getElementById('user_login');
                    d.focus();
                    d.select()
                } catch (e) {
                }
            }, 200)
        }

        wp_attempt_focus();
        if (typeof wpOnload == 'function') wpOnload();</script>

    <p id="backtoblog"><a href="/index">← 返回前台首页</a></p>
    <p id="backtoblog"><a href="/phoneregister">← 手机注册页</a></p>
    <p id="backtoblog"><a href="/emailregister">← 邮箱注册页</a></p>

</div>


<div class="clear"></div>
<script>
    function setCookie(){ //设置cookie
        var loginCode = $("#user_name").val(); //获取用户名信息
        var pwd = $("#user_pass").val(); //获取登陆密码信息
        var checked = $("[name='rememberme']:checked");//获取“是否记住密码”复选框

        if(checked){ //判断是否选中了“记住密码”复选框
            $.cookie("login_code",loginCode);//调用jquery.cookie.js中的方法设置cookie中的用户名
            $.cookie("pwd",$.base64.encode(pwd));//调用jquery.cookie.js中的方法设置cookie中的登陆密码，并使用base64（jquery.base64.js）进行加密
        }else{
            $.cookie("pwd", null);
        }
    }


    function getCookie(){ //获取cookie
        var loginCode = $.cookie("username"); //获取cookie中的用户名
        var pwd =  $.cookie("password"); //获取cookie中的登陆密码
        if(pwd){//密码存在的话把“记住用户名和密码”复选框勾选住
            $("[name='rememberme']").attr("checked","true");
        }
        if(loginCode){//用户名存在的话把用户名填充到用户名文本框
            $("#user_name").val(loginCode);
        }
        if(pwd){//密码存在的话把密码填充到密码文本框
            $("#user_pass").val(pwd);
        }
    }
</script>
</body>
</html>
