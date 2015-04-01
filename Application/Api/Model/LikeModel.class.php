<?php
namespace Api\Model;
use Think\Model;
/**
 * 文章模型
 */
class LikeModel extends Model{
	/**
	 * 数据表前缀
	 * @var string
	 */
	protected $tablePrefix = UC_TABLE_PREFIX;
	protected $tableName = 'like';

	/**
	 * 数据库连接
	 * @var string
	 */
	protected $connection = UC_DB_DSN;
	
	/* 模型自动完成 */
	protected $_auto = array(
		array('add_time', NOW_TIME, self::MODEL_INSERT),
	);
    //点赞
	public  function addLike($uid,$article_id)
	{
		# code...
		$data=array(
          'uid'=>$uid,
          'article_id'=>$article_id,
		);
		return $this->add($data);
	}
	//取消点赞
	public  function delLike($uid,$article_id)
	{
		# code...
		$data=array(
          'uid'=>$uid,
          'article_id'=>$article_id,
		);
		return $this->where($data)->delete();
	}
	//统计点赞数量
	public  function countLike($article_id)
	{
		# code...
		$data=array(
          'article_id'=>$article_id,
		);
		return $this->where($data)->count();
	}

}