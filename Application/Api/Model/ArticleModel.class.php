<?php
namespace Api\Model;
use Think\Model;
/**
 * 文章模型
 */
class ArticleModel extends Model{
	/**
	 * 数据表前缀
	 * @var string
	 */
	protected $tablePrefix = UC_TABLE_PREFIX;
	protected $tableName = 'article';

	/**
	 * 数据库连接
	 * @var string
	 */
	protected $connection = UC_DB_DSN;
	
	/* 模型自动完成 */
	protected $_auto = array(
		array('add_time', NOW_TIME, self::MODEL_INSERT),
		array('update_time', NOW_TIME, self::MODEL_BOTH),
		array('ip', 'get_client_ip', self::MODEL_BOTH, 'function', 1),
	);
    /*模型自动验证*/
	protected $_validate = array(
        array('content','require','内容不能为空！'),
        array('title','require','标题不能为空！'),
    );
    //添加文章
    public function addActicle($data){
       $res=$this->create($data);
       if ($res) {
       	# code...
       	 return $this->add($data);
       }
       return false;
    }

    public function updateArticle($ariticle_id,$data){
       unset($data['uid']);
       return $this->where( array('ariticle_id' => $ariticle_id ))->save($data);
    }

    //删除文章
    public function  delArticle($uid,$ariticle_id){
       $ariticle_id    = is_array($ariticle_id) ? implode(',',$ariticle_id) : $ariticle_id;
        $where = array_merge( array('ariticle_id' => array('in', $ariticle_id ),'uid'=>$uid) ,(array)$where );

        return  $this->where($where)->delete();
    }

    //获取文章
    public function  getArticleById($ariticle_id){
      return $this->where(array('ariticle_id'=>$ariticle_id))->find();
    }

}