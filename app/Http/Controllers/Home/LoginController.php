<?php

namespace App\Http\Controllers\Home;

use App\Model\HomeUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Mail;
class LoginController extends Controller
{

//    登录页
    public function login()
    {
        return view('home.login');
    }

    public function doLogin(Request $request)
    {
        $input = $request->except('_token','wp-submit');
//        dd($input);
        $username = $input['user_name'];
        $password = $input['user_pass'];
//        $token = md5(uniqid(rand(), TRUE));
        $timeout = time() + 60*60*24*7;

        if(isset($input['rememberme'])){
            setcookie('username', "$username", $timeout);
            setcookie('password', "$password", $timeout);
        }else{
            setcookie('username', "", time()-1);
            setcookie('password', "",time()-1);
        }


//        3. 验证用户是否存在

        $user = HomeUser::where('user_name',$input['user_name'])->first();
        if(empty($user)){
            return redirect('login')->with('errors','用户名不存在');
        }



//        4. 密码是否正确
        if($input['user_pass'] !=  Crypt::decrypt($user->user_pass) ){
            return redirect('login')->with('errors','密码不对');
        }

        //如果登录成功，将登录用户信息保存到session中

        session()->put('homeuser',$user);

        return redirect('index');
    }






    //退出登录
    public function loginOut()
    {
        session()->forget('homeuser');
        setcookie('password', "",time()-1);
        return redirect('index');
    }


    public function jiami()
    {
//        md5加密
        $str = '123456';
//        $md5str =  md5($str);

//        $salt = '123';
//        $str='456';
//        $md5str = md5($salt.$str);
//        return $md5str;
//        hash加密
//        return Hash::make($str);
//        $hstr = '$2y$10$cCn9ifz9MjmAoPF.8rb8Hu7B0Vx9vWBwoG4wBhLViEVIykLlbJt6q';
//        如何验证传过来的密码跟数据库中经过hash加密的密码一致
//        $res = Hash::check($str,$hstr);
//        dd($res);


//        crypt加密
        return  Crypt::encrypt($str);
//       $cryptstr = 'eyJpdiI6ImpYdFBpc3gzb043OWdRXC9vellRMUF3PT0iLCJ2YWx1ZSI6IlQrYkt0Ump3Uk1nTHFtb21zUGtwSXc9PSIsIm1hYyI6ImQ0ZTBmNDg5YWU3MDgwODU0YmZjNDRhMTdkNmJkODc4MjRiZjQwZTI1NmMwZTExMjc3MTZkNjJjNmQ0YmIzMTQifQ==';

//       return Crypt::decrypt($cryptstr);
    }

}
