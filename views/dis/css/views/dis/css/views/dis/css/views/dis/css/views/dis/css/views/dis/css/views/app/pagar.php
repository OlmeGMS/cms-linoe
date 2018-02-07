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
require_once('../../models/parameters.php');
require_once('../../facades/servicesFacade.php');
$consulta = new Services();
$consultaParametros = new Parameters();
$empresa = $_GET['empresa'];
$id = $_GET['serv'];
$valorUnidad = $consultaParametros->obtnerPrecioUnidad();
?>

<!-- Page content -->
<div id="page-content">
  <!-- Dashboard Header -->
  <!-- For an image header add the class 'content-header-media' and an image as in the following example -->

  <!-- Mini Top Stats Row -->
  <div class="row">
    <div class="content-header">
      <div class="header-section">
        <h1>
          <i class="fa fa-dollar"></i>Información del Pago<br><small>A continuación podrar ver la información del pago</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="home.php">Incio</a></li>
      <li>Información Pago</li>
    </ul>
  </div>
  <!-- END Mini Top Stats Row -->

  <!-- Widgets Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="block">
        <div class="block-title">
          <h2><strong>Información Pago</strong></h2>
        </div>
            <?php echo formularioPagoFacade($id, $empresa, $valorUnidad); ?>
      </div>
    </div>
  </div>
  <!-- END Widgets Row -->
</div>
<!-- END Page Content -->



<?php
require_once('../inc/footer.php');
require_once('../inc/script.php');?>
<script src="../dis/js/pages/validadorPagos.js"></script>
<script>$(function(){ ValidadorPagos.init(); });</script>
<script type="text/javascript">
$('#btn-volver').click(function(e){
  location.href="usuariosApp";
});

</script>

<script type="text/javascript">
  $(document).ready(function() {
    var aeropuerto = $('#aeropuerto').val();
    var nocturno = $('#nocturno').val();
    var mensajeria = $('#mensajeria').val();
    var pp = $('#pp').val();
    var unidades = $('#unidades').val();
    var valorUnidad = $('#unidades_valor').val();
    var totalunidades = unidades * valorUnidad;
    var total = totalunidades + aeropuerto + nocturno + mensajeria + pp;
  });
</script>

<?php
require_once('../inc/fin_template.php');
 ?>
 <?php
} else{
header("Location: ../mensajes/error_autenticacion.html");
}
?>
