<?php 
namespace app\admin\controller;
use app\admin\controller\Base;



use app\admin\model\Tags as TagsModel;
class Tags extends Base
{
    public function lst(){
        $list = TagsModel::paginate(3);
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
    			
    			// 'password'=>md5(input('password')),
                'tagname'=>input('tagname'),      // 
                
    		];
            $validate = \think\loader::validate('Tags');
            
            if(!$validate->scene('add')->check($data)){
               // $validate->getError();
                $this->error($validate->getError());
               die;
            }

    		if(db('tags')->insert($data)){

    			return $this->success('添加标签成功!','lst');
    		}else{
    			return $this->error('添加标签失败!');
    		}
    		return;
    	}
        return $this->fetch();
    }

    public function edit(){
        $id = input('id');
        $tagse = db('tags')->find($id);
        if(request()->isPost()){
            $data = [
                'id' =>input('id'),
                'tagname' => input('tagname'),
                
                
               
            ];
           
            $validate = \think\loader::validate('Tags');
            
            if(!$validate->scene('edit')->check($data)){
               // $validate->getError();
                $this->error($validate->getError());
               die;
            }

            // dump($data);die;
            if(db('tags')->update($data)){
                $this->success('修改标签成功！','lst');
            }else{
                $this->error('修改标签失败');
            }
            return;
        }
       
        // dump($admins);
        // die;
        $this->assign('tagse',$tagse);
        return $this->fetch();
    }

    public function del(){
        $id = input('id');
        //$id = db('admin')->delete(input('id'));
      
        if(db('link')->delete(input('id'))){
            $this->success('删除标签成功!','lst');
        }else{
            $this ->error('删除标签失败!');
        }
  
        // $this->assign('admins',$admins);
        // return $this->fetch();
        
    }

}
