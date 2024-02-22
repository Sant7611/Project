<?php
abstract class Common{
  abstract function save();
  abstract function edit();
      abstract function delete();
      abstract function fetch();

      public function set($key, $value){
        $this->$key = $this->validate($value);
      }

      public function select($sql){
        $conn = mysqli_connect('localhost', 'root', '', 'anidb');
        $var = $conn->query($sql);
        if($var->num_rows > 0){
            $row = $var->fetch_assoc();
        }
        return $row;
      }

      public function validate($value){
        $val = htmlspecialchars($value);
        $conn = mysqli_connect('localhost', 'root', '','anidb');
        $validate = $conn->real_escape_string($val);
        return $validate;
      }
}

?>