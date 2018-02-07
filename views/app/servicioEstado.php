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
require_once('../../models/drivers.php');
require_once('../../models/cars.php');
require_once('../../facades/servicesFacade.php');
$consulta = new Services();
$link = '<a href="solicitarServicio"><i class="fa fa-plus"></i>Agregar Nuevo Servicio</a>';
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

    <!-- Responsive Full Block -->
    <div class="block full">
        <!-- All Orders Title -->
        <div class="block-title">
          <!--  <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Configuración"><i class="fa fa-cog"></i></a>
            </div> -->
            <h2><strong>Todos</strong> Los Servicios</h2> <?php if($rol == 1 || $rol == 2|| $rol == 3){ echo $link;} ?>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="javascript:void(0)" onclick="$('#modal-busqueda').modal('show');" id="btn-busqueda"><i class="fa fa-search"></i>Busqueda personalizada</a>
        </div>
        <!-- END All Orders Title -->
        <div class="block-title">
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li class="active"><a href="#espera">En espera</a></li>
                <li><a href="#asignados">Asignados</a></li>
                <li><a href="#finalizados">Finalizados</a></li>
                <li><a href="#sistema">Cancelados sistema</a></li>
                <li><a href="#conductor">Cancelados conductor</a></li>
                <li><a href="#operador">Cancelados operador</a></li>
            </ul>
        </div>
        <div class="tab-content">
          <?php echo listaServicioEsperaFacade(); ?>
          <!--Asignados -->
          <?php echo listaServicioAsignadoFacade(); ?>
          <!--Finalizados-->
          <?php echo listaServicioFinalizadosFacade(); ?>
          <!--Cancelados por el Sistema-->
          <?php echo listaServicioCanceladoSistemaFacade(); ?>
          <!--Cancelados por el conductor-->
          <?php echo listaServicioCanceladoConductorFacade(); ?>
          <!--Cancelados por el operador -->
          <?php echo listaServicioCanceladoOperadorFacade(); ?>
        </div>

<!-- button export PFD -->
<!--<a href="../../reportePdf.php" data-toggle="tooltip" title="pdf" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>-->
</div>
<!-- END All Orders Block -->
</div>
<!-- END Page Content -->
<?php
require_once('../inc/footer.php');?>
<!-- Modal Finalizados -->
<div id="modal-finalizados" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-file-excel-o"></i> Reporte</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="../../controllers/app/reportes/reporteExcelServiciosFinalizadosController.php" method="post" class="form-horizontal form-bordered">
                    <fieldset>
                        <legend>Filtro del reporte</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Seleccione la cantidad de items del reporte</label>
                            <div class="col-md-8">
                              <select type="text" id="filtro_excel_finalizado" name="filtro_excel_finalizado" class="form-control" placeholder="Digite el Nº de documento">
                                <option value="" selected disabled>Seleccione el tipo de filtro del reporte</option>
                                <option value="1">Todos</option>
                                <option value="10">Últimos 10 registros</option>
                                <option value="20">Últimos 20 registros</option>
                                <option value="50">Últimos 50 registros</option>
                                <option value="100">Últimos 100 registros</option>
                                <option value="1000">Últimos 1000 registros</option>
                              </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btn-finalizados" class="btn btn-sm btn-primary">Generar Reporte</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<div id="modal-sistema" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-file-excel-o"></i> Reporte</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="../../controllers/app/reportes/reporteExcelCanceladosSistemaController.php" method="post" class="form-horizontal form-bordered">
                    <fieldset>
                        <legend>Filtro del reporte</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Seleccione la cantidad de items del reporte</label>
                            <div class="col-md-8">
                              <select type="text" id="filtro_excel_sistema" name="filtro_excel_sistema" class="form-control" placeholder="Digite el Nº de documento">
                                <option value="" selected disabled>Seleccione el tipo de filtro del reporte</option>
                                <option value="1">Todos</option>
                                <option value="10">Últimos 10 registros</option>
                                <option value="20">Últimos 20 registros</option>
                                <option value="50">Últimos 50 registros</option>
                                <option value="100">Últimos 100 registros</option>
                                <option value="1000">Últimos 1000 registros</option>
                              </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btn-sistema" class="btn btn-sm btn-primary">Generar Reporte</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>

