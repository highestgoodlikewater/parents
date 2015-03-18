<?php

namespace Api\Model;
use Think\Model;
/**
 * 会员模型
 */
class LoginLogModel extends Model{
	/**
	 * 数据表前缀
	 * @var string
	 */
	protected $tablePrefix = UC_TABLE_PREFIX;
	protected $tableName = 'login_log';

	/**
	 * 数据库连接
	 * @var string
	 */
	protected $connection = UC_DB_DSN;


	/* 用户模型自动完成 */
	protected $_auto = array(
		array('login_time', NOW_TIME, self::MODEL_INSERT),
		array('login_ip', 'get_client_ip', self::MODEL_INSERT, 'function', 1),
	);

	public  function  writeLog($uid,$username){

        $data = array(
			'uid'        => $uid,
			'username'   =>$username,
			'login_time' => NOW_TIME,
			'login_ip'   => get_client_ip(1),
		);
		 return $this->add($data);
	}



}
