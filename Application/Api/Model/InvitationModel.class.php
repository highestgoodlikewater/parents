<?php

namespace Api\Model;
use Think\Model;
/**
 * 分组模型模型
 */
class InvitationModel extends Model{
    /**
     * 数据表前缀
     * @var string
     */
    protected $tablePrefix = UC_TABLE_PREFIX;
    protected $tableName = 'invitation';

    /**
     * 数据库连接
     * @var string
     */
    protected $connection = UC_DB_DSN;


    /* 用户模型自动完成 */
    protected $_auto = array(
        array('add_time', NOW_TIME, self::MODEL_INSERT),
        array('update_time', NOW_TIME, self::MODEL_BOTH),
        array('status', 'getStatus', self::MODEL_INSERT, 'callback'),
        array('from_status', 'getStatus', self::MODEL_INSERT, 'callback'),
        array('to_status', 'getStatus', self::MODEL_INSERT, 'callback'),
    );

    protected function getStatus(){
        return 0; //TODO: 暂不限制，下一个版本完善
    }
    //增加用户组
    public  function  addInvitation($from_uid,$to_uid,$from_remarker=''){

        $data = array(
            'from_uid'        => $from_uid,
            'to_uid'   =>$to_uid,
        );
        if (!empty($from_remarker)) {
            # code...
            $data['from_remarker']=$from_remarker;
        }
         return $this->add($data);
    }

    //array   $data邀请状态及信息修改

    public  function  updateInvitation($id,$data){

        return $this->where(array('id'=>$id))->save($data);
    }
    //删除分组
    public  function deleteInvitation($id){
        // $id    = array_unique((array)I('id',0));
        $id    = is_array($id) ? implode(',',$id) : $id;
        $where = array_merge( array('id' => array('in', $id )) ,(array)$where );
        return $this->delete($where);
    }
    //根据id 获得邀请的信息
    public function  getInvitationInfoById($id=0){

        return $this->where(array('id'=>$id))->find();
    }
     //根据uid 获得邀请信息
    public function  InvitationInfoByUid($uid){
        $map['uid']=$uid;
      return $this->where($uid)->select();
    }



}
