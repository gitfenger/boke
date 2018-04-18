<div id="sign" class="sign">
    <div class="part loginPart">
        <form id="login" action="{{ url('dologin') }}"   method="post" novalidate="novalidate">
            <h3>登录<p class="status"></p></h3>
            <p> <label class="icon" for="username"><i class="fa fa-user"></i></label> <input class="input-control" id="username" type="text" placeholder="请输入用户名" name="username" required="" aria-required="true" /> </p>
            <p> <label class="icon" for="password"><i class="fa fa-lock"></i></label> <input class="input-control" id="password" type="password" placeholder="请输入密码" name="password" required="" aria-required="true" /> </p>
            <p class="safe"> <label class="remembermetext" for="rememberme"><input name="rememberme" type="checkbox" checked="checked" id="rememberme" class="rememberme" value="forever" />记住我的登录</label> <a class="lost" href="http://www.iydu.net/wp-login.php?action=lostpassword">忘记密码 ?</a> </p>
            <p> <input class="submit" type="submit" value="登录" name="submit"  /> </p>
            <a class="close"><i class="fa fa-times"></i></a>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>

    </div>
    <div class="part registerPart">
        <form id="register" action="http://www.iydu.net/wp-login.php?action=register" method="post" novalidate="novalidate">
            <div id="login-active" class="switch">
                <i class="fa fa-toggle-off"></i>切换登录
            </div>
            <h3>注册<p class="status"></p></h3>
            <p> <label class="icon" for="user_name"><i class="fa fa-user"></i></label> <input class="input-control" id="user_name" type="text" name="user_name" placeholder="输入英文用户名" required="" aria-required="true" /> </p>
            <p> <label class="icon" for="user_email"><i class="fa fa-envelope"></i></label> <input class="input-control" id="user_email" type="email" name="user_email" placeholder="输入常用邮箱" required="" aria-required="true" /> </p>
            <p> <label class="icon" for="user_pass"><i class="fa fa-lock"></i></label> <input class="input-control" id="user_pass" type="password" name="user_pass" placeholder="密码最小长度为6" required="" aria-required="true" /> </p>
            <p> <label class="icon" for="user_pass2"><i class="fa fa-retweet"></i></label> <input class="input-control" type="password" id="user_pass2" name="user_pass2" placeholder="再次输入密码" required="" aria-required="true" /> </p>
            <p> <input class="submit" type="submit" value="注册" name="submit" /> </p>
            <a class="close"><i class="fa fa-times"></i></a>
            <input type="hidden" id="user_security" name="user_security" value="a2adda87ef" />
            <input type="hidden" name="_wp_http_referer" value="/" />
        </form>
    </div>
</div>
<div class="floatbtn">
    <!-- Comment -->
    <!-- /.Comment -->
    <!-- Share -->
    <span id="bdshare" class="bdshare_t mobile-hide"><a class="bds_more" href="#" data-cmd="more"><i class="fa fa-share-alt"></i></a></span>
    <!-- /.Share -->
    <!-- QR -->
    <span id="qr" class="mobile-hide"><i class="fa fa-qrcode"></i>
    <div id="floatbtn-qr">
     <div id="floatbtn-qr-msg">
      扫一扫二维码分享
     </div>
    </div> </span>
    <!-- /.QR -->
    <!-- Simplified or Traditional -->
    <span id="zh-cn-tw" class="mobile-hide"><i><a id="StranLink">繁</a></i></span>
    <!-- /.Simplified or Traditional -->
    <!-- Layout Switch -->
    <span id="layoutswt" class="mobile-hide"> <i class="fa fa-th-large is_cms" src="http://www.iydu.net"></i> </span>
    <!-- /.Layout Switch -->
    <!-- Back to Home -->
    <!-- /.Back to Home -->
    <!-- Scroll Top -->
    <span id="back-to-top"><i class="fa fa-arrow-up"></i></span>
    <!-- /.Scroll Top -->
</div>
<!-- /.Footer Nav Wrap -->
<script type="text/javascript" src="{{ asset('home/js/zh-cn-tw.js') }}"></script>
<script type="text/javascript" src="{{ asset('home/js/comments-ajax.js') }}"></script>
<script type="text/javascript" src="{{ asset('home/js/ajax-sign-script.min.js') }}"></script>
{{--<script type="text/javascript" src="{{ asset('js/prettify.js') }}"></script>--}}
{{--<script type="text/javascript">--}}
{{--<![CDATA[--}}
     {{--var ajax_sign_object = {"redirecturl":"http:\/\/www.blog.com\/index","ajaxurl":"http:\/\/www.blog.com\/dologin","loadingmessage":"\u6b63\u5728\u8bf7\u6c42\u4e2d\uff0c\u8bf7\u7a0d\u7b49..."};--}}
 {{--]]>--}}
{{--</script>--}}
<script src="{{ asset('home/js/jquery.prettyPhoto.js') }}"></script>
<script type="text/javascript">var defaultEncoding = 0; var translateDelay = 100; var cookieDomain = "http://www.iydu.net";</script>
<!-- 百度分享 -->
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;mini=2"></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
    //在这里定义bds_config
    var bds_config = {'snsKey':{'tsina':"2884429244",'tqq':"101166664"}};
    document.getElementById('bdshell_js').src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<!-- 引入用户自定义代码 -->
<!-- 引入主题js -->

<script type="text/javascript" src="{{ asset('home/js/theme.js?ver=4.3.6') }}"></script>
<!-- /.Footer -->
<script type="text/javascript">
    $('.site_loading').animate({'width':'100%'},50);  //第五个节点
</script>