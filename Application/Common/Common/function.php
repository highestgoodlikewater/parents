<?php

/**
 * 检测用户是否登录
 * @return bool
 * @author weilanzhuan
 */
function is_login(){
    return session('uid') > 0? true : false;
}