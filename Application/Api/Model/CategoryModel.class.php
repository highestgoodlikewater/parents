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
	protected $tableName = 'category';

	/**
	 * 数据库连接
	 * @var string
	 */
	protected $connection = UC_DB_DSN;
	
	/* 模型自动完成 */
	protected $_auto = array(
		array('add_time', NOW_TIME, self::MODEL_INSERT),
		array('update_time', NOW_TIME, self::MODEL_BOTH),
	);
    /*模型自动验证*/
	protected $_validate = array(
        array('cate_name','require','评论内容不能为空！'),
    );
    //添加分类
    public  function addCategory($data)
    {
    	$res=$this->create($data);
    	if ($res) {
    		return $this->add($data);
    	}
    	return false;
    }
    //删除分类
    public function delCategory($cate_id){
        $cate_id    = is_array($cate_id) ? implode(',',$cate_id) : $cate_id;
        $where = array_merge( array('cate_id' => array('in', $cate_id )) ,(array)$where );
        return  $this->where($where)->delete();

    }
    //获取分类
    public function  getCategoryById($cate_id){
    	if (is_array($cate_id)) {
    		# code...
    		$cate_id=implode(',',$cate_id);
    		$where = array_merge( array('cate_id' => array('in', $cate_id )) ,(array)$where );
    		return $this->where($where)->select();
    	}else{
    		return $this->find($this);
    	}
    }

    public function getCategoryByName($cate_name){
    	 $map['cate_name']=array('LIKE','%'.$cate_name.'%');
         return $this->where($map)->select();
    }

    public function getCategoryAll($status=1){
    	return $this->where(array('status'=>$status))->select();
    }
}