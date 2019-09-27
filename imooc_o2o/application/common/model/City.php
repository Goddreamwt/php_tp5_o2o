<?php

namespace app\Common\model;

use think\Model;

class City extends Model
{
    public function getFirstCategorys($parentId = 0) {
        $data = [

            ['status','neq',-1],
        ];

        $order =[
            'listorder' => 'desc',
            'id' => 'desc',
        ];
        $result = $this->where($data)->where('parent_id',$parentId)
            ->order($order)
            ->paginate(4);
        //echo $this->getLastSql();

        return $result;

    }

    //
    public function getNormalCitysByParentId($parentId=0) {
        $data = [
            'status' => 1,
            'parent_id' => $parentId,
        ];

        $order = [
            'id' => 'desc',
        ];

        return $this->where($data)
            ->order($order)
            ->select();
    }

    public function getNormalCitys() {
        $data = [
            'status' => 1,
            'parent_id' => ['gt', 0],
        ];

        $order = ['id'=>'desc'];

        return $this->where($data)
            ->order($order)
            ->select();

    }
}
