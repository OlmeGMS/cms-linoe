<?php

class Conexion{

  public function get_conexion(){

    $user='root';
    $pass='jmnfgt116';
    $db='appsuser_taxisya';
    $host='localhost';

    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    return $conexion;

  }

  public function close_conexion($statement, $conexion){
    global $statement, $conexion;
    $statement->closeCursor();
    $statement = null;
    $conexion = null;
  }



}
 ?>
