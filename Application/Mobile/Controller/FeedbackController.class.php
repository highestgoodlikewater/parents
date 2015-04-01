<?php
namespace Mobile\Controller;
use Think\Controller;

class FeedbackController extends Controller{
	public  function addFeedback(){
		$msg['status']=0;
		if (!IS_POST) {
		  $msg['content']='非法提交';
		  die(json_encode($msg));
		}
		$_POST['add_time']=time();
		$id=M('feedback')->add($_POST);
		$msg['status']=$id;
		$msg['content']=$id>0?"提交成功，谢谢您的支持":"提交失败，请稍后重试";
		echo json_encode($msg);
	}
}