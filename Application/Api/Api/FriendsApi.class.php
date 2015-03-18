<?php


namespace Api\Api;
use Api\Api\Api;
use Api\Model\FriendsModel;


class FriendsApi extends Api{
    /**
     * 构造方法，实例化操作模型
     */
    protected function _init(){
        $this->model = new FriendsModel();
    }

    public function addFriend($uid,$group_id,$friend_uid,$remarker=''){
        return $this->model->addFriend($uid,$group_id,$friend_uid,$remarker);
    }

    public function updateFriend($uid,$group_id,$friend_uid,$remarker=''){
        return $this->model->updateFriend($uid,$group_id,$friend_uid,$remarker);
    }
    public function deleteFriend($uid,$group_id,$friend_uid){
        return $this->model->deleteFriend($uid,$group_id,$friend_uid);
    }

}
