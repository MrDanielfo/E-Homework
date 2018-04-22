<?php

class SignaturesModel extends Model {

  public function set($signature_data = array() ) {
    foreach ($signature_data as $key => $value) {
      $$key = $value;
    }

    $this->query = "REPLACE INTO signatures (signature_id, signature) VALUES ($signature_id, '$signature')";

    $this->set_query();
  }

  public function get( $signature_id = '' ) {

    $this->query = ($signature_id != '' )
      ? "SELECT * FROM signatures WHERE signature_id = $signature_id"
      : "SELECT * FROM signatures";

    $this->get_query();
    $num_rows = count($this->rows);

    $data = array();

    foreach ($this->rows as $key => $value) {
      $data[$key] = $value;
    }

    return $data;
  }

  public function del($signature_id = '') {
    $this->query = "DELETE FROM signatures WHERE signature_id = $signature_id";

    $this->set_query();
  }


}
