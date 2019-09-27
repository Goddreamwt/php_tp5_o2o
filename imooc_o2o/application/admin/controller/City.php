<?php
namespace app\admin\controller;

use think\Controller;

class City extends Controller
{
    private $obj;
    public function initialize()
    {
        $this->obj = model("City");
    }

    public function index()
    {
        $parentId = input('get.parent_id', 0,'intval');
        $citys = $this->obj->getFirstCategorys($parentId);
        return $this->fetch('',[
            'citys' => $citys
        ]);
    }

    /*
     * 添加分类点击事件
     * */
    public function add()
    {
        $citys = $this->obj->getNormalFirstCategory();

        return $this->fetch('',[
            'citys' => $citys
        ]);
    }

    public function save() {
        //1.原生获取数据形式
        //print_r($_POST);

        //2.tp5自带方法
        //print_r(input('post.'));

        //3.
        //print_r(request()->post());

        /*
         * 做下严格判断
         * **/
        if(!request()->isPost()){
            $this->error('请求失败');
        }
        $data = input('post.');

        //$data['status'] = 10;
        //数据校验
        $validate = validate('City');
//        if (!$validate->check($data)){
//            $this->error($validate->getError());
//        }
        if(!$validate->scene('add')->check($data)) {
            $this->error($validate->getError());
        }
        //如果id不为空,更新数据库
        if(!empty($data['id'])){
            return $this->update($data);
        }

        //如果id为空，新增数据
        // 把$data 提交model层
        $res = $this->obj->add($data);
        if($res){
            $this->success('新增成功');
        }else{
            $this->error('新增失败');
        }
    }

    /*
     * 编辑页面
     * **/
    public function edit($id=0) {
        //echo input('get.id');
        //或者
        //echo $id;
        if(intval($id) < 1){
            $this->error('参数不合法');
        }
        //top5自带get方法获取数据 $id必须是model或者数据库表的主键id
        $city = $this->obj->get($id);
        $citys = $this->obj->getNormalFirstCategory();
        return $this->fetch('',[
            'citys' => $citys,
            'city' => $city
        ]);
    }


    /*
     * 更新方法
     * save属于model的父类，也就是top自带的方法
     * save参数1：数据，参数二：更新条件
     * **/
    public function update($data) {
        $res = $this->obj->save($data,['id' => intval($data['id'])]);
        if($res) {
            $this->success('更新成功');
        }else{
            $this->error('更新失败');
        }
    }

    /*
     * 排序方法
     * **/
    public function listorder($id,$listorder){
        //echo $id ."<br />";
        //echo $listorder ."<br />";
        $res = $this->obj->save(['listorder'=>$listorder],['id'=>$id]);
        if ($res){
            $this->result($_SERVER['HTTP_REFERER'],1,'success');
        }else{
            $this->result($_SERVER['HTTP_REFERER'],0,'更新失败');
        }
    }


    /*
     * 修改状态
     * **/
    public function status(){
        //校验
        $data = input('get.');

        //数据校验
        $validate = validate('Category');
        if(!$validate->scene('status')->check($data)) {
            $this->error($validate->getError());
        }

        $res = $this->obj->save(['status'=>$data['status']],['id'=>$data['id']]);
        if ($res){
            $this->success('状态更新成功');
        }else{
            $this->error('状态修改失败');
        }
    }
}