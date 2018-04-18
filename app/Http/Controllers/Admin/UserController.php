<?php

namespace App\Http\Controllers\Admin;

use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use DB;

class UserController extends Controller
{
    //返回角色授权页面
    public function auth($id)
    {
        //根据ID获取用户
        $user = User::find($id);
        //获取所有的角色
        $roles = Role::get();

        //获取当前用户已经被授予的角色
        $own_roles = $user->role;
//        dd($own_roles);

        //当前用户拥有的角色的ID列表
        $own_roleids = [];
        foreach ($own_roles as $v){
            $own_roleids[] = $v->id;
        }


        return view('admin.user.auth',compact('user','roles','own_roleids'));
    }


    //处理角色授权
    public function doAuth(Request $request)
    {
        $input = $request->all();
//        dd($input);

        DB::beginTransaction();

        try{
            //要执行的sql语句
            //删除当前角色被赋予的所有权限
            DB::table('user_role')->delete();

            if(!empty($input['role_id'])){
                //将提交的数据添加到 角色权限关联表
                foreach ($input['role_id'] as $v){
                    DB::table('user_role')->insert([
                        'user_id'=>$input['user_id'],
                        'role_id'=>$v
                    ]);
                }
            }

            DB::commit();

            return redirect('admin/user');


        }catch(Exception $e){
            DB::rollBack();
            return redirect()->back()
                ->withErrors(['error' => $e->getMessage()]);
        }

    }
    /**
     * 获取用户列表
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        1. 获取提交的请求参数
//        $input = $request->all();
//        dd($input);
       $user =  User::orderBy('user_id','asc')
            ->where(function($query) use($request){
                $username = $request->input('username');
                $email = $request->input('email');
                if(!empty($username)){
                    $query->where('user_name','like','%'.$username.'%');
                }
                if(!empty($email)){
                    $query->where('email','like','%'.$email.'%');
                }
            })
            ->paginate($request->input('num')?$request->input('num'):3);


//        $user = User::paginate(3);
        return view('admin.user.list',compact('user','request'));
    }

    /**
     * 返回用户添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * 执行添加操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return 11111;
        //1. 接收前台表单提交的数据  email   pass repass
        $input = $request->all();

//        2. 进行表单验证

//        3. 添加到数据库的user表
        $username = $input['email'];


        $pass = Crypt::encrypt($input['pass']);

        $res = User::create(['user_name'=>$username,'user_pass'=>$pass,'email'=>$input['email']]);


//        4 根据添加是否成功，给客户端返回一个json格式的反馈
        if($res){
            $data = [
                'status'=>0,
                'message'=>'添加成功'
            ];

        }else{
            $data = [
                'status'=>1,
                'message'=>'添加失败'
            ];

        }

//        json_encode($data)
        return $data;
    }

    /**
     * 显示一条用户记录
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 返回一个修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.user.edit',compact('user'));
    }

    /**
     * 执行修改操作
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//        1. 根据id获取要修改的记录
        $user = User::find($id);
//        2. 获取要修改成的用户名
        $username = $request->input('user_name');

        $user->user_name = $username;

        $res = $user->save();

        if($res){
            $data = [
                'status'=>0,
                'message'=>'修改成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'修改失败'
            ];
        }
        return $data;
    }

    /**
     * 执行删除操作
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $res = $user->delete();
        if($res){
            $data = [
                'status'=>0,
                'message'=>'修改成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'message'=>'修改失败'
            ];
        }
        return $data;
    }
    
    //删除所有选中用户
    public function delAll(Request $request)
    {
        $input = $request->input('ids');

        $res = User::destroy($input);

        if($res){
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
    //修改用户状态  启用和禁用
    public function changeState(Request $request)
    {
        $status = $request->input('status');
        $userid = $request->input('userid');

        $user = User::find($userid);
        $res = $user->update(['status' => 0]);
        if($res){
//            return 1111;
            $data = [
                'status'=>0,
                'msg'=>'修改成功'
            ];
        }else{
//            return 2222;
            $data = [
                'status'=>1,
                'msg'=>'修改失败'
            ];
        }
        return $data;
    }

}
