<?php
namespace Mobile\Controller;
use Think\Controller;
class ProblemController extends Controller {
	//用户注册
    public function getProblem(){
      $p=I('p')==''?1:I('p');
      $User = M('Problem'); // 实例化User对象
      // 进行分页数据查询 注意page方法的参数的前面部分是当前的页数使用 $_GET[p]获取
      $list = $User->where('status=1')->order('add_time')->page($p.',1')->select();
      echo json_encode($list);
    }

}