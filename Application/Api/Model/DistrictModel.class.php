<?php
namespace Api\Model;
use Think\Model;
/**
 * 地区模型
 */
class DistrictModel extends Model{
	/**
	 * 数据表前缀
	 * @var string
	 */
	protected $tablePrefix = UC_TABLE_PREFIX;
	protected $tableName = 'district';

	/**
	 * 数据库连接
	 * @var string
	 */
	protected $connection = UC_DB_DSN;

    //获取地区列表
	public  function getDistrictList($upid=0,$level=1)
	{
		# code...
		$map['upid']=$upid;
		$map['level']=$level;
		return $this->where($map)->select();
	}

	 //获取地区信息
	public  function getDistrictInfoById($id)
	{
		# code...
		$map['id']=$id;
		return $this->where($map)->find();
	}
}