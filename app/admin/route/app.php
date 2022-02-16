<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});

Route::get('hello/:name', 'index/hello');


/**
 * 登录
 */
Route::post('login','LoginController/login');
/**
 * 群组路由
 */
Route::group(function (){
    /**
     * 添加展示
     */
    Route::get('form','ArticleController/formList');
    /**
     * 添加
     */
    Route::post('add_list','ArticleController/add_list');
    /**
     * 列表展示
     */
    Route::get('show','ArticleController/show');
    /**
     * 软删除
     */
    Route::get('del','ArticleController/del');
})->middleware(\app\admin\middleware\Check::class);
