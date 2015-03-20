<?php
namespace Mobile\Controller;
use Think\Controller;
use Api\Api\GroupApi;
class GroupController extends HomeController {
	//用户详细信息
    public function addGroup($uid,$group_name,$remarker=''){
        $GroupApi=new GroupApi;
        $res=$GroupApi->addGroup(session('uid'),$group_name,$remarker);

        $msg['status']=$res;
        $msg['content']=$res>0?'添加分组成功':'添加分组失败';

        echo json_encode($msg);
    }

    //更新分组信息
    public function updateGroup($id,$group_name,$remarker=''){
    	$GroupApi=new GroupApi;
        $res=$Userppi->updateGroup(session('uid'),$group_name,$remarker='');

        $msg['status']=$res;
        $msg['content']=$res>0?'更新分组成功':'更新分组失败';
        echo json_encode($msg);
    }
    //修改密码
    public function deleteGroup($id){
		$GroupApi=new GroupApi;
        $res=$GroupApi->deleteGroup($id);

        $msg['status']=$res;
        $msg['content']=$res>0?'删除分组成功':'删除分组失败';
        echo json_encode($msg);
    }

    //更新分组信息
    public function getGroupInfo($group_id){
    	$GroupApi=new GroupApi;
        $res=$GroupApi->getGroupInfo($group_id);

        echo json_encode($res);
    }
    //根据uid 获得属于自己的分组
    public function  getGroupsByuid($uid){
        $GroupApi=new GroupApi;
        $res=$GroupApi->getGroupsByuid($uid);

        echo json_encode($res);
    }

}