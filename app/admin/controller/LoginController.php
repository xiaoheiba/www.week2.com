<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Journal;
use app\admin\model\User;
use app\admin\validate\LoginValidate;
use app\Request;
use think\exception\ValidateException;

class LoginController
{
    /**
     * 登录
     */
    public function login(Request $request)
    {
        //令牌验证
        $token = $request->checkToken('__token__');

        if (false === $token){
            return ['code'=>1000,'msg'=>"表单不可重复提交",'data'=>[]];
        }
        $data = $request->post();
        //独立验证器验证数据
        try {
            validate(LoginValidate::class)
                ->scene('edit')
                ->check($data);
        } catch (ValidateException $e) {
            // 验证失败 输出错误信息
                $tip = ($e->getError());
            return ['code'=>1000,'msg'=>"$tip",'data'=>[]];
        }
        $username = $data['username'];
        $userDataObj = new User();
        $LoginData = $userDataObj->login($username);
        //判断账号
        if (!$LoginData) return ['code'=>1000,'msg'=>"用户名有误",'data'=>[]];
        if ($LoginData->password != md5($data['password'])) return ['code'=>1000,'msg'=>"密码有误",'data'=>[]];
        $ip=$_SERVER['REMOTE_ADDR'];
        //return $ip;
        $time = date('Y-m-d h-i-s');
        $journalData = [
            'username'=>$username,
            'ip'=>$ip,
            'platform'=>'win',
            'dataTime'=>$time
        ];
        $journalObj = new Journal();
        $journalGetData = $journalObj->ins($journalData);
        if (!$journalGetData){
            return ['code'=>1000,'msg'=>"日志失败",'data'=>[]];
        }
        session('username',$username);
        return ['code'=>200,'msg'=>"登录成功",'data'=>[]];

    }
}
