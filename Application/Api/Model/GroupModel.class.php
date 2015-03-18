<?php

namespace Api\Model;
use Think\Model;
/**
 * 分组模型模型
 */
class GroupModel extends Model{
	/**
	 * 数据表前缀
	 * @var string
	 */
	protected $tablePrefix = UC_TABLE_PREFIX;
	protected $tableName = 'group';

	/**
	 * 数据库连接
	 * @var string
	 */
	protected $connection = UC_DB_DSN;


	/* 用户模型自动完成 */
	protected $_auto = array(
		array('create_time', NOW_TIME, self::MODEL_INSERT),
		array('create_ip', 'get_client_ip', self::MODEL_INSERT, 'function', 1),
		array('update_ip', 'get_client_ip', self::MODEL_BOTH, 'function', 1),
		array('status', 'getStatus', self::MODEL_BOTH, 'callback'),
	);

	protected function getStatus(){
		return 1; //TODO: 暂不限制，下一个版本完善
	}
    //增加用户组
	public  function  addGroup($uid,$group_name,$remarker=''){

        $data = array(
			'uid'        => $uid,
			'group_name'   =>$group_name,
			'create_time' => NOW_TIME,
			'create_ip'   => get_client_ip(1),
			'update_ip'   => get_client_ip(1),
		);
		if (!empty($remarker)) {
			# code...
			$data['remarker']=$remarker;
		}
		 return $this->add($data);
	}

	//修改用户组
	public  function  updateGroup($id,$group_name,$remarker=''){

        $data = array(
			'group_name'   =>$group_name,
			'create_time' => NOW_TIME,
			'update_ip'   => get_client_ip(1),
		);
		if (!empty($remarker)) {
			# code...
			$data['remarker']=$remarker;
		}
		return $this->where(array('id'=>$id))->save($data);
	}
    //删除分组
	public  function deleteGroup($id){
		$ids=is_array($id)?implode(',', $id):$id;
        return $this->delete($ids);
	}
    //根据group_id 获得分组的信息
	public function  getGroupInfo($group_id){
      return $this->find($group_id);
	}
     //根据uid 获得属于自己的分组
	public function  getGroupsByuid($uid){
		$map['uid']=$uid;
      return $this->where($uid)->select();
	}



}
