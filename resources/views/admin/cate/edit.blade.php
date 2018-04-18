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
</head>

<body>
<div class="x-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>分类名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="L_email" name="cate_name" required=""
                       autocomplete="off" class="layui-input" value="{{ $cate->cate_name }}">
                <input type="hidden" value="{{ $cate->cate_id }}" name="cate_id">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>
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
            var cateid = $("input[name='cate_id']").val();
            //console.log(uid);
            $.ajax({
                type: 'PUT',
                url: '/admin/cate/'+cateid,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                // data:JSON.stringify(data.field),
                data:data.field,
                success: function(data){

                    if(data.status == 0){
                        layer.alert("修改成功", {icon: 6},function () {
                            parent.location.reload();
                        });
                    }else{
                        layer.alert("修改失败", {icon: 5},function () {
                            parent.location.reload();
                        });
                    }

                },
                error:function(data) {
                    //console.log(1111111111111111);
                    // console.log(data.msg);
                },
            });
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