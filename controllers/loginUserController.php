<?php
require_once('../models/conexion.php');
require_once('../models/cmsUsers.php');
require_once('../util/Cifrado.php');

$mensajes = null;
$rol = null;
$idCustomer = null;
$nombreUser = null;

$documento = htmlspecialchars($_POST['login-usuario'], ENT_QUOTES,'UTF-8');
$password = Cifrado($_POST['login-password']);

if(strlen($documento) > 0 && strlen($password) > 0){
  $consulta = new CmsUsers();
  $mensaje = $consulta->login($documento, $password);
  $idCustomer = $consulta->customer_id($documento);
  $rol = $consulta->iniciarSesion($mensaje);
  $nombreUser = $consulta->nombreUsuario($mensaje);
  $role = $consulta->obtenerRoleUsuario($mensaje);
  $compania = $consulta->obtenerCompany($mensaje);
  $costCenet = $consulta->obtenerCentroCosto($mensaje);


  if(isset($_SESSION["login"])){

  }else{
    if (!empty($mensaje)) {
      if (!empty($rol)) {
        switch ($rol) {
          case 1:
             session_start();
              $_SESSION["login"];
              $_SESSION['nombre'] = $nombreUser;
              $_SESSION['idUsuario'] = $mensaje;
              $_SESSION['idRol'] = $rol;
              $_SESSION['idCustomer'] = $idCustomer;
              $_SESSION['role'] = $role;
              $_SESSION['id_compania'] = $compania;
              $_SESSION['id_costCenter'] = $costCenet;

              header("Location: ../views/app/home");
            break;
          case 2:
            session_start();
            $_SESSION["login"];
            $_SESSION['nombre'] = $nombreUser;
            $_SESSION['idUsuario'] = $mensaje;
            $_SESSION['idRol'] = $rol;
            $_SESSION['idCustomer'] = $idCustomer;
            $_SESSION['role'] = $role;
            $_SESSION['id_compania'] = $compania;
            $_SESSION['id_costCenter'] = $costCenet;
              header("Location: ../views/app/home");
              break;
          case 3:
            session_start();
            $_SESSION["login"];
            $_SESSION['nombre'] = $nombreUser;
            $_SESSION['idUsuario'] = $mensaje;
            $_SESSION['idRol'] = $rol;
            $_SESSION['idCustomer'] = $idCustomer;
            $_SESSION['role'] = $role;
            $_SESSION['id_compania'] = $compania;
            $_SESSION['id_costCenter'] = $costCenet;
              header("Location: ../views/app/home");
            break;
          case 4:
            session_start();
            $_SESSION["login"];
            $_SESSION['nombre'] = $nombreUser;
            $_SESSION['idUsuario'] = $mensaje;
            $_SESSION['idRol'] = $rol;
            $_SESSION['idCustomer'] = $idCustomer;
            $_SESSION['role'] = $role;
            $_SESSION['id_compania'] = $compania;
            $_SESSION['id_costCenter'] = $costCenet;
             header("Location: ../views/app/home");
             break;
            case 5:
               session_start();
               $_SESSION["login"];
               $_SESSION['nombre'] = $nombreUser;
               $_SESSION['idUsuario'] = $mensaje;
               $_SESSION['idRol'] = $rol;
               $_SESSION['idCustomer'] = $idCustomer;
               $_SESSION['role'] = $role;
               $_SESSION['id_compania'] = $compania;
               $_SESSION['id_costCenter'] = $costCenet;
                header("Location: ../views/app/home");
            break;
            case 6:
               session_start();
               $_SESSION["login"];
               $_SESSION['nombre'] = $nombreUser;
               $_SESSION['idUsuario'] = $mensaje;
               $_SESSION['idRol'] = $rol;
               $_SESSION['idCustomer'] = $idCustomer;
               $_SESSION['role'] = $role;
               $_SESSION['id_compania'] = $compania;
               $_SESSION['id_costCenter'] = $costCenet;
                header("Location: ../views/app/home");
            break;


          default:
            header("Location: ../views/mensajes/error.html");
            break;
        }
      }else{
           header("Location: ../views/mensajes/error_activacion.html");

      }
    }else{
         header("Location: ../views/error_login.html");
    }
  }


}

?>
