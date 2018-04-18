<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Config;
use DB;

class ConfigController extends Controller
{
    //将网站配置数据表中的网站配置数据写入config/webconfig.php文件中
    public function putContent()
    {
//        1. 从网站配置表中获取网站配置数据
        $content = Config::pluck('conf_content','conf_name')->all();
//        dd($content);
//        2. 准备要写入的内容

        $str = '<?php return '.var_export($content,true).';';

//        3. 将内容写入webconfig.php文件

        file_put_contents(config_path().'/webconfig.php',$str);
    }
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $conf =  Config::get();
       //格式化返回的数据
        foreach ($conf as $v){
            switch($v->field_type){
                //1. 文本框 input
//                aaaa =>   <input value="aaa" type="text" name="title"  class="layui-input">
                case 'input':
                   $v->conf_contents = '<input value="'.$v->conf_content.'" type="text" name="conf_content[]"  class="layui-input">';

                    break;
                //2 文本域 textarea
//                bbbb=>  <textarea name="desc" class="layui-textarea">bbbb</textarea>
                case 'textarea':

                    $v->conf_contents = '<textarea name="conf_content[]" class="layui-textarea">'.$v->conf_content.'</textarea>';
                    break;

                //3 单选按钮 raido
                case 'radio':
//                    1|开启,0|关闭  =>
//                    [
//                         0=> '1|开启‘，
//                         1=>'0|关闭'
//                      ]
//
//                     <input type="radio" checked name="sex" value="1" title="开启">
//                    <input type="radio"  name="sex" value="0" title="关闭">
//                    $v->conf_contents = $v->conf_content;
//                    定义一个字符串，存放最终的拼接结果
                    $str = '';
                    $arr = explode(',',$v->field_value) ;

                    foreach ($arr as $n){
                        $a = explode('|',$n);

                        if($a[0] == $v->conf_content){
                            $str.= '<input type="radio" checked name="conf_content[]" value="'.$a[0].'" title="'.$a[1].'">'.$a[1].'&nbsp;&nbsp;&nbsp;';
                        }else{
                            $str.= '<input type="radio"  name="conf_content[]" value="'.$a[0].'" title="'.$a[1].'">'.$a[1].'&nbsp;&nbsp;&nbsp;';
                        }

                    }

                    $v->conf_contents = $str;


                    break;


            }
        }

       return view('admin.config.list',compact('conf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //返回添加页面
        return view('admin.config.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // //接收传过来的参数
        $input = $request->except('_token');

        $res = Config::create($input);

        if($res){
            $this->putContent();
            return redirect('admin/config');
        }else{
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Config::find($id)->delete();
        //如果删除成功
        if($res){
            $this->putContent();
            $data = [
                'status'=>0,
                'message'=>'删除成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'删除失败'
            ];
        }

        return $data;
    }
    
    
    //批量修改网站配置项的方法
    public function changeContent(Request $request)
    {
        $input = $request->except('_token');
//        dd($input);

        DB::beginTransaction();

        try{
            foreach ($input['conf_id'] as $k=>$v){
                DB::table('config')->where('conf_id',$v)->
                    update(['conf_content'=>$input['conf_content'][$k]]);
            }

            DB::commit();
            $this->putContent();
            return redirect('/admin/config');

        }catch (\Exception $e){
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error'=>$e->getMessage()]);
        }
    }
}
