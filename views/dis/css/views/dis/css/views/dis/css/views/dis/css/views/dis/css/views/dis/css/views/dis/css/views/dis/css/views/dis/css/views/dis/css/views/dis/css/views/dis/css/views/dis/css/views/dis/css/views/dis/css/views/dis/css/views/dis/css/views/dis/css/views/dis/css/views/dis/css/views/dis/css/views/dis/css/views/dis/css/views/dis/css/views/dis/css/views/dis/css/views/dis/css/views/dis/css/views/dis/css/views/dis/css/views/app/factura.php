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
  $servicios = $_GET ['servicios'];
  $nPago = $_GET['npago'];


    /* Deshacemos el trabajo hecho por base64_encode */
    $ser = base64_decode($_GET['servicios']);
    /* Deshacemos el trabajo hecho por 'serialize' */
    $ser = unserialize($ser);
$token = NoCSRF::generate('_token');
$url = "../../controllers/app/vales/pagosMultiplesController.php?n-pago=$nPago&&empresa=$empresa&&servicios=$servicios&&_token=$token";

?>
<!-- Page content -->
<div id="page-content">
    <!-- Invoice Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-usd"></i>Factura<br><small>Servicios realizados con Taxisya!</small>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Pagos</li>
        <li><a href="">factura</a></li>
    </ul>
    <!-- END Invoice Header -->

    <!-- Invoice Block -->
    <div class="block full">
        <!-- Invoice Title -->
        <div class="block-title">
            <div class="block-options pull-right">
                <!--<a href="javascript:void(0)" class="btn btn-sm btn-alt btn-default" data-toggle="tooltip" title="New invoice"><i class="fa fa-plus"></i></a>-->
                <!--<a href="javascript:void(0)" class="btn btn-sm btn-alt btn-default" data-toggle="tooltip" title="Delete invoice"><i class="fa fa-times"></i></a>-->
                <a href="javascript:void(0)" class="btn btn-sm btn-alt btn-default" onclick="App.pagePrint();"><i class="fa fa-print"></i> Imprimir</a>
            </div>
            <h2><strong>Factura</strong> #<?php echo $nPago; ?></h2>
        </div>
        <!-- END Invoice Title -->

        <!-- Invoice Content -->
        <!-- 2 Column grid -->
        <div class="row block-section">
            <!-- Company Info -->
            <div class="col-sm-6">
                <img src="../dis/img/placeholders/avatars/avatar.png" alt="photo" class="img-circle" width="10%">
                <hr>
                <h2><strong>Taxisya.</strong></h2>
                <address>
                    Dirección<br>
                    Calle 1C Bis # 18 - 34<br>
                    Bogotá/Colombia<br><br>
                    <i class="fa fa-phone"></i> (57-1) 2891603 / 2000000<br>
                    <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">soportetaxisya@gmail.com</a>
                </address>
            </div>
            <!-- END Company Info -->

            <!-- Client Info -->
            <!--<div class="col-sm-6 text-right">
                <img src="../dis/img/placeholders/avatars/avatar.png" alt="photo" class="img-circle" width="10%">
                <hr>
                <h2><strong>Client</strong></h2>
                <address>
                    Address<br>
                    Town/City<br>
                    Region, Zip/Postal Code<br><br>
                    (000) 000-0000 <i class="fa fa-phone"></i><br>
                    <a href="javascript:void(0)">example@example.com</a> <i class="fa fa-envelope-o"></i>
                </address>
            </div>-->
            <!-- END Client Info -->
        </div>
        <!-- END 2 Column grid -->

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-vcenter">
                <thead>
                    <tr>
                        <th></th>
                        <th style="width: 60%;">Origen del Servicio</th>
                        <th class="text-center">Nº Vale</th>
                        <th class="text-center">Unidades</th>
                        <th class="text-right">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php facturaFacade($nPago, $ser, $empresa); ?>

                </tbody>
            </table>
        </div>
        <!-- END Table -->

        <div class="clearfix">
            <div class="btn-group pull-right">
                <!--<a href="javascript:void(0)" class="btn btn-default"><i class="fa fa-print"></i> Save</a>-->
                <a href="<?php echo $url;?>" class="btn btn-primary"><i class="fa fa-angle-right"></i> Realizar Pago</a>
            </div>
        </div>
        <!-- END Invoice Content -->
    </div>
    <!-- END Invoice Block -->
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

<?php
require_once('../inc/fin_template.php');
} else{
header("Location: ../mensajes/error_autenticacion.html");
}

?>
