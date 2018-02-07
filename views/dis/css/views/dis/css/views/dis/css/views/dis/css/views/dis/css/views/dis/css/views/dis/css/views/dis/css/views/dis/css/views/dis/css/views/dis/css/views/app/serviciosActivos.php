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
  require_once('../../models/usersDirs.php');
  require_once('../../models/users.php');
  require_once('../../models/services.php');
  require_once('../../models/barrio.php');
  require_once('../../facades/servicesFacade.php');
  require_once('../../facades/barrioFacade.php');

?>
<!-- Page content -->
<div id="page-content">
    <!-- Table Responsive Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-server"></i>Servicios Activos<br><small>Aquí podras ver todos los servicios activos registrados en el sistema!</small>
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
            <h2><strong>Todos</strong> Los servicios activos</h2> <a href="solicitarServicio"><i class="fa fa-plus"></i>Solicitar nuevo servicio</a>
            <input type="hidden" id="idusuarioid" name="" value="<?php echo $idUsuario?>">
        </div>
        <!-- END All Orders Title -->
      <div class="table-responsive remove-margin-bottom" id="table-servis">
        <!-- All Orders Content -->
        <?php echo tablaServiciosUserCmsFacade($idUsuario); ?>

      </div>

<!-- button export PFD -->
<!--<a href="../../reportePdf.php" data-toggle="tooltip" title="pdf" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>-->
</div>
<!-- END All Orders Block -->
</div>
<!-- END Page Content -->
<?php
      require_once('../inc/footer.php');?>
      <div id="modal-services" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <!-- Modal Header -->
                  <div class="modal-header text-center">
                      <h2 class="modal-title"><i class="fa fa-pencil"></i> Servicio</h2>
                  </div>
                  <!-- END Modal Header -->

                  <!-- Modal Body -->
                  <div class="modal-body" id="modi-servicio">

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
<script type="text/javascript">
  $(document).ready(function(){
    setInterval(refrescarTabla, 7000);
});
function refrescarTabla(){
  var id = $('#idusuarioid').val();
  $('#table-servicio-vivo').load("../../facades/servicesTablaFacade.php",{id:id}, function(){

  });
}
</script>
<script type="text/javascript">
$(document).ready(function(){

  //CANCELAR SERVICIO
  $('tr #cancelar_servicio').click(function(e){
    e.preventDefault();
    var mensaje = confirm("¿Desea Cancelar el Servicio?");
    if(mensaje){

      var fila = $(this).parent().parent().parent();
      var dir = fila.find('#idservicio').text();
      var data = {id: dir};

      $.post("../../controllers/app/cancelarServicioControllers.php", data, function(res, est, jqXHR){
        alert('El servicio ha sido Cancelado');
      });

    }
  });

  //MODIFICAR SERVICIO
  $('tr #btn-editar').click(function(e){
    e.preventDefault();
    var fila = $(this).parent().parent().parent();
    var dir = fila.find('#idservicio').text();
    var data = {id: dir};
    $.post("../../controllers/app/formularioModificarServicioController.php", data, function(datos){
      $("#modi-servicio").html(datos);
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
