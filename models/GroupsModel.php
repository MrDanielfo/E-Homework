<?php

class GroupsModel extends Model {

  public function set($group_data = array() ) {
    foreach ($group_data as $key => $value) {
      $$key = $value;
    }

    $this->query = "REPLACE INTO groups (group_id, group_name ) VALUES ($group_id, '$group_name')";
    $this->set_query();
  }

  public function get($group_id = '' ) {

    $this->query = ($group_id != '')
    ? "SELECT * FROM groups WHERE group_id = $group_id"
    : "SELECT * FROM groups";

    $this->get_query();

    $num_rows = count($this->rows);

    $data = array();

    foreach ($this->rows as $key => $value) {
      $data[$key] = $value;
    }
    return $data;
  }


  public function del($group_id = '') {
    $this->query = "DELETE FROM groups WHERE group_id = $group_id";

    $this->set_query();
  }


}
