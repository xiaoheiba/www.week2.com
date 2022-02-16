<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class User extends Model
{
    /**
     * 登录
     */
    public function login($username)
    {
        return $this->where('username',$username)->find();
    }
}
