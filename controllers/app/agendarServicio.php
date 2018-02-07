<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');
require_once('../../models/services.php');
require_once('../../models/schedule.php');

$consulta = new Services();
$consultaUsers = new Users();
$consultaUserDir = new UsersDirs();
$consultaAgendamiento = new Schedule();

$cancelarSistema = $consultaAgendamiento->cancelarAgendamientoSistemaAutomatico();
if ($cancelarSistema == FALSE) {
  echo "<script> console.log('No realizar el cancelamiento automatico')</script>";
}else {
  $filas = $consultaAgendamiento->obtenerServicios20Minutes();
  if ($filas == 0 || $filas == null) {
    echo "<script> console.log('No hay servicios por agendamiento')</script>";
  }else {
    foreach ($filas as $fila) {
      $idAgendamiento = $fila['id'];
      $usuario = $fila['user_id'];
      $lati = $fila['city_lat'];
      $longi = $fila['city_lng'];
      $dir = $fila['address_index'];
      $nombreDIr = $fila['comp1'];
      $nDos = $fila['comp2'];
      $numm = $fila['no'];
      $barrio = $fila['barrio'];
      $kind_id = 1;
      $nombre = $fila['name_user'];
      $apellido = $fila['lastname_user'];
      $direccion = "$dir $nombreDIr #$nDos-$numm, $barrio";
      $usuarioSistema = 6;
      $pay_type = 1;
      $pay_reference = "EFECTIVO";
      $observaciones = $fila['obs'];
      $destino = $fila['destination'];
      $nombreCompleto = "$nombre $apellido";
      $tel = $consultaUsers->obtenerTelefono($fila['user_id']);
      $celular = $consultaUsers->obtenerCelular($fila['user_id']);


      if ($tel != null) {
          $cuenta = strlen($tel);

          if ($cuenta == '7') {
            $flecha = chunk_split($tel, 3, " ");
            $flecha1 = substr($tel, 0, 2);
            $flecha2 = substr($tel, 3, 2);
            $flecha3 = substr($tel, 5, 3);
            $code = $flecha3;
          }elseif ($cuenta == '10') {
            $flecha = chunk_split($tel, 3, " ");
            $flecha1 = substr($tel, 0, 3);
            $flecha2 = substr($tel, 3, 2);
            $flecha3 = substr($tel, 5, 3);
            $flecha4 = substr($tel, 8, 2);
            $code = $flecha4;
          }
      }else{
        $cuenta = strlen($celular);

        if ($cuenta == '7') {
          $flecha = chunk_split($celular, 3, " ");
          $flecha1 = substr($celular, 0, 2);
          $flecha2 = substr($celular, 3, 2);
          $flecha3 = substr($celular, 5, 3);
          $code = $flecha3;
        }elseif ($cuenta == '10') {
          $flecha = chunk_split($celular, 3, " ");
          $flecha1 = substr($celular, 0, 3);
          $flecha2 = substr($celular, 3, 2);
          $flecha3 = substr($celular, 5, 3);
          $flecha4 = substr($celular, 8, 2);
          $code = $flecha4;
        }
      }

      $mensaje = $consulta->crearServicioEfectivo($usuario, $lati, $longi, $dir, $nombreDIr, $nDos, $numm, $barrio, $observaciones, $kind_id, $destino, $nombreCompleto, $direccion, $usuarioSistema, $pay_type, $pay_reference, $code);
      if ($mensaje == FALSE) {
        echo "<script> console.log('No hay servicios por agendamiento')</script>";
      }else{
        $idServicio = $consulta->obtenerUltimoIdServicio();
        $msj = $consultaAgendamiento->actualizarEstadoAgendamientoServicioCreado($idAgendamiento);
        if ($msj == FALSE) {
          echo "<script> console.log('ERROR: no se pudo actualizar el estado del agendamiento')</script>";
        }else{
          $actualizarAgendamiento = $consultaAgendamiento->AgregarIdServiceAgendamiento($idServicio, $idAgendamiento);
          if ($actualizarAgendamiento == FALSE) {
            echo "<script> console.log('No agregar el id del servicio al agendamiento');</script>";
          }else{
            echo "<script> console.log('se creo un servicio')</script>";
          }

        }

      }

    }
    // FINALIZA EL BUCLE DE CREAR EL SERVICIO POR AGENDAMIENTO

  }
}



 ?>
