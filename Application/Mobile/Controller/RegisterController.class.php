<?php
namespace Mobile\Controller;
use Think\Controller;
use Api\Api\UserApi;
class RegisterController extends Controller {
	//用户注册
    public function register($username, $password, $email='', $mobile=''){
        $UserpApi=new UserApi;
        $res=$UserpApi->register($username, $password, $email, $mobile);
        $res['content']=$res['status']>0?'注册成功！':$res['error'];
        unset($res['error']);
        echo json_encode($res);
    }

}