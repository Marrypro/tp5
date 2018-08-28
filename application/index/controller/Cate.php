<?php
namespace app\index\controller;

use app\index\controller\Base;
use think\Db;
class Cate extends Base
{
    public function index()
    {
    	$cateid = input('cateid');
    	//查询当前栏目的名称
    	$cates=db('cate')->find($cateid );
    	$this->assign('cates',$cates);
    	//查询当前栏目下的文章
    	$articles = db('article') ->where(array('cateid'=>$cateid))->paginate(1);
    	$this->assign('articles',$articles);
        return $this->fetch('cate');
    }
}
