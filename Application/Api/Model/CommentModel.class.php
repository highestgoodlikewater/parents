<?php
namespace Api\Model;
use Think\Model;
/**
 * 文章模型
 */
class CommentModel extends Model{
	/**
	 * 数据表前缀
	 * @var string
	 */
	protected $tablePrefix = UC_TABLE_PREFIX;
	protected $tableName = 'comment';

	/**
	 * 数据库连接
	 * @var string
	 */
	protected $connection = UC_DB_DSN;
	
	/* 模型自动完成 */
	protected $_auto = array(
		array('add_time', NOW_TIME, self::MODEL_INSERT),
		array('ip', 'get_client_ip', self::MODEL_BOTH, 'function', 1),
	);
    /*模型自动验证*/
	protected $_validate = array(
        array('comment_content','require','评论内容不能为空！'),
    );
    //添加评论
    public function addComment($uid,$data){
        $data['uid']=$uid;
        $res = $this->create($data);
    	if($res){
           return $this->add($data);
    	}
    	return false;
    }
    //删除评论
    public  function delComment($comment_id){
        $comment_id    = is_array($comment_id) ? implode(',',$comment_id) : $comment_id;
         $map['comment_id|comment_pid']= array('in', $comment_id );
        return  $this->where($where)->delete();
    }

}