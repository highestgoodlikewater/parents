<?php
	/**
	 * 系统非常规MD5加密方法
	 * @param  string $str 要加密的字符串
	 * @return string 
	 */
	function parents_md5($str, $key = 'Parents'){
		return '' === $str ? '' : md5(sha1($str) . $key);
	}

function think_ucenter_md5($str, $key = 'ThinkUCenter'){
	return '' === $str ? '' : md5(sha1($str) . $key);
}