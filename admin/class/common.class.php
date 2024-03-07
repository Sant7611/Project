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
      return $row;
    }
  }

  public function customArrayDiff($array1, $array2, $strict = false)
  {
    $diff = array();

    foreach ($array1 as $value1) {
      $found = false;

      foreach ($array2 as $value2) {
        if ($strict ? $value1 === $value2 : $value1 == $value2) {
          $found = true;
          break;
        }
      }

      if (!$found) {
        $diff[] = $value1;
      }
    }

    return $diff;
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
