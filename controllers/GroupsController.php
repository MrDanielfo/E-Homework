<?php

class GroupsController {

  private $model;

  public function __construct() {
     $this->model = new GroupsModel();
  }

  public function set($group_data = array() ){
      return $this->model->set($group_data);
  }

  public function get($group_id = '' ){
      return $this->model->get($group_id);
  }

  public function del($group_id = '' ) {
      return $this->model->del($group_id);
  }


}
