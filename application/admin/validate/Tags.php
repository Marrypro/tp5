<?php 
namespace app\admin\validate;

use think\Validate;
// use think\Db;
class Tags extends Validate
{
    protected $rule = [
        'tagname'=>'require|max:25|unique:tags',
        
    ];

    protected $message = [
        'tagname.require' =>'链接名称必须填写',
        'tagname.max'     =>'链接名称最多不能超过25个字符',
        
    ];

    protected $scene = [
        'add' =>['tagname'=>'require|unique:tags'],
        'edit' =>['tagname'=>'require|unique:tags'],
    ];
}
