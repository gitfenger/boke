<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      @include('admin.public.styles')
      @include('admin.public.script')
      <style>
          .layui-form-label{
              width: 180px!important;
          }
      </style>
  </head>
  
  <body>
    <div>
        {{--判断是否添加错误的提示信息--}}
        @if(!empty(session('msg')))
        <p>{{ session('msg') }}</p>
        @endif
    </div>
    <div class="x-body">
        <form class="layui-form" action="{{ url('admin/permission') }}" method="post">

            {{ csrf_field() }}
            <div class="layui-form-item">
                <label for="L_cate_name" class="layui-form-label">
                    <span class="x-red">*</span>权限名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_cate_name" name="per_name" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_cate_name" class="layui-form-label">
                    <span class="x-red">*</span>此权限对应的控制路由
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_cate_name" name="per_url" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  增加
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
          //自定义验证规则
          form.verify({

          });

          //监听提交
          form.on('submit(add)', function(data){

          });
          
          
        });
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>