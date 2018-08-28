<?php 
namespace app\admin\controller;
use app\admin\controller\Base;



use app\admin\model\Link as LinkModel;
class Link extends Base
{
    public function lst(){
        $list = LinkModel::paginate(3);
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
    			'title'=>input('title'),
    			// 'password'=>md5(input('password')),
                'url'=>input('url'),      // 
                'dsc'=>input('dsc'),
    		];
            $validate = \think\loader::validate('Link');
            
            if(!$validate->scene('add')->check($data)){
               // $validate->getError();
                $this->error($validate->getError());
               die;
            }

    		if(db('link')->insert($data)){

    			return $this->success('添加链接成功!','lst');
    		}else{
    			return $this->error('添加链接失败!');
    		}
    		return;
    	}
        return $this->fetch();
    }

    public function edit(){
        $id = input('id');
        $links = db('link')->find($id);
        if(request()->isPost()){
            $data = [
                'id' =>input('id'),
                'title' => input('title'),
                'url' => input('url'),
                'dsc' => input('dsc'),
                
               
            ];
           
            $validate = \think\loader::validate('Link');
            
            if(!$validate->scene('edit')->check($data)){
               // $validate->getError();
                $this->error($validate->getError());
               die;
            }

            // dump($data);die;
            if(db('link')->update($data)){
                $this->success('修改链接成功！','lst');
            }else{
                $this->error('修改链接失败');
            }
            return;
        }
       
        // dump($admins);
        // die;
        $this->assign('links',$links);
        return $this->fetch();
    }

    public function del(){
        $id = input('id');
        //$id = db('admin')->delete(input('id'));
      
        if(db('link')->delete(input('id'))){
            $this->success('删除链接成功!','lst');
        }else{
            $this ->error('删除链接失败!');
        }
  
        // $this->assign('admins',$admins);
        // return $this->fetch();
        
    }

}
