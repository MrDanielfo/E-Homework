<?php

class HomeworksController {
  private $model;

  public function __construct() {
    $this->model = new HomeworksModel();
  }

  public function set($homework_data = array() ){
    return $this->model->set($homework_data);
  }

  public function get($hw_id = '' ) {
    return $this->model->get($hw_id);
  }

  public function del($hw_id = '' ) {
    return $this->model->del($hw_id);
  }

}
