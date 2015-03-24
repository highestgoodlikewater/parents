<?php
namespace Mobile\Controller;
use Think\Controller;
use Api\Api\UserApi;
class SearchController extends Controller {
    public function seachUser($username=''){
      $UserApi=new UserApi;
      $res=$UserApi->searchUser($username);
      echo json_encode($res);
    }
    public function detailInfo($id){
        $UserApi=new UserApi;
        $res=$UserApi->detailInfo($id);

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
}