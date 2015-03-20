<?php
namespace Mobile\Controller;
use Think\Controller;
use Api\Api\UserApi;
class LoginController extends Controller {
	//登陆
    public function login($username, $password, $type = 1){
        $UserApi=new UserApi;
        $res=$UserApi->login($username, $password, $type);
        if ($res>0) {
        	# code...
        	session('uid',$res);
        	$msg['status']=1;//登陆成功
        }else{
        	$msg['status']=0;//登陆失败
        }
        $msg['content']=$this->getLoginMsg($res);
        echo json_encode($msg);
    }
    //退出登录
    public function  loginOut(){
    	session('[destroy]'); // 销毁session
    }
     //登陆信息返回
    public function getLoginMsg($code){
    	switch ($code) {
    		case -1:
    		    $msg='用户不存在或被禁用';
    			break;
			case -2:
			    $msg='密码错误';
				break;
    		default:
    			$msg='登陆成功';
    			break;
    	}
    	return $msg;
    }
}