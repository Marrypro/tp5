<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
class Base extends Controller
{
    public function _initialize()
    {
    	$this->right();
        $tagres=db('tags')->order('id desc')->select();
    	$caters = Db::name('cate')->order('id asc')->select();
    	$this->assign(array(
                'caters'=>$caters,
                'tagres'=>$tagres,
            ));

       
    }
    public function right(){
    	$clickres=db('article')->order('click desc')->limit(8)->select();
    	$tjres=db('article')->where('state',"=",1)->order('click desc')->limit(8)->select();
    	$this->assign(array(
    			'clickres'=>$clickres,
    			'tjres'=>$tjres
    		));
    }
}
