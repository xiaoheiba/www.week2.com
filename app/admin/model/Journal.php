<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class Journal extends Model
{
    /**
     * 登录日志
     */
    public function ins($journalData)
    {
        return $this->insert($journalData);
    }
}
