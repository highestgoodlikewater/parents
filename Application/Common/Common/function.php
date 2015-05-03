<?php

/**
 * 检测用户是否登录
 * @return bool
 * @author weilanzhuan
 */
function is_login(){
    return session('uid') > 0? true : false;
}

//$type='Picture'或者$type='File'
function  getUrl($id,$type='Picture',$detail=false){
    $info=D($type)->find($id);
    if ($detail) {
    	return $info;
    }else{
    	if($type='Picture'){
    		$url=$info['path'];
    	}else{
    		$url=$info['savepath'];
    	}
    	return "http://120.24.88.32/parents".$url;
    }

}
//ids 为逗号隔开的字符串
function getRegionName($ids){
  $data=explode(",", $ids);
  $location="";
  foreach ($data as $key => $value) {
      # code...
     $location.= M('district')->getFieldById($value,'name');
  }
  return $location;
}
