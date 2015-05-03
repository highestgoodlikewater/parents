<?php
namespace Mobile\Controller;
use Think\Controller;
use Api\Api\UserApi;
use Api\Api\ArticleApi;
use Api\Api\DistrictApi;
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
        	$res['photo']=getUrl($res['photos']);
        }
        echo json_encode($msg);
    }
     //参数必须$page=1,$page_count=10,$use_page=true  ,cate_id
    //获取文章列表
    public function getArticleList(){
      $ArticleApi=new ArticleApi;
      $res=$ArticleApi->getArticleList($_POST,$page,$page_count,$use_page);
      echo json_encode($res);
    }

    public function  getDistrictList($upid=0,$level=1){
      $DistrictApi=new DistrictApi;
      $res=$DistrictApi->getDistrictList($upid,$level);
      echo json_encode($res);
    }

    public function test($id){
     echo  getUrl($id);
    }
}