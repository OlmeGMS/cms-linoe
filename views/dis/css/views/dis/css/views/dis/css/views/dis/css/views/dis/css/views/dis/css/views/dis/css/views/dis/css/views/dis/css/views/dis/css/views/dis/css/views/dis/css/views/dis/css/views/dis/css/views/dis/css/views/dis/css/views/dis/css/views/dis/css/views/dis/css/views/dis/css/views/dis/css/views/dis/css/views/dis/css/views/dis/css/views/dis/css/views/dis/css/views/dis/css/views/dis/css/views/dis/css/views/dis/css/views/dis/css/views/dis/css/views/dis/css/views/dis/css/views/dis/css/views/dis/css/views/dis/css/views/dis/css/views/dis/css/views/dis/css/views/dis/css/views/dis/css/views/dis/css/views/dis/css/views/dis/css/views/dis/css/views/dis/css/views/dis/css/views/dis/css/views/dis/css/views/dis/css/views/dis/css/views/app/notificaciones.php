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
require_once('../../models/cmsUsers.php');

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
          <i class="fa fa-edit"></i>Crear Notificación<br><small>Complete el siguiente formulario para crear una notificación</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="home.php">Incio</a></li>
      <li>Crear Notificación</li>
    </ul>
  </div>
  <!-- END Mini Top Stats Row -->

  <!-- Widgets Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="block">
        <div class="block-title">
          <h2><strong>Crear notificación</strong></h2>
        </div>
        <form id="form-notificacion" action="../../controllers/app/notificacionMasivaController.php" method="post" class="form-horizontal form-bordered">
          <fieldset>
            <legend><i class="fa fa-angle-right"></i> Datos de la notificación</legend>
            <div class="form-group">
              <label class="col-md-4 control-label" for="mensaje">Mensaje<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="Documento" id="mensaje" name="mensaje" class="form-control" placeholder="Digite el mensaje de la notificación" >
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="tipo_usuario">Tipo de Usuario<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <select type="text" id="tipo_usuario" name="tipo_usuario" class="form-control" placeholder="Digite el Nº de documento">
                  <option value="" selected disabled>Seleccione el tipo de usuario</option>
                  <option value="1">Taxistas</option>
                  <option value="2">Usuarios</option>
                </select>
              </div>
            </div>
            <div class="form-group ">
              <div class="col-md-8 col-md-offset-4">
                <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Enviar Notificación</button>
                <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
  <!-- END Widgets Row -->
</div>
<!-- END Page Content -->



<?php
require_once('../inc/footer.php');
require_once('../inc/script.php');?>
<script src="../dis/js/push.min.js"></script>
<script src="../dis/js/helpers/ckeditor/ckeditor.js"></script>
<script src="../dis/js/pages/validadorNotificacion.js"></script>
<script>$(function(){ validadorNotificacion.init(); });</script>


<?php
require_once('../inc/fin_template.php');
 ?>
 <?php
} else{
header("Location: ../mensajes/error_autenticacion.html");
}
?>
