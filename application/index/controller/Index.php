<?php
namespace app\index\controller;
// use app\index\controller\Base;
// use think\Db;
use think\Controller;
class Index extends Controller
{
    public function index()
    // {
    // 	$articles = db::name('article')->order('id desc')->paginate(2);
    // 	$this->assign('articles',$articles);
        return $this->fetch();
    }
}
