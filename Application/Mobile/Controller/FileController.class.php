<?php

namespace Mobile\Controller;
use Think\Controller;
/**
 * 文件控制器
 * 主要用于下载模型的文件上传和下载
 */
class FileController extends Controller {

    /* 文件上传 */
    public function upload($is_ajax=false){
		$return  = array('status' => 1, 'content' => '上传成功', 'data' => '');
		/* 调用文件上传组件上传文件 */
		$File = D('Common/File');
		$file_driver = C('DOWNLOAD_UPLOAD_DRIVER');
		$info = $File->upload(
			$_FILES,
			C('DOWNLOAD_UPLOAD'),
			C('DOWNLOAD_UPLOAD_DRIVER'),
			C("UPLOAD_{$file_driver}_CONFIG")
		);

        /* 记录附件信息 */
        if($info){
            $return['data'] = json_encode($info['download']);
            $return['content'] = $info['download']['name'];
        } else {
            $return['status'] = 0;
            $return['content']   = $File->getError();
        }

        /* 返回JSON数据 */
        if ($is_ajax) {
            # code...
            $this->ajaxReturn($return);
        }else{
            return $return;
        }
    }

    /**
     * 上传图片
     * @author huajie <banhuajie@163.com>
     */
    public function uploadPicture($is_ajax=false){
        //TODO: 用户登录检测

        /* 返回标准数据 */
        $return  = array('status' => 1, 'content' => '上传成功');

        /* 调用文件上传组件上传文件 */
        $Picture = D('Common/Picture');
        $pic_driver = C('PICTURE_UPLOAD_DRIVER');
        $info = $Picture->upload(
            $_FILES,
            C('PICTURE_UPLOAD'),
            C('PICTURE_UPLOAD_DRIVER'),
            C("UPLOAD_{$pic_driver}_CONFIG")
        ); //TODO:上传到远程服务器

        /* 记录图片信息 */
        if($info['photo']['id']>0){
            $return = array_merge($info, $return);
        } else {
            $return['status'] = 0;
            $return['content']   = $Picture->getError();
        }

        /* 返回JSON数据 */

        if ($is_ajax) {
            # code...
            $this->ajaxReturn($return);
        }else{
            return $return;//数组
        }
    }
}
