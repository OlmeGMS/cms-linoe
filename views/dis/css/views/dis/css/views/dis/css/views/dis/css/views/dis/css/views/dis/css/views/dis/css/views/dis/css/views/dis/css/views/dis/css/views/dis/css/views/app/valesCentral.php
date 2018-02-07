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
  require_once('../../models/ticketTickets.php');
  require_once('../../models/ticketCompanies.php');
  require_once('../../facades/vales/facade_service.php');
  require_once('../../vendor/dompdf/dompdf_config.inc.php');
  require_once('../../models/ticketCompanies.php');
  require_once('../../facades/vales/facadeTicketCompanies.php');


  $consulta = new TicketTickets();
  $idCc = $_SESSION['id_costCenter'];
  $compania = $_GET['compania'];
  //$mes = $_GET['idmes'];

  $idcompanies = $_SESSION['id_compania'];

  ?>
<!-- Page content -->
<div id="page-content">
    <!-- Table Responsive Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-iphone"></i>Vales<br><small>Aquí podras ver los vales en el sistema!</small>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Tabla</li>
        <li><a href="">Consulta de Vales</a></li>
    </ul>
    <!-- END Table Responsive Header -->
    <!-- Responsive Full Block -->
    <div class="block full">
        <!-- All Orders Title -->
        <div class="block-title">
          <!--  <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Configuración"><i class="fa fa-cog"></i></a>
            </div> -->
            <h2><strong>Todos</strong> Los Vales</h2>&nbsp;&nbsp;<a href="javascript:void(0)" onclick="$('#modal-search-user').modal('show');" id="btn-search-user"><i class="fa fa-search"></i>Busqueda por otra empresa</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="$('#modal-busqueda').modal('show');" id="btn-busqueda"><i class="fa fa-search"></i>Busqueda personalizada</a>
        </div>
        <!-- END All Orders Title -->
<div class="table-responsive remove-margin-bottom">
        <!-- All Orders Content -->
        <table id="table-vales" class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="hidden">ID</th>
                    <th class="text-center">Empresa</th>
                    <th class="text-center">Vale</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Fecha inicio</th>
                    <th class="text-center">Fecha fin</th>
                    <th class="text-center">Gerente</th>
                    <th class="text-center">Dependencia</th>
                      <th class="text-center">Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php echo listValesXCompaniaCentral($compania); ?>
    <!-- END Responsive Full Block -->
  </tbody>
</table>
</div>
<!-- END All Orders Content -->



<!-- button export PFD -->
<!--<div class="form-group">
  <a href="../../controllers/reportePdfServicemesController.php?idmes=<?php echo$mes ?>" data-toggle="tooltip" title="pdf" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>
  <a href="../../controllers/reporteExcelServicemesController.php?idmes=<?php echo$mes ?>" data-toggle="tooltip" title="excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
</div>-->

</div>
<!-- END All Orders Block -->
</div>
<!-- END Page Content -->

    <?php
    require_once('../inc/footer.php');?>
    <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
    <div id="modal-search-user" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <h2 class="modal-title"><i class="fa fa-search"></i> Busqueda</h2>
                </div>
                <!-- END Modal Header -->

                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="../../controllers/app/vales/buscaValesXEmpresaAdmController.php" method="post" class="form-horizontal form-bordered">
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
                            <legend>Item de busqueda</legend>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="user-settings-password">Buscar por</label>
                                <div class="col-md-8">
                                    <select type="text" id="empresa" name="empresa" class="form-control" placeholder="">
                                      <option value="" selected disabled>Seleccione el item de busqueda</option>
                                      <?php echo selectEmpresasTickets(); ?>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" id="rol" name="rol" class="form-control" placeholder="Digite la busqueda" value="<?php echo $rol?>">
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group form-actions">
                            <div class="col-xs-12 text-right">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-sm btn-primary">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Modal Body -->
            </div>
        </div>
    </div>
    <!-- Modal Busqueda-->
    <div id="modal-busqueda" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <h2 class="modal-title"><i class="fa fa-search"></i> Busqueda</h2>
                </div>
                <!-- END Modal Header -->

                <!-- Modal Body -->
                <div class="modal-body">
                    <form action="../../controllers/app/vales/buscardorValesController.php" method="post" class="form-horizontal form-bordered">
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
                            <legend>Item de busqueda</legend>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="user-settings-password">Buscar por</label>
                                <div class="col-md-8">
                                    <select type="text" id="item-busqueda" name="item-busqueda" class="form-control" placeholder="">
                                      <option value="" selected disabled>Seleccione el item de busqueda</option>
                                      <option value="ticket">Nº Vale</option>
                                      <option value="cost_center_id">Gerente</option>
                                      <option value="commit">Dependecia</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label" for="user-settings-repassword">Busqueda</label>
                                <div class="col-md-8">
                                    <input type="text" id="frase" name="frase" class="form-control" placeholder="Digite la busqueda">
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" id="rol" name="rol" class="form-control" placeholder="Digite la busqueda" value="<?php echo $rol?>">
                                </div>
                                <div class="col-md-8">
                                    <input type="hidden" id="empresa" name="empresa" class="form-control" value="<?php echo $compania; ?>">
                                </div>
                            </div>
                        </fieldset>
                        <div class="form-group form-actions">
                            <div class="col-xs-12 text-right">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-sm btn-primary" id="btn-buquedaPerzonalizada" >Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Modal Body -->
            </div>
        </div>
    </div>
    <?php require_once('../inc/script.php');?>

    <script src="../dis/js/pages/tablaVales.js"></script>
    <script>$(function(){ TablesVales.init(); });</script>
    <!-- Load and execute javascript code used only in this page -->
    <script src="js/pages/uiProgress.js"></script>
    <script>$(function(){ UiProgress.init(); });</script>
    <script type="text/javascript">
      $('tr #btn-central').click(function(e){
          e.preventDefault();
          var comp = "Disponible";
          var opcion = confirm('¿Esta seguro de cambiar el estado al vale?');
          if (opcion) {
            var fila = $(this).parent().parent().parent();
            var vale = fila.find('#idVale').text();
            var estadoVale = fila.find('#estadoValeId').text();
            var data = {idvale: vale};
            if(estadoVale == comp){
              $.post("../../controllers/app/vales/cambiarValeCentralController.php", data, function(res, est, jqXHR){

              });
              alert('Se actualizo el vale');
              location.reload();
            }else {
              alert('ERROR: No se pudo actualizar el vale, porque su estado no era disponible');
            }

        }

      });

    </script>
    <script type="text/javascript">

      $('tr #btn-dis').click(function(e){
          e.preventDefault();
          var comp = "Central";
          var opcion = confirm('¿Esta seguro de cambiar el estado al vale?');
          if (opcion) {
            var fila = $(this).parent().parent().parent();
            var vale = fila.find('#idVale').text();
            var estadoVale = fila.find('#estadoValeId').text();
            var data = {idvale: vale};
            if(estadoVale == comp){
              $.post("../../controllers/app/vales/cambiarValeCentralCentalController.php", data, function(res, est, jqXHR){

              });
              alert('Se actualizo el vale');
              location.reload();
            }else {
              alert('ERROR: No se pudo actualizar el vale, porque su estado no era disponible');
            }

        }

      });

    </script>

    <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->

    <?php
    require_once('../inc/fin_template.php');
  } else{
    header("Location: ../mensajes/error_autenticacion.html");
  }
     ?>
