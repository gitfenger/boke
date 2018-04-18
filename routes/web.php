<?php


//前台路由

Route::get('index','Home\IndexController@index');
Route::get('lists/{id}','Home\IndexController@lists');
Route::get('detail/{id}','Home\IndexController@detail');


//收藏
Route::post('collect','Home\IndexController@collect');
//评论
Route::post('comment','Home\IndexController@comment');

//邮箱注册激活路由
Route::get('emailregister','Home\RegisterController@register');
Route::post('doregister','Home\RegisterController@doRegister');

Route::get('active','Home\RegisterController@active');
Route::get('forget','Home\RegisterController@forget');
//发送密码找回邮件
Route::post('doforget','Home\RegisterController@doforget');
//重新设置密码页面
Route::get('reset','Home\RegisterController@reset');
//重置密码逻辑
Route::post('doreset','Home\RegisterController@doreset');


//登录
Route::get('login','Home\LoginController@login');
Route::post('dologin','Home\LoginController@doLogin');
Route::get('loginout','Home\LoginController@loginOut');




//手机注册页路由
Route::get('phoneregister','Home\RegisterController@phoneReg');
//发送手机验证码
Route::get('sendcode','Home\RegisterController@sendCode');
Route::post('dophoneregister','Home\RegisterController@doPhoneRegister');




Route::get('/code/captcha/{tmp}', 'Admin\LoginController@captcha');

Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
//后台登录路由
    Route::get('login','LoginController@login');
//验证码路由
    Route::get('code','LoginController@code');
//处理后台登录的路由
    Route::post('dologin','LoginController@doLogin');

//加密算法
    Route::get('jiami','LoginController@jiami');
});

Route::get('noaccess','Admin\LoginController@noaccess');

Route::group(['prefix'=>'admin','namespace'=>'Admin','middleware'=>['isLogin']],function(){
//后台首页路由
    Route::get('index','LoginController@index');
//后台欢迎页
    Route::get('welcome','LoginController@welcome');
//后台退出登录路由
    Route::get('logout','LoginController@logout');

//    后台用户模块相关路由
//    给用户授权相关路由
    Route::get('user/auth/{id}','UserController@auth');
    Route::post('user/doauth','UserController@doAuth');
    //修改用户状态 停用  启用
    Route::post('user/changestatus','UserController@changestatus');
//    删除所有选中用户路由
    Route::get('user/del','UserController@delAll');
    Route::resource('user','UserController');


//    角色模块
//    角色授权路由
    Route::get('role/auth/{id}','RoleController@auth');
    Route::post('role/doauth','RoleController@doAuth');
    Route::resource('role','RoleController');


    // 权限模块路由
    Route::resource('permission','PermissionController');

//    分类路由
//    修改排序
    Route::post('cate/changeorder','CateController@changeOrder');
    Route::resource('cate','CateController');

    //文章模块路由
    //上传路由
    //将markdown语法的内容转化为html语法的内容
    Route::post('article/pre_mk','ArticleController@pre_mk');
//    文章缩略图上传路由
    Route::post('article/upload','ArticleController@upload');
//    文章添加到推荐位路由
    Route::get('article/recommend','ArticleController@recommend');
    Route::resource('article','ArticleController');


    //网站配置模块路由
    Route::post('config/changecontent','ConfigController@changeContent');
    Route::get('config/putcontent','ConfigController@putContent');
    Route::resource('config','ConfigController');
});




