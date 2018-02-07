<?php
require_once('../inc/header.php');
if (isset($_SESSION['nombre'])){
  switch ($rol) {
    case '1':
      require_once('../inc/menu_administrador.php');
      break;
      case '2':
        require_once('../inc/menu_administrador.php');
        break;
        case '3':
          require_once('../inc/menu_operadora.php');
          break;
          case '4':
            require_once('../inc/menu_pagos.php');
            break;
            case '5':
              require_once('../inc/menu_cliente.php');
              break;
              case '6':
                require_once('../inc/menu_ministerio.php');
                break;

    default:
      # code...
      break;
  }
require_once('../inc/cabecera_contenido.php');
require_once('../../models/conexion.php');
require_once('../../models/ticket_users.php');
require_once('../../models/ticketCostCenters.php');
require_once('../../facades/vales/facadeTicketUsers.php');
require_once('../../facades/vales/facadeTicketCostCenters.php');
$consulta = new TicketUsers();
if (isset($_SESSION['idCompania'])) {
  $idCompania = $_SESSION['idCompania'];
}

$idCentroCosto = $_GET['id_cc'];
?>
 <!-- Page content -->
 <div id="page-content">
   <!-- Dashboard Header -->
   <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

   <!-- Mini Top Stats Row -->
   <div class="row">
     <div class="content-header">
       <div class="header-section">
         <h1>
           <i class="fa fa-edit"></i>Modificar Centro de costo<br><small>Complete el siguiente formulario para Modificar el Centro de costo</small>
         </h1>
       </div>
     </div>
     <ul class="breadcrumb breadcrumb-top">
       <li><a href="centroCostos.php">Centro de costo</a></li>
       <li>Modificar Centro de costo</li>
     </ul>
   </div>
   <!-- END Mini Top Stats Row -->

   <!-- Widgets Row -->
   <div class="row">

     <div class="col-md-12">
       <div class="block">
         <div class="block-title">
           <h2><strong>Modificar Usuario</strong></h2>
         </div>
         <?php echo modificarCentroCostofacade($idCentroCosto); ?>
       </div>
     </div>
   </div>
   <!-- END Widgets Row -->
 </div>
 <!-- END Page Content -->





 <?php
 require_once('../inc/footer.php');?>
 <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file -->
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
 <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.2.min.js"%3E%3C/script%3E'));</script>

 <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
 <script src="../dis/js/vendor/bootstrap.min.js"></script>
 <script src="../dis/js/plugins.js"></script>
 <script src="../dis/js/app.js"></script>

 <!-- Load and execute javascript code used only in this page -->
 <script src="../dis/js/pages/formsValidation.js"></script>
 <script>$(function(){ FormsValidation.init(); });</script>



 <?php
 require_once('../inc/fin_template.php');
 } else{
 header("Location: ../mensajes/error_autenticacion.html");
 }



 ?>
