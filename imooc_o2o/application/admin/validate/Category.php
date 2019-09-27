<?php
namespace app\admin\validate;
use think\Validate;

class Category extends Validate {
    protected  $rule = [
        'name' => 'require|max:1000',
        'parent_id' => 'number',
        'id' => 'number',
        'status' => 'number',
        'listorder' => 'number',
    ];

    protected $message =[
        'name.require' => '分类名称不能为空',
        'name.max' => '分类名不能超过10个字符',
        'status.number' => '状态非数字',
        'status.in' => '状态不在区间值',
    ];

    /**场景设置**/
    protected  $scene = [
        'add' => ['name', 'parent_id', 'id'],// 添加
        'listorder' => ['id', 'listorder'], //排序
        'status' => ['id'],
    ];
}