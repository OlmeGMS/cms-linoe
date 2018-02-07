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
require_once('../../facades/vales/facadeTicketUsers.php');
require_once('../../facades/CmsUsersFacades.php');
$consulta = new TicketUsers();

$idUsarioReport = $_GET['id_reporter'];
$idTabla = $_GET['id_rep'];


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
          <i class="fa fa-edit"></i>Modificar Usuario<br><small>Complete el siguiente formulario para Modificar el Usuario</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="usuarioReport.php">Usuario</a></li>
      <li>Modificar Usuarioa</li>
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
        <?php echo modificarUsuarioReportCmsFacade($idUsarioReport, $idTabla); ?>
      </div>
    </div>
  </div>
  <!-- END Widgets Row -->
</div>
<!-- END Page Content -->





<?php
require_once('../inc/footer.php');
require_once('../inc/script.php');?>





<?php
require_once('../inc/fin_template.php');
} else{
header("Location: ../mensajes/error_autenticacion.html");
}



?>
