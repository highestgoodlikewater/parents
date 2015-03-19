<?php


namespace Api\Api;
use Api\Api\Api;
use Api\Model\InvitationModel;

/**
*邀请模型
*/
class InvitationApi extends Api{
    /**
     * 构造方法，实例化操作模型
     */
    protected function _init(){
        $this->model = new InvitationModel();
    }

    public function addInvitation($from_uid,$to_uid,$from_remarker=''){
        return $this->model->addInvitation($from_uid,$to_uid,$from_remarker='');
    }

    public function updateInvitation($id,$data){
        return $this->model->updateInvitation($id,$data);
    }
    public function deleteInvitation($id){
        return $this->model->deleteInvitation($id);
    }

    public function  getInvitationInfoById($id){
        return $this->model-> getInvitationInfoById($id);
    }
    public function  InvitationInfoByUid($uid){
        return $this->model-> InvitationInfoByUid($uid);
    }

}
