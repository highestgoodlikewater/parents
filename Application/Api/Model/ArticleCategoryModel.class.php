<?php
namespace Api\Model;
use Think\Model\RelationModel;
class ArticleCategoryModel  extends RelationModel{
		/**
	 * 数据表前缀
	 * @var string
	 */
	protected $tablePrefix = UC_TABLE_PREFIX;
	protected $tableName = 'Article';

	/**
	 * 数据库连接
	 * @var string
	 */
	protected $connection = UC_DB_DSN;
    protected $_link = array(
	      'Category' => array(
			    'mapping_type'  => self::HAS_ONE ,
			    'class_name'    => 'Category',
			    'foreign_key'   => 'cate_id',
			    'mapping_order' => 'update_time desc',
		  ),
		  'Member' => array(
			    'mapping_type'  => self::BELONGS_TO ,
			    'class_name'    => 'Member',
			    'foreign_key'   => 'uid',
			    'mapping_fields'=> 'uid,username,photos',
			    'mapping_order' => 'update_time desc',
		  ),
		  'Like' => array(
			    'mapping_type'  => self::HAS_MANY ,
			    'class_name'    => 'Like',
			    'foreign_key'   => 'article_id',
		  ),
		  'Comment' => array(
			    'mapping_type'  => self::HAS_MANY ,
			    'class_name'    => 'Comment',
			    'foreign_key'   => 'article_id',
		  ),
     );
}