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
  require_once('../../models/services.php');
  require_once('../../models/cmsUsers.php');
  require_once('../../models/ticket_users.php');
  require_once('../../models/ticketCostCenters.php');
  require_once('../../facades/CmsUsersFacades.php');
  require_once('../../facades/vales/facadeTicketUsers.php');

  $consulta = new Services();
  $consultaTicketCostCenter = new TicketCostCenters();

$empresa = $_GET['compania'];
if (isset($_SESSION['idCompania'])) {
  $idCompania = $_SESSION['idCompania'];
}
if (isset($_SESSION["idCc"])) {
  $idCc = $_SESSION["idCc"];
}
?>
<!-- Page content -->
<div id="page-content">
    <!-- Table Responsive Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-iphone"></i>Usuarios Registrados<br><small>Aquí podras ver todos los usuarios registrados en el sistema!</small>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Tabla</li>
        <li><a href="">Consulta de usuarios</a></li>
    </ul>
    <!-- END Table Responsive Header -->

    <!-- Responsive Full Block -->
    <div class="block full">
        <!-- All Orders Title -->
        <div class="block-title">
          <!--  <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Configuración"><i class="fa fa-cog"></i></a>
            </div> -->
            <h2><strong>Todos</strong> Los Usuarios</h2> <a href="crearUsuarioManagerAdm?empresa=<?php echo $empresa ?>"><i class="fa fa-plus"></i>Crear Nuevo Usuario</a>
        </div>
        <!-- END All Orders Title -->

        <!-- All Orders Content -->
        <table id="table-usuarios-app" class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" style="width: 100px;">ID</th>
                    <th class="text-center">Centro de Costo</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Móvil</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php echo listaManagerFacade($empresa); ?>
    <!-- END Responsive Full Block -->
  </tbody>
</table>
<!-- END All Orders Content -->



<!-- button export PFD -->
<!--<a href="../../reportePdf.php" data-toggle="tooltip" title="pdf" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>-->
</div>
<!-- END All Orders Block -->
</div>
<!-- END Page Content -->
<?php
require_once('../inc/footer.php');
require_once('../inc/script.php');?>

<script src="../dis/js/pages/tablaFinalizados.js"></script>
<script>$(function(){ TablesApp.init(); });</script>
<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/uiProgress.js"></script>
<script>$(function(){ UiProgress.init(); });</script>
<!-- <script src="../dis/js/pages/ecomOrders.js"></script>
<script>$(function(){ EcomOrders.init(); });</script>-->
<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->

<?php
require_once('../inc/fin_template.php');
} else{
header("Location: ../mensajes/error_autenticacion.html");
}
 ?>
