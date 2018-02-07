<?php
class Parameters{

  public function listaParameters(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerKm(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters where id = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPrecioKm(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 1";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerKmCalidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters where id = 2";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPrecioKmCalidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 2";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerBanderazo(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters where id = 3";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPrecioBanderazo(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 3";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerBanderazoCalidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters where id = 4";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPrecioBanderazoCalidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 4";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerAeropuerto(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters where id = 5";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPrecioAeropuerto(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 5";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerAeropuertoCalidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters where id = 6";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPrecioAeropuertoCalidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 6";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerNocturno(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters where id = 7";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPrecioNocturno(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 7";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerNocturnoCalidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters where id = 8";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPrecioNocturnoCalidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 8";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerMinima(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters where id = 9";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPrecioMinima(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 9";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerMinimaCalidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters where id = 10";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPrecioMinimaCalidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 10";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPP(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters where id = 11";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPrecioPP(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 11";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPPCalidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select * from parameters where id = 12";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    while ($result = $statement->fetch()) {
      $rows[] = $result;
    }
    return $rows;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function obtenerPrecioPPCalidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 12";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function horaAcutal(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select time(now())";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $hora = $statement->fetchColumn();
    return $hora;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function fechaAcutal(){

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select now()";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $fecha = $statement->fetchColumn();
    return $fecha;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function CalcularHoraSumada($hora_ingreso, $horaActual) {
       $jornal = $horaActual;
       $hora_ingreso=split(":",$hora_ingreso);
       $jornal=split(":",$jornal);
       $horas=(int)$hora_ingreso[0]+(int)$jornal[0];
       $minutos=(int)$hora_ingreso[1]+(int)$jornal[1];
       $horas+=(int)($minutos/60);
       $minutos=$minutos%60;
       if($minutos<10)$minutos="0".$minutos ;
       return $hora_salida = $horas.":".$minutos;;
  }

  public function RestarHoras($horaini,$horafin){

    $horai=substr($horaini,0,2);
  	$mini=substr($horaini,3,2);
  	$segi=substr($horaini,6,2);

  	$horaf=substr($horafin,0,2);
  	$minf=substr($horafin,3,2);
  	$segf=substr($horafin,6,2);

  	$ini=((($horai*60)*60)+($mini*60)+$segi);
  	$fin=((($horaf*60)*60)+($minf*60)+$segf);

  	$dif=$fin-$ini;

  	$difh=floor($dif/3600);
  	$difm=floor(($dif-($difh*3600))/60);
  	$difs=$dif-($difm*60)-($difh*3600);
  	return date("H:i:s",mktime($difh,$difm,$difs));
}

  public function hourIsBetween($from, $to, $input) {
    $dateFrom = DateTime::createFromFormat('!H:i', $from);
    $dateTo = DateTime::createFromFormat('!H:i', $to);
    $dateInput = DateTime::createFromFormat('!H:i', $input);
    if ($dateFrom > $dateTo) $dateTo->modify('+1 day');
    return ($dateFrom <= $dateInput && $dateInput <= $dateTo) || ($dateFrom <= $dateInput->modify('+1 day') && $dateInput <= $dateTo);
  }

  public function obtnerPrecioUnidad(){
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    $sql = "select price from parameters where id = 13";
    $statement = $conexion->prepare($sql);
    $statement->execute();
    $precio = $statement->fetchColumn();
    return $precio;
    $conexion = $modelo->close_conexion($statement, $conexion);
  }

  public function limpia_espacios($cadena){
	$cadena = str_replace(' ', '', $cadena);
	return $cadena;
}





}
 ?>
