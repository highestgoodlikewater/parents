<?php
namespace Api\Model;
use Think\Model;

/**
 * 积分模型
 */
class ScoreLevelModel extends Model{
	/**
	 * 数据表前缀
	 * @var string
	 */
	protected $tablePrefix = UC_TABLE_PREFIX;
	protected $tableName = 'level';

	/**
	 * 数据库连接
	 * @var string
	 */
	protected $connection = UC_DB_DSN;


	/* 用户模型自动完成 */
	protected $_auto = array(
		array('status', 'getStatus', self::MODEL_BOTH, 'callback'),
	);
	protected function getStatus(){
		return 1; //TODO: 暂不限制，下一个版本完善
	}
    //添加积分等级
	public function addLevel($level_name,$min_score,$max_score,$remark=''){
        $data=array(
             'level_name'=>$level_name,
             'min_score'=>$min_score,
             'max_score'=>$max_score,
             'remark'=>$remark,
        	);
       return  $this->add($data);
	}

	  //更新积分等级信息
	public function updateLevel($id,$level_name,$min_score,$max_score,$remark=''){
        $data=array(
             'level_name'=>$level_name,
             'min_score'=>$min_score,
             'max_score'=>$max_score,
             'remark'=>$remark,
        	);
       return  $this->where(array('id'=>$id))->save($data);
	}

		  //更新积分等级信息
	public function deleteLevel($id){

       return  $this->where(array('id'=>$id))->delete();
	}

			  //更新积分等级信息
	public function getLevelInfo($id){

       return  $this->where(array('id'=>$id))->find();
	}


	//根据分数获取积分等级
	public function getLevelByScore($score){
      $map['min_score']=array('elt',$score);
      $map['min_score']=array('egt',$score);
       return  $this->where($map)->find();
	}
}
