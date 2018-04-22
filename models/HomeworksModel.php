<?php

class HomeworksModel extends Model {

  public function set($homework_data = array() ) {
    foreach ($homework_data as $key => $value) {
      $$key = $value;
    }

    $this->query = "REPLACE INTO homework SET hw_id = '$hw_id', title = '$title', signature = $signature, priority = '$priority', status = $status, to_finish = '$to_finish',  group_name = $group_name, description = '$description'";

    $this->set_query();
  }

  public function get( $hw_id = '' ) {

    $this->query = ($hw_id != '' )
      ? "SELECT h.hw_id, h.title, sg.signature, h.priority, st.status, h.to_finish, g.group_name, h.description FROM homework AS h INNER JOIN signatures AS sg ON h.signature = sg.signature_id INNER JOIN status AS st ON h.status = st.status_id INNER JOIN groups AS g ON h.group_name = g.group_id   WHERE h.hw_id = '$hw_id'"
      : "SELECT h.hw_id, h.title, sg.signature, h.priority, st.status, h.to_finish, g.group_name, h.description FROM homework AS h INNER JOIN signatures AS sg ON h.signature = sg.signature_id INNER JOIN status AS st ON h.status = st.status_id INNER JOIN groups AS g ON h.group_name = g.group_id";

    $this->get_query();
    $num_rows = count($this->rows);

    $data = array();

    foreach ($this->rows as $key => $value) {
      $data[$key] = $value;
    }

    return $data;
  }

  public function del($hw_id = '') {
    $this->query = "DELETE FROM homework WHERE hw_id = '$hw_id'";

    $this->set_query();
  }


}
