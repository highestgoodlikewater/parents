<?php
namespace Mobile\Controller;
use Think\Controller;
use Api\Api\UserApi;
class UserController extends HomeController {
	//用户详细信息
    public function detailInfo(){
        $UserApi=new UserApi;
        $res=$UserApi->detailInfo(session('uid'));

        $msg['status']=1;
        $msg['content']=$res;
        if ($res<0) {
          $msg['status']=0;
          $msg['content']='个人信息获取失败！';
        }else{
        	$res['photo']=getUrl($res['uid']);
        }
        echo json_encode($msg);
    }

    //更新用户信息
    public function updateInfo(){
    	$UserApi=new UserApi;
        $res=$Userppi->updateInfo(session('uid'),$_POST);
        echo json_encode($res);
    }
    //修改密码
    public function changePasswd($password,$new_password){
		$UserApi=new UserApi;
        $res=$UserApi->updateInfo(session('uid'),$password,$new_password);
        echo json_encode($res);
    }

    //更新用户信息
    public function updatePhoto(){
    	$info=R('File/uploadPicture');//上传头像的数据返回。
        $msg['status']=1;
        $msg['content']='';
    	if ($data['status']!=0) {
    		$data['photo']=$info['id'];

    		$UserApi=new UserApi;
            $res=$UserApi->updateInfo(session('uid'),$data);
    	}else{
			$msg['status']=0;
	        $msg['content']=$info['info'];
    	}

        echo json_encode($msg);
    }
    //获取我的好友
    public function getMyFriends($friend_uid=0){
            $UserApi=new UserApi;
            $res=$UserApi->getMyFriends(session('uid'),$friend_uid);

            echo json_encode($res);
    }

}