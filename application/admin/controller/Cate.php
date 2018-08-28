<?php 
namespace app\admin\controller;

use app\admin\controller\Base;
// use think\Db;
use app\admin\model\Cate as CateModel;
class Cate extends Base
{
    public function lst(){
        $list = CateModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
    	if(request()->isPost()){
    		// dump(input('post.'));接受的e
            // $validate=new \think\Validate([
            //     'username'=>'require|max:25',
            //     'password'=>'require|max:33'
            // ]); 
    		$data =[
    			'catename'=>input('catename'),
    			
    		];
            $validate = \think\loader::validate('Cate');
            
            if(!$validate->scene('add')->check($data)){
               // $validate->getError();
                $this->error($validate->getError());
               die;
            }

    		if(db('cate')->insert($data)){

    			return $this->success('添加栏目成功!','lst');
    		}else{
    			return $this->error('添加栏目失败!');
    		}
    		return;
    	}
        return $this->fetch();
    }

    public function edit(){
        $id = input('id');
        $Cates = db('cate')->find($id);
        if(request()->isPost()){
            $data = [
                'id' =>input('id'),
                'catename' => input('catename'),
                
               
            ];
           
            $validate = \think\loader::validate('Cate');
            
            if(!$validate->scene('edit')->check($data)){
               // $validate->getError();
                $this->error($validate->getError());
               die;
            }

            $save=db('cate')->update($data);
            // dump($data);die;
            if($save !== false){
                $this->success('修改栏目成功！','lst');
            }else{
                $this->error('修改栏目失败');
            }
            return;
        }
       
        // dump($Cates);
        // die;
        $this->assign('Cates',$Cates);
        return $this->fetch();
    }

    public function del(){
        $id = input('id');
        //$id = db('cate')->delete(input('id'));
       
        if(db('cate')->delete(input('id'))){
            $this->success('删除栏目成功!','lst');
        }else{
            $this ->error('删除栏目失败!');
        }
       

        // $this->assign('Cates',$Cates);
        // return $this->fetch();
        
    }

}
