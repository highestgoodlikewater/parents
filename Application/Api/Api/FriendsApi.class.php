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

    public function addFriend($uid,$friend_uid,$remarker=''){
        return $this->model->addFriend($uid,$friend_uid,$remarker);
    }

    public function updateFriend($uid,$data){
        return $this->model->updateFriend($uid,$data);
    }
    public function deleteFriend($uid,$friend_uid){
        return $this->model->deleteFriend($uid,$friend_uid);
    }

}
