<?php

class SignaturesController {
  private $model;

  public function __construct() {
    $this->model = new SignaturesModel();
  }

  public function set($signature_data = array() ){
    return $this->model->set($signature_data);
  }

  public function get($signature_id = '' ) {
    return $this->model->get($signature_id);
  }

  public function del($signature_id = '' ) {
    return $this->model->del($signature_id);
  }

}
