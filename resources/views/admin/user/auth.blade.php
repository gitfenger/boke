<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>用户授权页面</title>
    <meta name="renderer" content="webkit">
      <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
      @include('admin.public.styles')
      @include('admin.public.script')
  </head>
  
  <body>
    <div class="x-body">


        <form enctype="multipart/form-data" id="art_form" class="layui-form" action="{{ url('admin/user/doauth') }}" method="post">
          {{ csrf_field() }}

            <div class="layui-form-item">

                <label for="L_username" class="layui-form-label">
                    <span class="x-red">*</span>用户名称
                </label>
                <div class="layui-input-inline">
                    <input type="hidden" value="{{ $user->user_id }}" name="user_id">
                    <input type="text" value="{{ $user->user_name }}" disabled="" name="user_name" required="" lay-verify=""
                           autocomplete="off" class="layui-input">
                </div>
            </div>


            <div class="layui-form-item" pane="">
                <label class="layui-form-label">所有的角色</label>
                <div class="layui-input-block">
                    @foreach($roles as $v)
                    {{--//  如果当前用户拥有正在遍历的角色--}}
                    @if(in_array($v->id,$own_roleids))
                    <input type="checkbox" checked value="{{ $v->id }}" name="role_id[]" lay-skin="primary" title="{{ $v->role_name }}" >
                    @else
                    <input type="checkbox"  value="{{ $v->id }}" name="role_id[]" lay-skin="primary" title="{{ $v->role_name }}" >
                    @endif

                    @endforeach
                </div>
            </div>


          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  授权
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        


          //监听提交
          form.on('submit(add)', function(data){
            // return false;
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