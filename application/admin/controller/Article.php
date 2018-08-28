<?php 
namespace app\admin\controller;

use app\admin\controller\Base;

use app\admin\model\Article as ArticleModel;
class Article extends Base
{
    public function lst(){
        // 
        // $list = db('article')->alias('a')->join('cate c' , 'c.id=a.cateid')->field('a.id,a.title,a.pic,a.author,a.state,c.catename')->paginate(3);
        $list = ArticleModel::paginate(3);
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function add()
    {
        if(request()->isPost()){
           
           //dump($_POST);die;
           $data = [
                'title' => input('title'),
                'author'=>input('author'), 
                'desce'=>input('desce'),
                 'keywords'=>str_replace('，', ',', input('keywords')),
                'content'=>input('content'),
                // 'pic'=>input('pic'),
                // 'click'=>input('click'),
                // 'state'=>input('state'),
                'cateid'=>input('cateid'),
                'time'=>time(),
                
           ];
           if(input('state')=='on'){
                $data['state']=1;
            }else{
                $data['state']=0;
            }
           if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                // dump($info);die;
                $data['pic'] = '/uploads/' . $info->getSaveName();

           }else {
                $date['pic'] = "缩略图为空";
           }
            $validate = \think\loader::validate('Article');
            
            if(!$validate->scene('add')->check($data)){
               // $validate->getError();
                $this->error($validate->getError());
               die;
            }

            if(db('article')->insert($data)){

                return $this->success('添加文章成功!','lst');
            }else{
                return $this->error('添加文章失败!');
            }
            return;
        }
        $cateres=db('cate')->select();
        $this->assign('cateres',$cateres);
        return $this->fetch();
    }

    public function edit(){
        $id = input('id');
        $Articles = db('article')->find($id);
        if(request()->isPost()){
            $data = [
                'id' =>input('id'),
                'title' => input('title'),
                'author'=>input('author'), 
                'desce'=>input('desce'),
                 'keywords'=>str_replace('，', ',', input('keywords')),
                'content'=>input('content'),
                // 'pic'=>input('pic'),
                // 'click'=>input('click'),
                // 'state'=>input('state'),
                'cateid'=>input('cateid'),
                'time'=>time(),
                
               
            ];
            if(input('state')=='on'){
                $data['state']=1;
            }else{
                $data['state']=0;
            }
           if($_FILES['pic']['tmp_name']){
                $file = request()->file('pic');
                $info = $file->move(ROOT_PATH . 'public' . DS . 'static/uploads');
                // dump($info);die;
                $data['pic'] = '/uploads/' . $info->getSaveName();

           }else {
                $date['pic'] = "缩略图为空";
           }

            $validate = \think\loader::validate('Article');
            
            if(!$validate->scene('edit')->check($data)){
               // $validate->getError();
                $this->error($validate->getError());
               die;
            }

            // dump($data);die;dd
            $save=db('article')->update($data);
            if($save!==false){
                $this->success('修改文章成功！','lst');
            }else{
                $this->error('修改文章失败');
            }
            return;
        }
       
        // dump($admins);
        // die;
       
        $cateres=db('cate')->select();
        $this->assign('cateres',$cateres);

        $this->assign('Articles',$Articles);
        return $this->fetch();
    }

    public function del(){
        $id = input('id');
        //$id = db('admin')->delete(input('id'));
      
        if(db('article')->delete(input('id'))){
            $this->success('删除文章成功!','lst');
        }else{
            $this ->error('删除文章失败!');
        }
  
        // $this->assign('admins',$admins);
        // return $this->fetch();
        
    }
    public function logout(){
        session(null);
        $this->success('退出成功','Login/index');
    }

}
