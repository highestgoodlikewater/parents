<?php


namespace Api\Api;
use Api\Api\Api;
use Api\Model\ScoreLevelModel;


class FriendsApi extends Api{
    /**
     * 构造方法，实例化操作模型
     */
    protected function _init(){
        $this->model = new ScoreLevelModel();
    }

    public function addLevel($level_name,$min_score,$max_score,$remark=''){
        return $this->model->addLevel($level_name,$min_score,$max_score,$remark);
    }

    public function updateLevel($id,$level_name,$min_score,$max_score,$remark=''){
        return $this->model->updateLevel($id,$level_name,$min_score,$max_score,$remark='');
    }

    public function deleteLevel($id){
        return $this->model->deleteLevel($id);
    }

    public function getLevelInfo($id){
        return $this->model->getLevelInfo($id);
    }

    public function getLevelByScore($score){
        return $this->model->getLevelByScore($score);
    }

}
