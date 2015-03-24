<?php

namespace Api\Api;
use Api\Api\Api;
use Api\Model\DistrictModel;


class DistrictApi extends Api{
    /**
     * 构造方法，实例化操作模型
     */
    protected function _init(){
        $this->model = new DistrictModel();
    }
    //获得不同等级的地区
    public function getDistrictList($upid=0,$level=1){
        return $this->model->getDistrictList($upid,$level);
    }
     //获得对应id 的地区信息
    public function getDistrictInfoById($id){
        return $this->model->updateFriend($uid,$group_id,$friend_uid,$remarker);
    }

}
