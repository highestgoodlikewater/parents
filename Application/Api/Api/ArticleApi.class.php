<?php


namespace Api\Api;
use Api\Api\Api;
use Api\Model\ArticleModel;
use Api\Model\LikeModel;
use Api\Model\CommentModel;
use Api\Model\CategoryModel;
use Api\Model\ArticleCategoryModel;
use Api\Model\MemberCommentModel;
use Api\Model\ArticleLikeCommentModel;
class ArticleApi extends Api{
    /**
     * 构造方法，实例化操作模型
     */
    protected function _init(){
        $this->model = new ArticleModel();
        $this->like_model = new LikeModel();
        $this->comment_model = new CommentModel();
        $this->category_model=new CategoryModel();
        $this->article_category_model=new ArticleCategoryModel();
        $this->member_comment_model=new MemberCommentModel();
        $this->article_like_comment_model=new ArticleLikeCommentModel();
    }
    //添加文章
    public function addActicle($data){
       return $this->model->addActicle($data);
    }
     //更新文章
    public function updateActicle($article_id,$data){
        return $this->model->updateActicle($article_id,$data);
    }
    //删除文章
    public function delActicle($article_id){
        return $this->article_like_comment_model->relation(true)->delete($article_id);
    }
    //点赞
    public function addLike($uid,$article_id){
       return $this->like_model->addLike($uid,$article_id);
    }
    //取消点赞
    public function delLike($uid,$article_id){
        return $this->like_model->delLike($uid,$article_id);
    }
    //点赞统计
    public function countLike($article_id){
        return $this->like_model->delLike($uid,$article_id);
    }

    //添加评论
    public function addComment($uid,$data){
       return $this->comment_model->addComment($uid,$data);
    }
    //删除评论
    public function delComment($comment_id){
        return $this->comment_model->delComment($comment_id);
    }
    //查询分类
    public function getCategoryByName($cate_name){
        return $this->category_model->getCategoryByName($cate_name);
    }

    //查询所有分类
    public function getCategoryAll(){
        return $this->category_model->getCategoryAll();
    }
     //获取指定文章所以信息
    public function getArticleAllInfo($article_id){
       $res= $this->article_category_model->where(array('article_id'=>$article_id))->relation(true)->find();
       unset($res['Comment']);
       $commets=$this->member_comment_model->where(array('article_id'=>$article_id))->select();
       $res['Comment']=$commets;
       return $res;
    }

    //获取指定文章所以信息
    public function getArticleList($map,$page=1,$page_count=10,$use_page=true){
        if ($use_page==false) {
             return $this->article_category_model->where($map)->relation(true)->select();
        }else{
             return $this->article_category_model->where($map)->page($page.','.$page_count)->relation(true)->select();
        }
    }

}
