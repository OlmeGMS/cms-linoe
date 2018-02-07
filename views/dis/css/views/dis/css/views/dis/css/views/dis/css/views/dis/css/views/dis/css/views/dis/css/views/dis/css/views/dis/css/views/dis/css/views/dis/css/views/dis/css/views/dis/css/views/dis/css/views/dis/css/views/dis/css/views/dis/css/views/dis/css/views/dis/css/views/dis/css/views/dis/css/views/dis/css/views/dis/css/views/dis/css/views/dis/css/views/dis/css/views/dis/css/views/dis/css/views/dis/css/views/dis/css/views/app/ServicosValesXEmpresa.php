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
  require_once('../../models/ticketCostCenters.php');
  require_once('../../facades/servicesFacade.php');
  require_once('../../facades/vales/facadeTicketCostCenters.php');
  require_once('../../vendor/dompdf/dompdf_config.inc.php');


  $consulta = new Services();
  //$consultaTicketCostCenter = new TicketCostCenters();
  if($idCompania != 0){
    $empresa = $idCompania;
  }else {
    $empresa = $_GET['empresa'];
  }

  if (isset($_GET['year'])) {
    $year = $_GET['year'];
  }else {
    $year = date('Y');
  }

  if (isset($_GET['mes'])) {
    $mes = $_GET['mes'];
  }else {
    $mes = date('m');
  }



   ?>
<!-- Page content -->
<div id="page-content">
    <!-- Table Responsive Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-iphone"></i>Servicios Registrados<br><small>Aquí podras ver todos los servicios registrados en el sistema!</small>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Tabla</li>
        <li><a href="">Consulta de los servicios</a></li>
    </ul>
    <!-- END Table Responsive Header -->
    <div class="row">

      <div class="col-md-12">
        <div class="block">
          <div class="block-title">
            <h2><strong>Buscar por mes</strong></h2>
          </div>
        <div class="form-group">
          <form id="form-validation" class="form-horizontal form-bordered" action="../../controllers/app/vales/servicesXMesController.php" method="post">

            <div class="form-group">
              <div class="col-md-12 control-label">
                <label class="col-md-4 control-label" for="mes">Año</label>
                <div class="col-md-4">
                <select class="form-control" name="year" id="year">
                  <option value=""disabled selected>Seleccione el año</option>;
                  <?php
                    echo aniosContrato();
                  ?>
                </select>
              </div>
              </div>
            </div>

              <div class="col-md-12 control-label">
                <div class="col-md-4">
                <input type="hidden" name="id_empresa" value="<?php echo $empresa; ?>">
              </div>
              </div>


            <div class="form-group">
              <div class="col-md-12 control-label">
                <label class="col-md-4 control-label" for="mes">Mes</label>
                <div class="col-md-4">
                <select class="form-control" name="mes" id="mes">
                  <option value=""disabled selected>Seleccione Mes</option>;
                  <option value="1">Enero</option>
                  <option value="2">Febrero</option>
                  <option value="3">Marzo</option>
                  <option value="4">Abril</option>
                  <option value="5">Mayo</option>
                  <option value="6">Junio</option>
                  <option value="7">Julio</option>
                  <option value="8">Agosto</option>
                  <option value="9">Septiembre</option>
                  <option value="10">Octubre</option>
                  <option value="11">Noviembre</option>
                  <option value="12">Diciembre</option>
                </select>
              </div>
              </div>
            </div>
            <?php

            if($rol == 1 || $rol == 2){
              echo selectListaCentroCostosXIdCompania($empresa);
            }

            ?>

              <div class="form-group ">
                <div class="col-md-8 col-md-offset-4">
                  <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i>Buscar</button>
                  <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
                </div>
              </div>
          </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Responsive Full Block -->
    <div class="block full">
        <!-- All Orders Title -->
        <div class="block-title">
          <!--  <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Configuración"><i class="fa fa-cog"></i></a>
            </div> -->
            <h2><strong>Todos</strong> Los servicios</h2>
        </div>
        <!-- END All Orders Title -->

        <!-- All Orders Content -->
        <div class="table-responsive remove-margin-bottom">
        <table id="ecom-orders" class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center">Vale</th>
                    <th class="text-center">Fecha inicio</th>
                    <th class="text-center">Fecha fin</th>
                    <th class="text-center">Usuario</th>
                    <th class="text-center">Placa</th>
                    <th class="text-center">Dirección</th>
                    <th class="text-center">Unt</th>
                    <th class="text-center">Aer</th>
                    <th class="text-center">Noct</th>
                    <th class="text-center">PP</th>
                    <th class="text-center">Valor</th>
                    <th class="text-center">Motivo</th>
                    <th class="text-center">Destino</th>
                    <th class="text-center">Calificación</th>

                </tr>
            </thead>
            <tbody>
                <?php
                    if($role == 'admin'){
                      echo listServices($empresa);
                      //echo listServicesManagerMes($empresa, $mes, $year);
                    }elseif ($role == 'manager') {
                      echo listServicesManagerMes($idCentroCostos, $mes, $year);
                    }elseif ($role == 'report') {
                      echo listServicesManagerMes($idCentroCostos, $mes, $year);
                    }
                ?>
    <!-- END Responsive Full Block -->
  </tbody>
</table>
</div>
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
    <script>
      $(document).ready(function(){
        $('tr #Eliminar_Curso').click(function(e){
          e.preventDefault();
          var opcion = confirm("Desea Eliminar");
          if(opcion){
            var fila = $(this).parent().parent().parent();
            var curso = fila.find('#idcurso').text();
            var data = {idCurso: curso};
            $.post("../../Controllers/CursoEliminarController.php", data, function (res, est, jqXHR){
                alert('Se Elimino el curso');
                fila.remove();
            });

          }

        });
      });
    </script>

    <script src="../dis/js/administracion.js"></script>
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
    require_once('../inc/script.php');?>
    <script src="../dis/js/paneladministracion.js"></script>
    <script src="../dis/js/pages/ecomOrders.js"></script>
    <script>$(function(){ EcomOrders.init(); });</script>



    <?php
    require_once('../inc/fin_template.php');
  } else{
    header("Location: ../mensajes/error_autenticacion.html");
  }
     ?>
