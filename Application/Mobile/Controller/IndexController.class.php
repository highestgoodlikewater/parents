<?php
namespace Mobile\Controller;
use Think\Controller;
// use Api\Api\GroupApi;
class IndexController extends Controller {
    public function index(){
echo session('uid');
     
    }
}