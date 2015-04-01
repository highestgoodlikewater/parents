<?php
namespace Mobile\Controller;
use Think\Controller;
use Api\Api\ArticleApi;
class IndexController extends Controller {
    public function index(){
    	$ArticleApi=new ArticleApi;
     //  $rs=$UserApi->getMyFriends(6,8); 
     //  dump($rs);
    	$res=$ArticleApi->delActicle(1);
    	dump($res);
    }
}