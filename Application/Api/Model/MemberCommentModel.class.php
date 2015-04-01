<?php
namespace Api\Model;
use Think\Model\ViewModel;
class MemberCommentModel  extends ViewModel{
  public $viewFields = array(
     'Comment'=>array('comment_id','article_id','uid','comment_pid','comment_content','add_time','status','comment_pic'),
     'Member'=>array('username','photos', '_on'=>'Comment.uid=Member.uid'),
   ); 
}