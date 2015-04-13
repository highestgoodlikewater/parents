<?php

namespace Api\Model;
use Think\Model;
/**
 * 会员模型
 */
class MemberModel extends Model{
	/**
	 * 数据表前缀
	 * @var string
	 */
	protected $tablePrefix = UC_TABLE_PREFIX;

	/**
	 * 数据库连接
	 * @var string
	 */
	protected $connection = UC_DB_DSN;

	/* 用户模型自动验证 */
	protected $_validate = array(
		/* 验证用户名 */
		array('username', '1,30', '用户名长度不合法', self::EXISTS_VALIDATE, 'length'), //用户名长度不合法
		array('username', 'checkDenyMember', '用户名禁止注册', self::EXISTS_VALIDATE, 'callback'), //用户名禁止注册
		array('username', '', '用户名被占用', self::EXISTS_VALIDATE, 'unique'), //用户名被占用

		/* 验证密码 */
		array('password', '6,60', '密码长度不合法', self::EXISTS_VALIDATE, 'length'), //密码长度不合法

		/* 验证邮箱 */
		array('email', 'email', '邮箱格式不正确', self::VALUE_VALIDATE), //邮箱格式不正确
		array('email', '1,32', '邮箱长度不合法', self::VALUE_VALIDATE, 'length'), //邮箱长度不合法
		array('email', 'checkDenyEmail', -7, self::VALUE_VALIDATE, 'callback'), //邮箱禁止注册
		array('email', '','邮箱禁止注册', self::VALUE_VALIDATE, 'unique'), //邮箱被占用

		/* 验证手机号码 */
		array('mobile', '//', '手机格式不正确', self::VALUE_VALIDATE), //手机格式不正确 TODO:
		array('mobile', 'checkDenyMobile', '机禁止注册', self::VALUE_VALIDATE, 'callback'), //手机禁止注册
		array('mobile', '', '手机号被占用', self::VALUE_VALIDATE, 'unique'), //手机号被占用
	);

	/* 用户模型自动完成 */
	protected $_auto = array(
		// array('password', 'md5', self::MODEL_BOTH, 'function'),
		array('reg_time', NOW_TIME, self::MODEL_INSERT),
		array('update_time', NOW_TIME, self::MODEL_BOTH),
		array('reg_ip', 'get_client_ip', self::MODEL_INSERT, 'function', 1),
		array('status', 'getStatus', self::MODEL_INSERT, 'callback'),
	);

	/**
	 * 检测用户名是不是被禁止注册
	 * @param  string $username 用户名
	 * @return boolean          ture - 未禁用，false - 禁止注册
	 */
	protected function checkDenyMember($username){
		return true; //TODO: 暂不限制，下一个版本完善
	}

	/**
	 * 检测邮箱是不是被禁止注册
	 * @param  string $email 邮箱
	 * @return boolean       ture - 未禁用，false - 禁止注册
	 */
	protected function checkDenyEmail($email){
		return true; //TODO: 暂不限制，下一个版本完善
	}

	/**
	 * 检测手机是不是被禁止注册
	 * @param  string $mobile 手机
	 * @return boolean        ture - 未禁用，false - 禁止注册
	 */
	protected function checkDenyMobile($mobile){
		return true; //TODO: 暂不限制，下一个版本完善
	}

	/**
	 * 根据配置指定用户状态
	 * @return integer 用户状态
	 */
	protected function getStatus(){
		return 1; //TODO: 暂不限制，下一个版本完善
	}


	/**
	 * 注册一个新用户
	 * @param  string $username 用户名
	 * @param  string $password 用户密码
	 * @param  string $email    用户邮箱
	 * @param  string $mobile   用户手机号码
	 * @return integer          注册成功-用户信息，注册失败-错误编号
	 */
	public function register($username, $password, $email, $mobile){
		$data = array(
			'username' => $username,
			'password' => md5($password),
			'email'    => $email,
			'mobile'   => $mobile,
		);

		//验证手机
		if(empty($data['mobile'])) unset($data['mobile']);
		if(empty($data['email'])) unset($data['email']);

		/* 添加用户 */
		if($this->create($data)){
			$uid = $this->add();
			$msg['status']= $uid >0? $uid : 0; //0-未知错误，大于0-注册成功
			if ($uid==0) {
				# code...
				$msg['error']='未知错误！';
			}
		} else {
			$msg['status']=-1;
			$msg['error']= $this->getError(); //错误详情见自动验证注释
		}
		return $msg;
	}

