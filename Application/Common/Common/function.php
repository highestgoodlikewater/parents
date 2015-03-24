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
    	return $url;
    }

}
