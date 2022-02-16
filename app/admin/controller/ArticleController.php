<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Article;
use app\Request;
use think\db\Where;
use think\facade\Filesystem;
use think\Image;
use think\response\Redirect;

class ArticleController
{
    /**
     * 添加展示
     */
    public function formList()
    {
        $articleObj = new Article();
        $articleData = $articleObj->pattern();

        return view('./add_list',['dataType'=>$articleData]);
    }
    /**
     * 添加
     */
    public function add_list(Request $request)
    {
        $file = $request->file('image');
        $pathImage = Filesystem::disk('public')->putFile('',$file);
        $image = Image::open('image/'.$pathImage);
        $pathImg = md5(time().rand(11111,99999)).'.jpg';

        $image->thumb(100,100)->text('CREMB',realpath('STZHONGS.TTF'),'20','#ffffff')->save('img/'.$pathImg);
        $data = $request->post();
        $data['image']=$pathImage;
        $articleObj = new Article();
        $articleData = $articleObj->ins($data);
        if ($articleData) return redirect('/admin/show');
    }

    /**
     * @return \think\response\View
     * 列表展示
     */
    public function show(Request $request)
    {
        $search = $request->get('search');
        $searchD = $request->get('searchD');
        $where = [];
        if($search)
        {
            $where[] = array('title', 'like', "%$search%");
        }
        if($searchD)
        {
            $where[] = array('a_type', $searchD);
        }

        $obj = new Article();
        $data = $obj->getList($where);
        $articleData = $obj->pattern();
        return view('./show',['data'=>$data,'dataType'=>$articleData,'search'=>$search,'searchD'=>$searchD]);
    }
    /**
     * 软删除
     */
    public function del($id)
    {
        $obj = new Article();
        $data = $obj->del($id);
        if ($data) return redirect('/admin/show');
    }
}
