<?php 
namespace app\admin\controller;
use app\admin\controller\Base;

class Index extends Base
{
	//初始化执行
	public function _initialize(){
		echo "1111";
	}
    public function index()
    {
        return $this->fetch();
    }
}
