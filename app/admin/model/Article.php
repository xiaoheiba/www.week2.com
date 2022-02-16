<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\Model;
use think\model\concern\SoftDelete;

/**
 * @mixin \think\Model
 */
class Article extends Model
{
    /**
     * 分类
     */
    public function pattern()
    {
        return $this->table('a_type')->select();
    }
    /**
     * 添加
     */
    public function ins($data)
    {
        return $this->insert($data);
    }
    /**
     * 列表展示
     */
    public function getList($where = '')
    {
        if(!$where)
        {
            $data = self::join('a_type','article.a_type = a_type.a_id')->paginate(4);
        }
        else
        {
            $data = self::join('a_type','article.a_type = a_type.a_id')
                ->where($where)
                ->paginate(4);
        }
        return $data;
    }
    /**
     * 软删除
     */
    use SoftDelete;
    protected $deleteTime = 'delete_time';
    public function del($id)
    {
        return $this->destroy($id);
    }
}
