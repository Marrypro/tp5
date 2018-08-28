<?php 
namespace app\admin\validate;

use think\Validate;
// use think\Db;
class Article extends Validate
{
    protected $rule = [
        'title'=>'require|max:25',
        'cateid'=>'require',
    ];

    protected $message = [
        'title.require' =>'文章标题必须填写',
        'title.max'     =>'文章标题最多不能超过25个字符',
        
        'cateid.require' =>'请选择文章所属栏目',
    ];

    protected $scene = [
        'add' =>['title','cateid'],
        'edit' =>['cateid','title'],
    ];
}
