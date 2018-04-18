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
                    <span class="x-red">*</span>分类
                </label>
                <div class="layui-input-inline">
                    <select name="cate_id">
                        {{--<option value="0">==顶级分类==</option>--}}
                        @foreach($cates as $k=>$v)
                            @if($v->cate_id == $arts->cate_id)
                            <option selected value="{{ $v->cate_id }}">{{ $v->cate_name }}</option>
                            @else
                            <option  value="{{ $v->cate_id }}">{{ $v->cate_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_art_title" class="layui-form-label">
                    <span class="x-red">*</span>文章标题
                </label>
                <div class="layui-input-block">
                    {{csrf_field()}}
                    <input type="text" id="L_art_title" name="art_title" required=""
                           autocomplete="off" class="layui-input" value="{{ $arts->art_title }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_art_editor" class="layui-form-label">
                    <span class="x-red">*</span>编辑
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_art_editor" name="art_editor" required=""
                           autocomplete="off" class="layui-input" value="{{ $arts->art_editor }}">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">缩略图</label>
                <div class="layui-input-block layui-upload">
                    <input type="hidden" id="img1" class="hidden" name="art_thumb" value="">
                    <button type="button" class="layui-btn" id="test1">
                        <i class="layui-icon">&#xe67c;</i>修改图片
                    </button>
                </div>
            </div>


            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label"></label>
                <div class="layui-input-block">
                    <img src="{{ $arts->art_thumb }}" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_art_tag" class="layui-form-label">
                    <span class="x-red">*</span>关键词
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="L_art_tag" name="art_tag" required=""
                           autocomplete="off" class="layui-input" value="{{ $arts->art_tag }}">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_art_tag" class="layui-form-label">
                    <span class="x-red">*</span>描述
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" class="layui-textarea" name="art_description">{{ $arts->art_description }}</textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_art_tag" class="layui-form-label">
                    <span class="x-red">*</span>内容
                </label>
                <div class="layui-input-block">
                    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.config.js"></script>
                    <script type="text/javascript" charset="utf-8" src="/ueditor/ueditor.all.min.js"> </script>
                    <script type="text/javascript" charset="utf-8" src="/ueditor/lang/zh-cn/zh-cn.js"></script>


                    <script id="editor" type="text/plain" name="art_content" style="width:600px;height:300px;">{!! $arts->art_content !!}</script>
                    <script type="text/javascript">

                    //实例化编辑器
                    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                    var ue = UE.getEditor('editor');
                    </script>
                    <style>
                        .edui-default{line-height: 28px;}
                        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                        {overflow: hidden; height:20px;}
                        div.edui-box{overflow: hidden; height:22px;}
                    </style>
                </div>
            </div>
          <div class="layui-form-item">
              <input type="hidden" name="artid" value="{{ $arts->art_id }}">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="edit" lay-submit="">
                  修改
              </button>
          </div>
      </form>
    </div>
    <script>
      layui.use(['form','layer','upload'], function(){
          $ = layui.jquery;
        var form = layui.form
        ,layer = layui.layer;
          var upload = layui.upload;
          var uploadInst = upload.render({
              elem: '#test1'
              ,url: '/admin/article/upload'
              ,before: function(obj){
                  layer.load();

              }
              ,done: function(res){
                  layer.closeAll('loading'); //关闭loading
                  //如果上传失败
                  if(res.code > 0){
                      return layer.msg('上传失败');
                  }
                  var _this = this.item;
                  // $(_this).parent('.layui-upload').find("input[name='art_thumb']").val(11111);
                  $("input[name='art_thumb']").val('/uploads/'+res.data.src);
                  // console.log(test);
                  console.log(res.data.src);
                  //上传成功
                  // 显示图片
                  $('#art_thumb_img').attr('src','/uploads/'+res.data.src);
              }
              ,error: function(){
                  //演示失败状态，并实现重传
                  var demoText = $('#demoText');
                  demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                  demoText.find('.demo-reload').on('click', function(){
                      uploadInst.upload();
                  });
              }
          });


        //监听提交
        form.on('submit(edit)', function(data){
            var artid = $("input[name='artid']").val();
            //console.log(uid);
            $.ajax({
                type: 'PUT',
                url: '/admin/article/'+artid,
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