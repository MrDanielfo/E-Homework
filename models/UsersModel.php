<?php


class UsersModel extends Model {

  public function set($user_data = '' ) {
    foreach ($user_data as $key => $value) {
      $$key = $value;
    }

    $this->query = "REPLACE INTO users (user, name, email, cellphone, pass, role) VALUES ('$user', '$name', '$email', '$cellphone', MD5('$pass'), '$role')";

    $this->set_query();
  }

  public function get($user = '' ) {

    $this->query = ($user != '' )
      ? "SELECT * FROM users WHERE user = '$user'"
      : "SELECT * FROM users ORDER BY name ASC";

    $this->get_query();

    $num_rows = count($this->rows);

    $data = array();

    foreach ($this->rows as $key => $value) {
      $data[$key] = $value;
    }

    return $data;

  }

  public function del($user = '' ) {
    $this->query = "DELETE FROM users WHERE user = '$user'";

    $this->set_query();
  }

  public function validate_user($user, $pass) {
    $this->query = "SELECT * FROM users WHERE user = '$user' AND pass = MD5('$pass')";
    $this->get_query();

    $data = array();

    foreach ($this->rows as $key => $value) {
      $data[$key] = $value;
    }

    return $data;
  }


}
