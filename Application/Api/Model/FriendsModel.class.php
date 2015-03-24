<?php

namespace Api\Model;
use Think\Model;
/**
 * 好友模型
 */
class FriendsModel extends Model{
	/**
	 * 数据表前缀
	 * @var string
	 */
	protected $tablePrefix = UC_TABLE_PREFIX;
	protected $tableName = 'friends';

	/**
	 * 数据库连接
	 * @var string
	 */
	protected $connection = UC_DB_DSN;


	/* 用户模型自动完成 */
	protected $_auto = array(
		array('add_time', NOW_TIME, self::MODEL_INSERT),
		array('update_time', NOW_TIME, self::MODEL_BOTH),
		array('status', 'getStatus', self::MODEL_INSERT, 'callback'),
	);
	protected function getStatus(){
		return 1; //TODO: 暂不限制，下一个版本完善
	}

	public  function  addFriend($uid,$friend_uid,$remarker=''){

        $data = array(
			'uid'        => $uid,
			'friend_uid' => $friend_uid,
		);
		if (!empty($remarker)) {
			# code...
			$data['remarker']=$remarker;
		}
		 return $this->add($data);
	}

	public  function  updateFriend($uid,$data){

         $map['uid']=$uid;
		 return $this->where($map)->add($data);
	}

	public  function  deleteFriend($uid,$friend_uid){

        $data = array(
			'uid'        => $uid,
			'friend_uid' => $friend_uid,
		);
		 return $this->where($data)->delete();
	}
}
