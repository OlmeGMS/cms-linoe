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
  require_once('../../models/ticketCostCenters.php');
  require_once('../../models/services.php');

  $consulta = new TicketTickets();
  $consultaTicketCost = new TicketCostCenters();

  //$mes = $_GET['idmes'];


  $presupuesto = $consultaTicketCost->obtnerPresupuestoCentroCosto($idCentroCostos);
  $porcentaje = $consultaTicketCost->obtnerPorcentaje($idCentroCostos);
  $facturado = $consultaTicketCost->obtenerAvaliableCentroCosto($idCentroCostos);
  $gasto = $consultaTicketCost->obtnerGastoXCentroCosto($idCentroCostos);

  $saldo = $presupuesto - $facturado - $gasto;

  if ($saldo > 0) {
    $label = "label-success";
  }else{
    $label = "label-danger";
  }

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
    <?php
        if($role == 'manager'){
          echo '
          <div class="row">

            <div class="col-md-12">
              <div class="block">
                <div class="block-title">
                  <h2><strong>Crear Vales</strong></h2>
                </div>
                <form id="form-validation" action="../../controllers/app/vales/crerValesController.php" method="post" class="form-horizontal form-bordered">
                  <fieldset>
                    <legend><i class="fa fa-angle-right"></i>Datos de los vales</legend>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="cantidad">Cantidad<span class="text-danger">*</span></label>
                      <div class="col-md-6">
                        <input type="number" id="cantidad" name="cantidad" class="form-control" placeholder="Escriba la cantida de vales a generar">
                      </div>
                      <div class="col-md-6">
                        <input type="hidden" id="idCompania" name="idCompania" class="form-control" value="'.$idCompania.'" >
                      </div>
                      <div class="col-md-6">
                        <input type="hidden" id="cost_center" name="cost_center" class="form-control" value="'.$idCentroCostos.'" >
                      </div>
                      <div class="col-md-6">
                        <input type="hidden" id="nombre_usuario" name="nombre_usuario" class="form-control" value="'.$nombre.'" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="fechaFin">Fecha de vencimineto</label>
                      <div class="col-md-6">
                        <input type="text" id="fechaFin" name="fechaFin" class="form-control input-datepicker" data-date-format="yyyy-mm-dd" placeholder="dd/mm/yyyy">
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="example-timepicker24">Select Time (24h)</label>
                        <div class="col-md-6">
                            <div class="input-group bootstrap-timepicker">
                                <input type="text" id="example-timepicker24" name="example-timepicker24" class="form-control input-timepicker24">
                                <span class="input-group-btn">
                                    <a href="javascript:void(0)" class="btn btn-primary"><i class="fa fa-clock-o"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="col-md-4 control-label" for="dependencia">Dependencia</label>
                      <div class="col-md-6">
                        <input type="text" id="dependencia" name="dependencia" class="form-control" placeholder="Escriba la dependencia">
                      </div>
                    </div>
                    <div class="form-group ">
                      <div class="col-md-8 col-md-offset-4">
                        <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Crear vale</button>
                        <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
                      </div>
                    </div>
                  </fieldset>
                </form>
              </div>
            </div>
          </div>
          ';
        }
     ?>
    <!-- Responsive Full Block -->
    <div class="block full">
        <!-- All Orders Title -->
        <div class="block-title">
          <!--  <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Configuración"><i class="fa fa-cog"></i></a>
            </div> -->
            <h2><strong>Todos</strong> Los Vales</h2> &nbsp;&nbsp;&nbsp;&nbsp;<span>Presupuesto: <span class="label label-info"><?php echo '$'.$presupuesto; ?></span></span>&nbsp;&nbsp;&nbsp;&nbsp;<span>Facturado: <i class="label" style="background: #058de7;"><?php echo '$'.$facturado?></i>
            </span>
            &nbsp;&nbsp;&nbsp;&nbsp;<span>Gastado este mes: <i class="label label-info"><?php echo '$'.$gasto; ?></i></span>&nbsp;&nbsp;&nbsp;&nbsp;<span>Saldo: <i class="label <?php echo $label?>">
            <?php echo '$'.$saldo; ?></i></span>
        </div>
        <!-- END All Orders Title -->
<div class="table-responsive remove-margin-bottom">
        <!-- All Orders Content -->
        <table id="table-conductor" class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center">Empresa</th>
                    <th class="text-center">Vale</th>
                    <th class="text-center">Estado</th>
                    <th class="text-center">Fecha inicio</th>
                    <th class="text-center">Fecha fin</th>
                    <th class="text-center">Gerente</th>
                    <th class="text-center">Dependencia</th>
                </tr>
            </thead>
            <tbody>
                <?php
                  if ($role == 'admin') {
                    echo listValesXCompania($idCompania);
                  }elseif ($role == 'manager') {
                    echo listValesXDependecia($idCentroCostos);
                  }


                 ?>
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
    require_once('../inc/footer.php');
    require_once('../inc/script.php');?>

    <script src="../dis/js/pages/tablaUsuariosCms.js"></script>
    <script>$(function(){ TablesConductor.init(); });</script>
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