	/**
	 * 用户登录认证
	 * @param  string  $username 用户名
	 * @param  string  $password 用户密码
	 * @param  integer $type     用户名类型 （1-用户名，2-邮箱，3-手机，4-UID）
	 * @return integer           登录成功-用户ID，登录失败-错误编号
	 */
	public function login($username, $password, $type = 1){
		$map = array();
		switch ($type) {
			case 1:
				$map['username'] = $username;
				break;
			case 2:
				$map['email'] = $username;
				break;
			case 3:
				$map['mobile'] = $username;
				break;
			case 4:
				$map['uid'] = $username;
				break;
			default:
				return 0; //参数错误
		}

		/* 获取用户数据 */
		$user = $this->where($map)->find();
		if(is_array($user) && $user['status']){
			/* 验证用户密码 */
			if(md5($password) === $user['password']){
				/* 记录登录SESSION和COOKIES */
				return $user['uid']; //登录成功，返回用户ID
			} else {
				return -2; //密码错误
			}
		} else {
			return -1; //用户不存在或被禁用
		}
	}

	/**
	 * 获取用户信息
	 * @param  string  $uid         用户ID或用户名
	 * @param  boolean $is_username 是否使用用户名查询
	 * @return array                用户信息
	 */
	public function info($uid, $is_username = false){
		$map = array();
		if($is_username){ //通过用户名获取
			$map['username'] = $uid;
		} else {
			$map['uid'] = $uid;
		}

		$user = $this->where($map)->field('uid,username,email,mobile,status')->find();
		if(is_array($user) && $user['status'] = 1){
			return array($user['uid'], $user['username'], $user['email'], $user['mobile']);
		} else {
			return -1; //用户不存在或被禁用
		}
	}

		/**
	 * 获取用户信息
	 * @param  string  $uid         用户ID或用户名
	 * @param  boolean $is_username 是否使用用户名查询
	 * @return array                用户信息
	 */
	public function detailInfo($uid,$field='password'){

		$map['uid'] = $uid;

		$user = $this->where($map)->field($field,true)->find();
		if(is_array($user) && $user['status'] = 1){
			return $user;
		} else {
			return -1; //用户不存在或被禁用
		}
	}

	/**
	 * 检测用户信息
	 * @param  string  $field  用户名
	 * @param  integer $type   用户名类型 1-用户名，2-用户邮箱，3-用户电话
	 * @return integer         错误编号
	 */
	public function checkField($field, $type = 1){
		$data = array();
		switch ($type) {
			case 1:
				$data['username'] = $field;
				break;
			case 2:
				$data['email'] = $field;
				break;
			case 3:
				$data['mobile'] = $field;
				break;
			default:
				return 0; //参数错误
		}

		return $this->create($data) ? 1 : $this->getError();
	}

	/**
	 * 更新用户密码（前提知道登陆密码，否则只能找回密码）
	 * @param int $uid 用户id
	 * @param string $password 密码，用来验证
	 * @param array $data 修改的字段数组
	 * @return true 修改成功，false 修改失败
	 * @author huajie <banhuajie@163.com>
	 */
	public function updateUserPasswd($uid, $password,$new_password){
		if(empty($uid) || empty($password) || empty($new_password)){
			$this->error = '参数错误！';
			return false;
		}

		//更新前检查用户密码
		if(!$this->verifyUser($uid, $password)){
			$this->error = '密码不正确！';
			return false;
		}
		$data['password']=md5($new_password);
		//更新用户信息
		$data = $this->create($data);
		if($data){
			return $this->where(array('uid'=>$uid))->save($data);
		}
		return false;
	}
    
    //更改用户信息(登陆后)
    public  function updateUserInfo($uid,$data){
		if(empty($uid) ||empty($data)){
			$this->error = '参数错误！';
			return false;
		}
		if (isset($data['password'])) {
			# code...
			$data['password']=md5($data['password']);
		}

		//更新用户信息
		$data = $this->create($data);
		if($data){
			return $this->where(array('uid'=>$uid))->save($data);
		}
		return false;
    }

    //$field='password'  或 $field='password,字段，字段'，表示除了这几个字段外查询所有
	public function  searchUser($username,$field='password'){
       if (empty($username)) {
       	 $map['username|email|mobile'] = array('like','%'.$username.'%');
       }
       return  $this->where($map)->field($field,true)->select();
	}

	public function deleteUser($id){
        // $id    = array_unique((array)I('id',0));
        $id    = is_array($id) ? implode(',',$id) : $id;
        $where = array_merge( array('id' => array('in', $id )) ,(array)$where );

        return  $this->where($where)->delete();
	}

	/**
	 * 验证用户密码
	 * @param int $uid 用户id
	 * @param string $password_in 密码
	 * @return true 验证成功，false 验证失败
	 * @author huajie <banhuajie@163.com>
	 */
	protected function verifyUser($uid, $password_in){
		$password = $this->getFieldByUid($uid,'password');

		if(md5($password_in) === $password){
			return true;
		}
		return false;
	}



}
