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
require_once('../../models/complains.php');
require_once('../../models/services.php');
require_once('../../facades/complainsFacade.php');
$idqueja = $_GET['id'];

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
          <i class="fa fa-edit"></i>Respuesta<br><small>Complete el siguiente formulario para enviar la respuesta a la queja o reclamo</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="home">Incio</a></li>
      <li>Gestionar respuesta</li>
    </ul>
  </div>
  <!-- END Mini Top Stats Row -->

  <!-- Widgets Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="block">
        <div class="block-title">
          <h2><strong>Respuesta</strong></h2>
        </div>
          <?php echo formularioQuejaFacade($idqueja); ?>
      </div>
    </div>
  </div>
  <!-- END Widgets Row -->
</div>
<!-- END Page Content -->



<?php
require_once('../inc/footer.php');?>
<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
<div id="modal-queja" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-info-circle"></i> Información de la Queja</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<!-- END User Settings -->
<?php require_once('../inc/script.php');?>
<script src="../dis/js/helpers/ckeditor/ckeditor.js"></script>
<script src="../dis/js/pages/formsValidation.js"></script>
<script>$(function(){ FormsValidation.init(); });</script>
<script src="../dis/js/push.min.js"></script>
<script type="text/javascript">
  window.onload = function(){
    if (!Push.Permission.GRANTED) {
      Push.Permission.request();
    }
  }
  $('#btn-respuesta').click(function(e){
    var respuesta = CKEDITOR.instances['mensaje'].getData();
    if (respuesta === '') {
      alert('No ha escrito la respuesta');
      if (Push.Permission.GRANTED) {
        Push.create("TaxisYa",{
          body: "No has escrito la respuesta",
          icon: "../dis/img/icon57.png",
          timeout: 7000,
          vibrate: [100,100,100]
        });
      }else{
        alert('No ha escrito la respuesta');
      }

      return false;

    }
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
