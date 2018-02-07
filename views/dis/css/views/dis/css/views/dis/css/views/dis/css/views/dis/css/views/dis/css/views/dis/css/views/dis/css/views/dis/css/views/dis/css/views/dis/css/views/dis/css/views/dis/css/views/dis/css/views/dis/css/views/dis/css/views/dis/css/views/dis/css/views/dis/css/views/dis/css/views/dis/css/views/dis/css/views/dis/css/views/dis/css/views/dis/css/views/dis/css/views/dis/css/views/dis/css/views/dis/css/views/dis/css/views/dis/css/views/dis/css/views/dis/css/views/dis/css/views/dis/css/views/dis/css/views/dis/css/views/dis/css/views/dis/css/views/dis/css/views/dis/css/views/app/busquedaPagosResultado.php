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
  require_once('../../facades/servicesFacade.php');

  $consulta = new Services();
  $empresa = $_GET['empresa'];
  $campo = $_GET['campo'];
  $frase = $_GET['frase'];



?>
<!-- Page content -->
<div id="page-content">
    <!-- Table Responsive Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="fa fa-dollar"></i>Servicios Activos<br><small>Aquí podras ver todos los servicios activos registrados en el sistema!</small>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Tabla</li>
        <li><a href="">Servicios activos</a></li>
    </ul>
    <!-- END Table Responsive Header -->

    <!-- Responsive Full Block -->
    <div class="block full">
        <!-- All Orders Title -->
        <div class="block-title">
          <!--  <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Configuración"><i class="fa fa-cog"></i></a>
            </div> -->
            <h2><strong>Todos</strong> Los servicios activos</h2> <a href="javascript:void(0)" onclick="$('#modal-search-pagos').modal('show');" id="btn-search-user"><i class="fa fa-search"></i>Busqueda personalizada</a>
            <input type="hidden" id="idusuarioid" name="" value="<?php echo $idUsuario?>">
        </div>
        <!-- END All Orders Title -->
      <div class="table-responsive remove-margin-bottom" id="table-servis">
        <!-- All Orders Content -->
        <form class="" action="../../controllers/app/vales/generarFacturaController.php" method="post">
            <?php echo listaServicioParaPagosBusquedaFacade($empresa, $campo, $frase); ?>
              <input type="hidden" id="_token" name="_token" class="form-control" value="<?php echo NoCSRF::generate('_token')?>">
            <table class="btn-group btn-group-sm pull-right">
              <tr>
                <td><input type="hidden" id="empresa" name="empresa" class="form-control" value="<?php echo $empresa?>"></td>
                <td><label for="n-pago">Número de pago&nbsp;&nbsp;&nbsp;&nbsp;</label></td>
                <td><input type="text" id="n-pago" name="n-pago" class="form-control" placeholder="Digite el Nº de pago" ></td>
                <td><button href="" type="submit" class="btn btn-sm btn-success" id="btn-pagos-multiple" name="btn-pagos-multiple" style="float: right;"><i class="fa fa-dollar"></i> Liquidar pagos</button></td>
              </tr>
            </table>

        </form>
      </div>

<!-- button export PFD -->
<!--<a href="../../reportePdf.php" data-toggle="tooltip" title="pdf" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>-->
</div>
<!-- END All Orders Block -->
</div>
<!-- END Page Content -->
<?php
      require_once('../inc/footer.php');?>
      <div id="modal-search-pagos" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <  <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header text-center">
                        <h2 class="modal-title"><i class="fa fa-search"></i> Busqueda</h2>
                    </div>
                    <!-- END Modal Header -->

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form action="../../controllers/app/vales/buscardorPagosController.php" method="post" class="form-horizontal form-bordered">
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
                                          <option value="ser.id">Número del servicio</option>
                                          <option value="ser.user_card_reference">Vale</option>
                                          <option value="car.placa">Placa</option>
                                          <option value="user_name">Nombre usuario</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="user-settings-repassword">Busqueda</label>
                                    <div class="col-md-8">
                                        <input type="text" id="frase" name="frase" class="form-control" placeholder="Digite la busqueda">
                                    </div>
                                    <div class="col-md-8">
                                        <input type="hidden" id="empresa" name="empresa" class="form-control" value="<?php echo $empresa ?>">
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

      <div id="modal-info-pagos" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <  <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header text-center">
                        <h2 class="modal-title"><i class="fa fa-info"></i> Información del pago</h2>
                    </div>
                    <!-- END Modal Header -->

                    <!-- Modal Body -->
                    <div class="modal-body" id="info-pago">

                    </div>
                    <!-- END Modal Body -->
                </div>
            </div>
      </div>
      <!-- END User Settings -->
<?php require_once('../inc/script.php');?>

<!--<script src="../dis/js/pages/tablaFinalizados.js"></script>
<script>$(function(){ TablesServiciosVivo.init(); });</script>-->
<!-- Load and execute javascript code used only in this page -->

<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
<script src="../dis/js/pages/tablesDatatables.js"></script>
<script>$(function(){ TablesDatatables.init(); });</script>
<script type="text/javascript">
$(document).ready(function(){
  $('tr #ser_info').click(function(e){
    e.preventDefault();
    var fila = $(this).parent().parent().parent();
    var dir = fila.find('#id_server').text();
    var empresa = $('#empresa').val();
    var data = {id: dir, emp: empresa};
    $.post("../../controllers/app/vales/formularioInformacionPagoController.php", data, function(datos){
      $("#info-pago").html(datos);
    });
  });
});

</script>

<script type="text/javascript">
  $('#btn-pagos-multiple').click(function(e){
    var codigo = $('#n-pago').val();
    if(codigo == undefined || codigo === ''){
      alert('No ha digitado el codigo');
      return false;
    }else {

    }
  });
</script>

<?php
require_once('../inc/fin_template.php');
} else{
header("Location: ../mensajes/error_autenticacion.html");
}

?>
