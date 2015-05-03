<?php
namespace Mobile\Controller;
use Think\Controller;
use Api\Api\UserApi;
use Api\Api\ArticleApi;
class UserController extends HomeController {
	//用户详细信息
    public function detailInfo(){
        $UserApi=new UserApi;
        $res=$UserApi->detailInfo(session('uid'));

        $msg['status']=1;       
        if ($res<0) {
          $msg['status']=0;
          $msg['content']='个人信息获取失败！';
        }else{
        	$res['photos']=getUrl($res['photos']);
          $res['home_district']=getRegionName($res['home_district']);
          $res['live_district']=getRegionName($res['live_district']);
          $msg['content']=$res;
        }
        echo json_encode($msg);
    }

    //更新用户信息
    public function updateInfo(){
    	$UserApi=new UserApi;
        $res=$UserApi->updateInfo(session('uid'),$_POST);
        echo json_encode($res);
    }
    //修改密码
    public function changePasswd($password,$new_password){
		    $UserApi=new UserApi;
        $res=$UserApi->changePasswd(session('uid'),$password,$new_password);
        echo json_encode($res);
    }

    //更新用户信息
    public function updatePhoto(){
    	$info=R('File/uploadPicture');//上传头像的数据返回。
        $msg['status']=$info['status'];
        $msg['content']=$info['content'];
    	if ($info['status']!=0) {
    		$data['photos']=$info['photo']['id'];
    		$UserApi=new UserApi;
        $res=$UserApi->updateInfo(session('uid'),$data);
    	}

        echo json_encode($msg);
    }
    //获取我的好友
    public function getMyFriends($friend_uid=0){
            $UserApi=new UserApi;
            $res=$UserApi->getMyFriends(session('uid'),$friend_uid);

            echo json_encode($res);
    }

    //删除文章
    public function delActicle($article_id){
      $ArticleApi=new ArticleApi;
      $res=$ArticleApi->delActicle($article_id);
      
      $msg['status']=$res>0?$res:0;
      $msg['content']=$res>0?"删除成功":"删除失败";
      echo json_encode($msg);
    }

    //添加文章
    public function addActicle($data){
      $ArticleApi=new ArticleApi;
      $_POST['uid']=session('uid');

      $res=$ArticleApi->addActicle($_POST);
      $msg['status']=$res>0?$res:0;
      $msg['content']=$res>0?"添加成功":"添加失败";
      echo json_encode($msg);
    }


    //修改文章
    public function updateActicle(){
      $ArticleApi=new ArticleApi;
      $_POST['uid']=session('uid');
      $article_id=I('article_id');

      $res=$ArticleApi->updateActicle($article_id,$_POST);
      $msg['status']=$res>0?$res:0;
      $msg['content']=$res>0?"修改成功":"修改失败";
      echo json_encode($msg);
    }

    //点赞
    public function addLike(){
      $ArticleApi=new ArticleApi;
      $uid=session('uid');
      $article_id=I('article_id');

      $res=$ArticleApi->addLike($uid,$article_id);
      $msg['status']=$res>0?$res:0;
      $msg['content']=$res>0?"点赞成功":"点赞失败";
      echo json_encode($msg);
    }

    //取消点赞
    public function delLike(){
      $ArticleApi=new ArticleApi;
      $uid=session('uid');
      $article_id=I('article_id');

      $res=$ArticleApi->delLike($uid,$article_id);
      $msg['status']=$res>0?$res:0;
      $msg['content']=$res>0?"点赞成功":"点赞失败";
      echo json_encode($msg);
    }

        //添加评论
    public function addComment(){
      $ArticleApi=new ArticleApi;
      $uid=session('uid');

      $res=$ArticleApi->addComment($uid,$_POST);
      $msg['status']=$res>0?$res:0;
      $msg['content']=$res>0?"添加评论成功":"添加评论失败";
      echo json_encode($msg);
    }

    //删除评论
    public function delComment(){
      $ArticleApi=new ArticleApi;
      $comment_id=I('comment_id');
      $res=$ArticleApi->delComment($comment_id);
      $msg['status']=$res>0?$res:0;
      $msg['content']=$res>0?"删除评论成功":"删除评论失败";
      echo json_encode($msg);
    }

        //获取个人发布的文章
    public function getArticleList($page=1,$page_count=10){
      $ArticleApi=new ArticleApi;
      $map=session('uid');
      $res=$ArticleApi->getArticleList($map,$page,$page_count);
      echo json_encode($res);
    }

}