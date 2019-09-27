<?php
namespace app\admin\controller;

use think\Controller;

class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function welcome()
    {

        \Map::getLngLat('北京昌平地铁');
        return '欢迎来到o2o主后台首页';
    }

    public function map(){
//
       return \Map::staticimage('河北省保定市');
    }
}
