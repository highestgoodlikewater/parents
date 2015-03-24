<?php
namespace Api\Model;
use Think\Model\RelationModel;
class FriendsMemberModel  extends RelationModel{
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
    protected $_link = array(
	      'Member' => array(
			    'mapping_type'  => self::BELONGS_TO,
			    'class_name'    => 'Member',
			    'foreign_key'   => 'friend_uid',
			    'mapping_name'      =>  'Friends',
			    'mapping_fields'=> 'username,email,mobile,income,job,sex,birthday,score,qq,home_district,live_district,relation_tags,photos,status',
			    'mapping_order' => 'update_time desc',
		  ),
     );
}