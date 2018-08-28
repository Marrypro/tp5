<?php 
namespace app\admin\validate;

use think\Validate;
// use think\Db;
class Link extends Validate
{
    protected $rule = [
        'title'=>'require|max:25',
        'url'=>'require'
    ];

    protected $message = [
        'title.require' =>'链接名称必须填写',
        'title.max'     =>'链接名称最多不能超过25个字符',
        'url.require' =>'链接路径必须填写',
    ];

    protected $scene = [
        'add' =>['title'=>'require','url'=>'require'],
        'edit' =>['title'=>'require','url'=>'require'],
    ];
}
