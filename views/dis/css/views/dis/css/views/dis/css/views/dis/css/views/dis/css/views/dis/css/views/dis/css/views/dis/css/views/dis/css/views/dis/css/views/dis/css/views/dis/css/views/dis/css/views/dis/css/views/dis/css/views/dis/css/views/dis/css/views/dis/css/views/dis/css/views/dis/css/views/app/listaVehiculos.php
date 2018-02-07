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
require_once('../../models/cars.php');
require_once('../../facades/carsFacades.php');
$consulta = new Cars();

$ncarros = $consulta->obtenerNumeroCarros();

$agregarVehiculo = '<a href="crearvehiculo.php"><i class="fa fa-plus"></i>Agregar Nuevo Vehículo</a>';
?>
<!-- Page content -->
<div id="page-content">
    <!-- Table Responsive Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-iphone"></i>Vehículos Registrados<br><small>Aquí podras ver todos los vehículos registrados en el sistema!</small>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Tabla</li>
        <li><a href="">Consulta de los Vehículos</a></li>
    </ul>
    <!-- END Table Responsive Header -->

    <!-- Responsive Full Block -->
    <div class="block full">
        <!-- All Orders Title -->
        <div class="block-title">
          <!--  <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Configuración"><i class="fa fa-cog"></i></a>
            </div> -->
            <h2><strong>Todos</strong> Los Vehículos</h2> <?php if($rol == 1 || $rol == 2 ){ echo $agregarVehiculo;} ?>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="$('#modal-search-user').modal('show');" id="btn-search-user"><i class="fa fa-search"></i>Busqueda personalizada</a>
            &nbsp;&nbsp;&nbsp;&nbsp;<span style="text-align: right;">Nº Vehículos Registrados: <i class="label label-info"><?php echo $ncarros; ?></i></span>
        </div>
        <!-- END All Orders Title -->
      <div class="table-responsive remove-margin-bottom">
        <!-- All Orders Content -->
        <?php echo listaVehiculosFacade($rol); ?>

      </div>

<!-- button export PFD -->
<!--<a href="../../reportePdf.php" data-toggle="tooltip" title="pdf" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>-->
</div>
<!-- END All Orders Block -->
</div>
<!-- END Page Content -->
<?php
require_once('../inc/footer.php');?>
<!-- Modal Busqueda-->
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
                <form action="../../controllers/app/buscardorVehiculoController.php" method="post" class="form-horizontal form-bordered">
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
                                  <option value="placa">Placa</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-repassword">Busqueda</label>
                            <div class="col-md-8">
                                <input type="text" id="frase" name="frase" class="form-control" placeholder="Digite la busqueda">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-sm btn-primary" id="btn-buscar">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<?php require_once('../inc/script.php');?>

<script src="../dis/js/pages/ecomOrders.js"></script>
<script>$(function(){ EcomOrders.init(); });</script>
<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/uiProgress.js"></script>
<script>$(function(){ UiProgress.init(); });</script>
<!-- <script src="../dis/js/pages/ecomOrders.js"></script>
<script>$(function(){ EcomOrders.init(); });</script>-->
<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
<script type="text/javascript">

  $('tr #Eliminar_Carro').click(function(e){

    e.preventDefault();
    var opcion = confirm("¿Esta seguro en eliminar este item?");
    if (opcion) {
      var fila = $(this).parent().parent().parent();
      var carro = fila.find('#id_car').text();
      var data = {idCarro: carro};
      $.post("../../controllers/app/EliminarVehiculoController.php", data, function(res, est, jqXHR){
        alert('Eliminado');
        fila.remove();
      });
    }
  });


</script>

<script type="text/javascript">
  $('#btn-buscar').click(function(e){
    var campo = $('#item-busqueda'):val();
    var item = $('#frase'):val();
    if( campo === '' || item === ''){
      alerte('ERROR: Alguno de los campos de la busqueda esta vacio.');
    }
  });
</script>


<?php
require_once('../inc/fin_template.php');
} else{
header("Location: ../mensajes/error_autenticacion.html");
}

?>
