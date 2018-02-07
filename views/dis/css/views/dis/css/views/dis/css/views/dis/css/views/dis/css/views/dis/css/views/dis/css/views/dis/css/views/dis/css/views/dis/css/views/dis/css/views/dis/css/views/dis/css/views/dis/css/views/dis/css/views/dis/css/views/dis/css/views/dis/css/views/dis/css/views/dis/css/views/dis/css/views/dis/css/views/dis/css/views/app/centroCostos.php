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
require_once('../../models/ticketCostCenters.php');
require_once('../../models/ticketCompanies.php');
require_once('../../facades/vales/facadeTicketCostCenters.php');

if(isset($_SESSION['idCompania'])){
  $idCompania = $_SESSION['idCompania'];
}

setlocale(LC_MONETARY, 'us_US');

$consulta = new TicketCostCenters();
$consultaTicketCompanies = new TicketCompanies();
$presupuesto = money_format('%i',$consultaTicketCompanies->obtenerPresupuestoAdm($idCompania));
$facturado = money_format('%i',$consultaTicketCompanies->obtenerFacturadoAdm($idCompania));
$usado = money_format('%i',$consultaTicketCompanies->obtenerUsadoAdm($idCompania));
$disponible = money_format('%i',($presupuesto - $facturado - $usado));
?>
<!-- Page content -->
<div id="page-content">
    <!-- Table Responsive Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-iphone"></i>Centros de Costo Registrados<br><small>Aquí podras ver todos los usuarios registrados en el sistema!</small>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Tabla</li>
        <li><a href="">Consulta Centros de Costo</a></li>
    </ul>
    <!-- END Table Responsive Header -->

    <!-- Responsive Full Block -->
    <div class="block full">
        <!-- All Orders Title -->
        <div class="block-title">
          <!--  <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Configuración"><i class="fa fa-cog"></i></a>
            </div> -->
            <h2><strong>Todos</strong> Los Centros de Costo</h2> <a href="crearCentrosCosto.php"><i class="fa fa-plus"></i>Crear Nuevo Centros de Costo</a>&nbsp;&nbsp;&nbsp;&nbsp;
            <span>Presupuesto Administracion = <i class="label label-info">$<?php echo $presupuesto ?></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span>Facturado = <i class="label " style="background: #059aaf;">$<?php echo $facturado?></i></span>&nbsp;&nbsp;&nbsp;&nbsp;
            <span>Sin Facturar = <i class="label label-warning">$<?php echo $usado ?></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span>Disponible = <i class="label label-success">$<?php echo $disponible ?></i></span>
        </div>
        <!-- END All Orders Title -->

        <!-- All Orders Content -->
        <div class="table-responsive">
        <table id="ecom-orders" class="table table-vcenter table-condensed table-bordered">
            <thead>
                <tr>
                    <th class="text-center" style="width: 100px;">ID</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Prefijo</th>
                    <th class="text-center">Presupuesto</th>
                    <th class="text-center">Facturado</th>
                    <th class="text-center">Usado</th>
                    <th class="text-center">Disponible</th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>
            <tbody>

                <?php echo listaCentrosCostosFacade($idCompania); ?>
    <!-- END Responsive Full Block -->
  </tbody>
</table>
<!-- END All Orders Content -->



<!-- button export PFD -->
<!--<a href="../../reportePdf.php" data-toggle="tooltip" title="pdf" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>-->
</div>
</div>


<!-- END All Orders Block -->
</div>
<!-- END Page Content -->

    <?php
    require_once('../inc/footer.php');
    ?>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.2.min.js"%3E%3C/script%3E'));</script>

    <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/app.js"></script>

    <!-- Load and execute javascript code used only in this page -->
    <script src="js/pages/tablesDatatables.js"></script>
    <script>$(function(){ TablesDatatables.init(); });</script>
    <!-- <script src="../dis/js/pages/ecomOrders.js"></script>
    <script>$(function(){ EcomOrders.init(); });</script>-->
    <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
    <div id="modal-curso" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <h2 class="modal-title"><i class="fa fa-pencil"></i> Configuración</h2>
                </div>
                <!-- END Modal Header -->

                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="../../Controllers/CambiarContrasenaController.php" method="post" class="form-horizontal form-bordered">
                        <fieldset>
                            <legend>Información</legend>
                            <div class="form-group">
                                <label class="col-md-4 control-label">Usuario</label>
                                <div class="col-md-8">
                                    <p class="form-control-static"><?php echo $nombre ?></p>

                                </div>
                            </div>

                        </fieldset>
                        <fieldset>
                            <legend>Actualizar Password</legend>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="user-settings-password">Nuevo Password</label>
                                <div class="col-md-8">
                                    <input type="hidden" id="idUsuario" name="idUsuario" class="form-control" value="<?php echo $idUsuario ?>">
                                    <input type="password" id="user-settings-password" name="user-settings-password" class="form-control" placeholder="Por favor digite su nuevo password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="user-settings-repassword">Confirmar Nuevo Password</label>
                                <div class="col-md-8">
                                    <input type="password" id="user-settings-repassword" name="user-settings-repassword" class="form-control" placeholder="Confirme por favor su nuevo password">
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group form-actions">
                            <div class="col-xs-12 text-right">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-sm btn-primary">Guardar Cambio</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Modal Body -->
            </div>
        </div>
    </div>
    <!-- END User Settings -->
    <?php
    require_once('../inc/footer.php');
    ?>
    <!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>!window.jQuery && document.write(decodeURI('%3Cscript src="../dis/js/vendor/jquery-1.11.2.min.js"%3E%3C/script%3E'));</script>

    <!-- Bootstrap.js, Jquery plugins and Custom JS code -->
    <script src="../dis/js/vendor/bootstrap.min.js"></script>
    <script src="../dis/js/plugins.js"></script>
    <script src="../dis/js/app.js"></script>

    <!-- Load and execute javascript code used only in this page -->
    <script src="../dis/js/pages/ecomOrders.js"></script>
    <script>$(function(){ EcomOrders.init(); });</script>






<?php
require_once('../inc/fin_template.php');
} else{
  header("Location: ../mensajes/error_autenticacion.html");
}



 ?>
