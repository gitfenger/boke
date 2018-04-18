<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
      <meta name="csrf-token" content="{{ csrf_token() }}">
      @include('admin.public.styles')
      @include('admin.public.script')
  </head>
  
  <body>
    <div class="x-body">
        <form class="layui-form">
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>权限名称
                </label>
                <div class="layui-input-inline">
                    <input type="text"  value="{{ $per->per_name }}" name="per_name" required=""
                           autocomplete="off" class="layui-input">
                    <input type="hidden" name="id" value="{{ $per->id }}">
                </div>

            </div>
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>权限路由
                </label>
                <div class="layui-input-inline">
                    <input type="text" style="width:400px;"  value="{{ $per->per_url }}" name="per_url" required=""
                           autocomplete="off" class="layui-input">
                </div>

            </div>
              <div class="layui-form-item">
                  <label for="L_repass" class="layui-form-label">
                  </label>
                  <button  class="layui-btn" lay-filter="edit" lay-submit="">
                      修改
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
        form.on('submit(edit)', function(data){
            //获取 要修改的用户的ID
            var pid = $("input[name='id']").val();
            $.ajax({
                type : "PUT", //提交方式
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url : '/admin/permission/'+pid,//路径
                data : data.field,//数据，这里使用的是Json格式进行传输
                dataType : "Json",
                success : function(result) {//返回数据根据结果进行相应的处理
                    console.log(result);
                    // 如果ajax的返回数据对象的status属性值是0，表示用户添加成功；弹添加成功的提示信息
                    if(result.status == 0){
                        layer.alert(result.msg, {icon: 6},function () {
                            //刷新父页面
                            parent.location.reload();
                        });
                    }else{
                        layer.alert(result.msg, {icon: 6},function () {
                            parent.location.reload();
                        });
                    }
                }
            });

            //console.log(data);
            //发异步，把数据提交给php
            return false;
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