<div id="modal-conductor" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-file-excel-o"></i> Reporte</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal cancelado conductor -->
            <div class="modal-body">
                <form action="../../controllers/app/reportes/reporteExcelCanceladosConductorController.php" method="post" class="form-horizontal form-bordered">
                    <fieldset>
                        <legend>Filtro del reporte</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Seleccione la cantidad de items del reporte</label>
                            <div class="col-md-8">
                              <select type="text" id="filtro_excel_conductor" name="filtro_excel_conductor" class="form-control" placeholder="Digite el Nº de documento">
                                <option value="" selected disabled>Seleccione el tipo de filtro del reporte</option>
                                <option value="1">Todos</option>
                                <option value="10">Últimos 10 registros</option>
                                <option value="20">Últimos 20 registros</option>
                                <option value="50">Últimos 50 registros</option>
                                <option value="100">Últimos 100 registros</option>
                                <option value="1000">Últimos 1000 registros</option>
                              </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btn-conductor" class="btn btn-sm btn-primary">Generar Reporte</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<div id="modal-operador" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-file-excel-o"></i> Reporte</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal cancelado conductor -->
            <div class="modal-body">
                <form action="../../controllers/app/reportes/reporteExcelCanceladosOperadorController.php" method="post" class="form-horizontal form-bordered">
                    <fieldset>
                        <legend>Filtro del reporte</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Seleccione la cantidad de items del reporte</label>
                            <div class="col-md-8">
                              <select type="text" id="filtro_excel_operador" name="filtro_excel_operador" class="form-control" placeholder="Digite el Nº de documento">
                                <option value="" selected disabled>Seleccione el tipo de filtro del reporte</option>
                                <option value="1">Todos</option>
                                <option value="10">Últimos 10 registros</option>
                                <option value="20">Últimos 20 registros</option>
                                <option value="50">Últimos 50 registros</option>
                                <option value="100">Últimos 100 registros</option>
                                <option value="1000">Últimos 1000 registros</option>
                              </select>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" id="btn-operador" class="btn btn-sm btn-primary">Generar Reporte</button>
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
                <form action="../../controllers/app/vales/buscardorServicioXValesController.php" method="post" class="form-horizontal form-bordered">
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
                                  <option value="car_id">Placa</option>
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
                                <input type="hidden" id="empresa" name="empresa" class="form-control" value="<?php echo $empresa; ?>">
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


<script src="../dis/js/pages/tablesDatatables.js"></script>
<script src="../dis/js/pages/tablaFinalizados.js"></script>
<script>$(function(){ TablesDatatables.init(); });</script>
<script>$(function(){ TablesFinalizados.init(); });</script>
<script>$(function(){ TablesSistema.init(); });</script>
<script>$(function(){ TablesConductor.init(); });</script>
<script>$(function(){ TablesOperador.init(); });</script>
<script type="text/javascript">
$('#btn-finalizados').click(function(e){
  var flecha = $('#filtro_excel_sistema').val();
  if(flecha == undefined){
    flecha = '';
  }
  if (flecha == ''){
    alert('No ha seleccionado ningun filtro');
    return false;
  }
});
  $('#btn-sistema').click(function(e){
    var flecha = $('#filtro_excel_sistema').val();
    if(flecha == undefined){
      flecha = '';
    }
    if (flecha == ''){
      alert('No ha seleccionado ningun filtro');
      return false;
    }
  });
  $('#btn-conductor').click(function(e){
    var flecha = $('#filtro_excel_conductor').val();
    if(flecha == undefined){
      flecha = '';
    }
    if (flecha == ''){
      alert('No ha seleccionado ningun filtro');
      return false;
    }
  });
  $('#btn-operador').click(function(e){
    var flecha = $('#filtro_excel_operador').val();
    if(flecha == undefined){
      flecha = '';
    }
    if (flecha == ''){
      alert('No ha seleccionado ningun filtro');
      return false;
    }
  });
</script>

<!-- Load and execute javascript code used only in this page -->

<!-- <script src="../dis/js/pages/ecomOrders.js"></script>
<script>$(function(){ EcomOrders.init(); });</script>-->
<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->

<?php
require_once('../inc/fin_template.php');
} else{
header("Location: ../mensajes/error_autenticacion.html");
}

?>
