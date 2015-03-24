<?php
namespace Mobile\Controller;
use Think\Controller;
use Api\Api\FriendsApi;
use Api\Api\InvitationApi;
class FriendsController extends HomeController{
	//发送邀请
  	public function setInvitation($from_uid,$to_uid,$from_remarker=''){
  		# code...
  		$InvitationApi=new InvitationApi;
  		$res=$InvitationApi->addInvitation($from_uid,$to_uid,$from_remarker='');

  		$msg['status']=$res>0?$res:0;
      $msg['content']=$res>0?'邀请已发送':'邀请发送失败';

      echo json_encode($msg);
  	}
    //处理邀请 0表示出了被人给我我们发送的请求，1便是处理我们给别人的请求
	public function  handlerInvitation($id,$is_from=0,$status,$remarker,$friendname){
        if ($is_from==0) {
        	# code...
           $data['to_status']=$status;
           $data['status']=$status;
           $data['to_remarker']=empty($remarker)?'':$remarker;
        }else{
           $data['from_status']=$status;
           $data['status']=$status;
           $data['from_remarker']=empty($remarker)?'':$remarker;
        }
		$InvitationApi=new InvitationApi;
        $res= $InvitationApi->updateInvitation($id,$data);
        $msg['status']=$res>0?$res:0;
        $msg['content']=$res>0?'邀请处理成':'邀请处理失败';

        if ($res&&$is_from==0) {

          	$info=$InvitationApi->getInvitationInfoById($id)
          	$FriendsApi=new FriendsApi;
            $data=$FriendsApi->addFriend(session('uid'),$info['from_uid'],$friendname);

            $msg['status']=$data>0?$data:0;
        	  $msg['content']=$data>0?'成功添加对方为好友':'添加好友失败';

        }

        echo json_encode($msg);
	}

	//根据uid 获得邀请信息
    public function  InvitationInfoByUid($uid){
       $InvitationApi=new InvitationApi;
       $res =$InvitationApi->InvitationInfoByUid(session('uid'));
       echo json_encode($res);
    }
     //更新好友资料，移动分组，修改备注
    public function  updateFriend(){
    	$FriendsApi=new FriendsApi;
      $data= $FriendsApi->updateFriend(session('uid'),$_POST);

		  $msg['status']=$data>0?$data:0;
    	$msg['content']=$data>0?'更新成功':'更新失败';

    	echo json_encode($msg);
    }

         //删除好友
    public function deleteFriend($uid,$friend_uid){
    	$FriendsApi=new FriendsApi;
      $data= $FriendsApi->deleteFriend($uid,$friend_uid);

		  $msg['status']=$data>0?$data:0;
    	$msg['content']=$data>0?'删除成功':'删除失败';

    	echo json_encode($msg);
    }



}