<?php
namespace Api\Model;
use Think\Model;
/**
 * 文章模型
 */
class CategoryModel extends Model{
	/**
	 * 数据表前缀
	 * @var string
	 */
	protected $tablePrefix = UC_TABLE_PREFIX;
	protected $tableName = 'feedback';

	/**
	 * 数据库连接
	 * @var string
	 */
	protected $connection = UC_DB_DSN;
	
	/* 模型自动完成 */
	protected $_auto = array(
		array('add_time', NOW_TIME, self::MODEL_INSERT),
	);
    /*模型自动验证*/
	protected $_validate = array(

    );
}