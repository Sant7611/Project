<?php
abstract class Common
{
  abstract function save();
  abstract function edit();
  abstract function delete();
  abstract function fetch();

  public function set($key, $value)
  {
    $this->$key = $this->validate($value);
    // $this->$key = $this->$value;
  }

  public function select($sql)
  {
    $conn = mysqli_connect('localhost', 'root', '', 'anidb');
    $var = $conn->query($sql);
    if ($var->num_rows > 0) {
      $row = $var->fetch_assoc();
    }
    return $row;
  }

  public function validate($value)
  {
    $conn = mysqli_connect('localhost', 'root', '', 'anidb');

    if (is_array($value)) {
      $validated_values = array();
      foreach ($value as $val) {
        $validated_values[] = $conn->real_escape_string($val);
      }
      return $validated_values;
    } else {
      return $conn->real_escape_string($value);
    }
  }
}
