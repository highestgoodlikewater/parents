<?php
namespace Mobile\Controller;
use Think\Controller;
use Api\Api\UserApi;
class IndexController extends Controller {
    public function index(){
    	$UserApi=new UserApi;
      $rs=$UserApi->getMyFriends(6,8); 
      dump($rs);
    }
}