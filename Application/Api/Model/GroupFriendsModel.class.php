<?php

namespace Api\Model;
use Think\Model\ViewModel;
class GroupFriendsModel extends ViewModel{
	public $viewFields = array(
     'Friends'=>array('group_id','friend_uid'),
     'Member'=>array('username', '_on'=>'Friends.friend_uid=Member.uid'),
   );
}