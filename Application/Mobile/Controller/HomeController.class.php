<?php
namespace Mobile\Controller;
use Think\Controller;
class HomeController extends Controller {

    protected function _initialize(){
      if (!is_login()) {
      	# code...
      	$msg['status']='-1001';
      	$msg['error']='您还没有登陆！';
      	die(json_encode($msg));
      }
    }

    public function  test(){
    	echo "string";
    }

}