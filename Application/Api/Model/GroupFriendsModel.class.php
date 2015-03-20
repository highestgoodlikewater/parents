<?php

namespace Api\Model;
use Think\Model\ViewModel;
/**
*  分组好友
*/
class GroupFriendsModel extends ViewModel{
	public $viewFields = array(
     'Friends'=>array('group_id','friend_uid','remarker'),
     'Member'=>array('username', '_on'=>'Friends.friend_uid=Member.uid'),
   );
}