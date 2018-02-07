<?php
function password_random($length = 5){

  $charset = 'qwertyuioplkjhgfdsazxcvbnm0123456789%&$/()#!?';
  $password = "";
  for ($i=0; $i < $length ; $i++) {
    $rand = rand() % strlen($charset);
    $password .= substr($charset,$rand,1);
  }
  return $password;
}

 ?>
