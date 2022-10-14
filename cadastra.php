<?php
$k = '';
$v = '';
foreach ($_POST as $key => $value) {
  //echo "POST parameter '$key' has '$value'";

  echo "POST parameter '$key' has '$value'<br>";
  $k .=  $key . ", ";
  $v .=  $value . ", ";
}

$k .= "data_registro";
$v .= "CURRENT_TIMESTAMP";

$sql = "select * from inscricao_seminario ($k) values($v)"
