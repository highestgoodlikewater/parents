<?php
namespace Api\Model;
use Think\Model\RelationModel;
class ArticleLikeCommentModel  extends RelationModel{
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