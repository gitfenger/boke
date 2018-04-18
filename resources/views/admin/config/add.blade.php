<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    @include('admin.public.styles')
    @include('admin.public.script')
</head>

<body>
    <div class="x-body">
        <form class="layui-form" action="{{ url('admin/config') }}" method="post">
{{--            {{ csrf_field() }}--}}


            <div class="layui-form-item">
                <label for="L_conf_title" class="layui-form-label">
                    <span class="x-red">*</span>标题
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_conf_title" name="conf_title" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_conf_name" class="layui-form-label">
                    <span class="x-red">*</span>名称
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_conf_name" name="conf_name" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_conf_content" class="layui-form-label">
                    <span class="x-red">*</span>内容
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_conf_content" name="conf_content" required=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">类型</label>
                <div class="layui-input-block">
                    <input type="radio" name="field_type"  value="input" title="输入框" checked onclick="showTr()">
                    <input type="radio" name="field_type" value="textarea" title="文本域" onclick="showTr()">
                    <input type="radio" name="field_type" value="radio" title="单选按钮" onclick="showTr()">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_conf_order" class="layui-form-label">
                    <span class="x-red">*</span>排序
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_conf_order" name="conf_order" required=""
                           autocomplete="off" class="layui-input">
                    {{ csrf_field() }}
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">说明</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" class="layui-textarea" name="conf_tips"></textarea>
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
</body>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;

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
</html>