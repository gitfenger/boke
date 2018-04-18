<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>分类列表页</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    @include('admin.public.styles')
    @include('admin.public.script')
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>导航元素</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">
      <div class="layui-row">

      </div>
      <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <button class="layui-btn" onclick="x_admin_show('添加用户','{{ url('admin/user/create') }}',600,400)"><i class="layui-icon"></i>添加</button>
        <span class="x-right" style="line-height:40px">共有数据：88 条</span>
      </xblock>
      <table class="layui-table">
        <thead>
          <tr>
            <th>
              <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>分类名称</th>
            <th>分类标题</th>

            <th>操作</th></tr>
        </thead>
        <tbody>
        @foreach($cates as $v)
          <tr>
            <td>
              <div class="layui-input-inline" style="width:35px;">
                <input onchange="changeOrder(this,{{ $v->cate_id }})" type="text" name="cate_order" value="{{ $v->cate_order }}" class="layui-input">
              </div>

            </td>
            <td>{{ $v->cate_id }}</td>
            <td>{{ $v->cate_name }}</td>
            <td>{{ $v->cate_title }}</td>
          
            <td class="td-manage">

              <a title="编辑"  onclick="x_admin_show('编辑','{{ url('admin/cate/'.$v->cate_id.'/edit') }}',600,400)" href="javascript:;">
                <i class="layui-icon">&#xe642;</i>
              </a>

              <a title="删除" onclick="member_del(this,{{ $v->cate_id }})" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>
    <script>
      layui.use('laydate', function(){
        var laydate = layui.laydate;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });
      });


      function changeOrder(obj,id){

          // 获取当前文本框的值（修改后的排序值）
          var order_id = $(obj).val();

          $.post('/admin/cate/changeorder',{'_token':"{{csrf_token()}}","cate_id":id,"cate_order":order_id},function(data){
            // console.log(data);
              if(data.status == 0){
                  layer.msg(data.msg,{icon:6},function(){
                      location.reload();
                  });
              }else{
                  layer.msg(data.msg,{icon:5});
              }
          });
      }

      /*分类-删除*/
      function member_del(obj,id){
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $.post('{{ url('admin/cate/') }}/'+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
//                    data就是服务器返回的json数据
//                    console.log(data);
//                    JSON.parse()
//                    JSON.stringify()
                  if(data.status == 0){
                      $(obj).parents("tr").remove();
                      layer.msg('已删除!',{icon:1,time:1000});
                  }else{
                      // $(obj).parents("tr").remove();
                      layer.msg('删除失败!',{icon:1,time:1000});
                  }
              })
          });
      }



      function delAll (argument) {
          // 获取到要批量删除的用户的id
          var ids = [];

          $(".layui-form-checked").not('.header').each(function(i,v){
              var u = $(v).attr('data-id');
              ids.push(u);
          })


        layer.confirm('确认要删除吗？',function(index){

            $.get('/admin/user/del',{'ids':ids},function(data){
                if(data.status == 0){
                    $(".layui-form-checked").not('.header').parents('tr').remove();
                    layer.msg(data.message,{icon:6,time:1000});
                }else{
                    layer.msg(data.message,{icon:5,time:1000});
                }
            });


        });
      }
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>