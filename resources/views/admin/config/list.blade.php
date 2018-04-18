<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    @include('admin.public.styles')
    @include('admin.public.script')
  </head>
  
  <body>
    <div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
          <cite>{{ config('webconfig.web_title') }}</cite></a>
      </span>
      <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
    </div>
    <div class="x-body">

      <xblock>
        {{--<button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>--}}
        {{--<button class="layui-btn" onclick="x_admin_show('添加用户','{{ url('admin/user/create') }}',600,400)"><i class="layui-icon"></i>添加</button>--}}

      </xblock>
      <form action="{{ url('admin/config/changecontent') }}" method="post">
      <table class="layui-table">
        <thead>
          <tr>
            {{--<th width="10px">--}}
              {{--<div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>--}}
            {{--</th>--}}
            <th style="width:40px;">ID</th>
            <th style="width:80px;">标题</th>
            <th style="width:80px;">名称</th>
            <th style="width:580px;">内容</th>
            <th>操作</th></tr>
        </thead>
        <tbody>
        @foreach($conf as $v)
          <tr>

            <input type="hidden" value="{{ $v->conf_id }}" name="conf_id[]">
            <td>{{ $v->conf_id }}</td>
            <td>{{ $v->conf_title }}</td>
            <td>{{ $v->conf_name }}</td>
            <td>{!! $v->conf_contents !!}</td>
            <td class="td-manage">

              {{--<a title="编辑"  onclick="x_admin_show('编辑','{{ url('admin/cate/'.$v->cate_id.'/edit') }}',600,400)" href="javascript:;">--}}
                {{--<i class="layui-icon">&#xe642;</i>--}}
              {{--</a>--}}

              <a title="删除" onclick="member_del(this,{{ $v->conf_id }})" href="javascript:;">
                <i class="layui-icon">&#xe640;</i>
              </a>
            </td>
          </tr>
          @endforeach
        <tr>
          <td colspan="6">
            {{ csrf_field() }}
            <button  class="layui-btn" lay-filter="add" lay-submit="">
              批量修改
            </button>
          </td>
        </tr>
        </tbody>
      </table>
      </form>

    </div>
    <script>
      layui.use(['form','layer','laydate'], function(){
        var laydate = layui.laydate;
          var form = layui.form;
        
        //执行一个laydate实例
        laydate.render({
          elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
          elem: '#end' //指定元素
        });

          //监听提交
          form.on('submit(add)', function(data){
              console.log(data);
          });
      });




      /*网站配置项-删除*/
      function member_del(obj,id){
          var cid = $(obj).parents("tr").find("input[type='hidden']").val();
          // console.log(cid);
          layer.confirm('确认要删除吗？',function(index){
              //发异步删除数据
              $.post('{{ url('admin/config/') }}/'+id,{'_method':'delete','_token':"{{csrf_token()}}"},function (data) {
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




    </script>

  </body>

</html>