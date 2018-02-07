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
            <h2><strong>Todos</strong> Los Servicios</h2> <a href="solicitarServicio"><i class="fa fa-plus"></i>Agregar Nuevo Servicio</a>
        </div>
        <!-- END All Orders Title -->
        <div class="block-title">
            <ul class="nav nav-tabs" data-toggle="tabs">
                <li class="active"><a href="#usuario">Usuario</a></li>
            </ul>
        </div>
        <div class="tab-content">

          <!--Usuario-->
          <div class="tab-pane active" id="usuario">
            <div class="block">
              <div class="block-title">
                <h2><strong>Reporte de servicios por usuario</strong></h2>
              </div>
              <form id="todosReporteServicioUsuario" action="../../controllers/app/reporteExcelServiciosController.php" method="post" class="form-horizontal form-bordered">
                <fieldset>
                  <legend><i class="fa fa-angle-right"></i> Datos del reporte</legend>
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="telefono">Teléfono<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                      <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Digite el teléfono del usuario" >
                    </div>
                    <div class="col-md-6">
                        <input type="hidden" id="form-services" name="form-services" value="4">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-4 control-label" for="filtro">Tipo de servicio<span class="text-danger">*</span></label>
                    <div class="col-md-6">
                        <select id="filtroUsuario" name="filtroUsuario" class="select-chosen" data-placeholder="Seleccione el tipo de servicio" style="width: 250px;">
                          <option value="" selected disabled></option>
                          <option value="0">Todos</option>
                          <option value="1">Aplicación</option>
                          <option value="2">Agendamiento</option>
                          <option value="3">Operador</option>
                        </select>
                    </div>
                  </div>
                  <div class="form-group">
                      <label class="col-md-4 control-label" for="example-daterange1">Rango de fechas</label>
                      <div class="col-md-8">
                          <div class="input-group input-daterange" data-date-format="yyyy-mm-dd">
                              <input type="text" id="fecha1Usuario" name="fecha1Usuario" class="form-control text-center" placeholder="Desde">
                              <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                              <input type="text" id="fecha2Usuario" name="fecha2Usuario" class="form-control text-center" placeholder="Hasta">
                          </div>
                      </div>
                  </div>
                  <div class="form-group ">
                    <div class="col-md-8 col-md-offset-4">
                      <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-file-excel-o"></i> Generar Reporte</button>
                      <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
                      <button id="btn-pdf-usuario" href="" type="button" class="btn btn-sm btn-danger"><i class="fa fa-file-pdf-o"></i> Generar Reporte PDF</button>
                    </div>
                  </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>

<!-- button export PFD -->
<!--<a href="../../reportePdf.php" data-toggle="tooltip" title="pdf" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>-->
</div>
<!-- END All Orders Block -->
</div>
<!-- END Page Content -->
<?php
require_once('../inc/footer.php');
require_once('../inc/script.php');?>

<script src="../dis/js/pages/validadorReporteServicios.js"></script>
<script>$(function(){ValidadorReporteServicios.init(); });</script>
<script type="text/javascript">

    $('#btn-pdf-servicios').click(function(e){
      var ts = $('#filtro').val();
      var fecha1 = $('#fecha1').val();
      var fecha2 = $('#fecha2').val();
      if (ts != '' && fecha1 !='' && fecha2 != '') {
        var opcion = confirm("Se recomienda hacer el reporte de servicios en pdf solo por dia. De ser hacer asi porfavor de click en aceptar");
        if (opcion) {
          location.href="../../controllers/app/reportes/pdf/reportePdfServiciosController.php?servicio="+ts+"&&fecha1="+fecha1+"&&fecha2="+fecha2;
        }

      }else {
        alert('ERROR: Hay campos vacios por lo que no se puedo realizar el reporte.');
      }
    });

    $('#btn-pdf-conductor').click(function(e){
      var cedula = $('#cedulaConductor').val();
      var ts = $('#filtroConductor').val();
      var fecha1 = $('#fecha1Conductor').val();
      var fecha2 = $('#fecha2Conductor').val();
      if (cedula != '' && ts != '' && fecha1 !='' && fecha2 != '') {
        location.href="../../controllers/app/reportes/pdf/reportePdfConductorController.php?cedulas="+cedula+"&&servicio="+ts+"&&fecha1="+fecha1+"&&fecha2="+fecha2;
      }else {
        alert('ERROR: Hay campos vacios por lo que no se puedo realizar el reporte.');
      }

    });
    $('#btn-pdf-carro').click(function(e){
      var placa = $('#placa').val();
      var ts = $('#filtroCarro').val();
      var fecha1 = $('#fecha1Carro').val();
      var fecha2 = $('#fecha2Carro').val();
      if (placa != '' && ts != '' && fecha1 !='' && fecha2 != '') {
        location.href="../../controllers/app/reportes/pdf/reportePdfvehiculoController.php?placas="+placa+"&&servicio="+ts+"&&fecha1="+fecha1+"&&fecha2="+fecha2;
      }else {
        alert('ERROR: Hay campos vacios por lo que no se puedo realizar el reporte.');
      }
    });

    $('#btn-pdf-usuario').click(function(e){
      var tel = $('#telefono').val();
      var ts = $('#filtroUsuario').val();
      var fecha1 = $('#fecha1Usuario').val();
      var fecha2 = $('#fecha2Usuario').val();
      if (tel!= '' && ts != '' && fecha1 !='' && fecha2 != '') {
        location.href="../../controllers/app/reportes/pdf/reportePdfUsuarioController.php?telefono="+tel+"&&servicio="+ts+"&&fecha1="+fecha1+"&&fecha2="+fecha2;
      }else {
        alert('ERROR: Hay campos vacios por lo que no se puedo realizar el reporte.');
      }

    });

</script>

<?php
require_once('../inc/fin_template.php');
} else{
header("Location: ../mensajes/error_autenticacion.html");
}

?>
