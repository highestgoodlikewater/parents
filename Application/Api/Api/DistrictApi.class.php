<?php

namespace Api\Api;
use Api\Api\Api;
use Api\Model\DistrictModel;


class DistrictApi extends Api{
    /**
     * 构造方法，实例化操作模型
     */
    protected function _init(){
        $this->model = new FriendsModel();
    }

    public function getDistrictList($upid=0,$level=1){
        return $this->model->getDistrictList($upid,$level);
    }

    public function getDistrictInfoById($id){
        return $this->model->updateFriend($uid,$group_id,$friend_uid,$remarker);
    }

}
