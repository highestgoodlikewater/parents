<?php


namespace Api\Api;
use Api\Api\Api;
use Api\Model\GroupModel;
use Api\Model\GroupFriendsModel;

class GroupApi extends Api{
    /**
     * 构造方法，实例化操作模型
     */
    protected function _init(){
        $this->model = new GroupModel();
    }

    public function addGroup($uid,$group_name,$remarker=''){
        return $this->model->addGroup($uid,$group_name,$remarker='');
    }

    public function updateGroup($id,$group_name,$remarker=''){
        return $this->model->updateGroup($id,$group_name,$remarker='');
    }
    public function deleteGroup($id){
        return $this->model->deleteGroup($id);
    }

    public function getGroupInfo($group_id){
        return $this->model->getGroupInfo($group_id);
    }
    public function getGroupsByuid($uid){
        return $this->model->getGroupsByuid($uid);
    }

        //分组下的好友
    public function  groupFriends($uid,$group_id){

       if (empty($uid)&&empty($group_id)) {
           # code...
         return  false;
       }

       if (!empty($uid)&&$uid>0) {
           # code...
          $map['uid']=$uid;
       }
       if (!empty($group_id)&&$group_id>0) {
           # code...
          $map['group_id']=$group_id;
       }
       $GroupModel=new GroupModel();
       $GroupFriends=new GroupFriendsModel();
       $arr=$GroupModel->where($map)->select();
       // dump($arr);
       $res=array();
       foreach ($arr as $key => $value) {
           # code...
           $condition['group_id']=$value['group_id'];
           $value['friends']=$GroupFriends->where($condition)->field('')->select();
           $res[]=$value;
       }

       return $res;
    }
}
