<?php
require_once('../inc/header.php');
if (isset($_SESSION['nombre'])){
require_once('../inc/menu_administrador.php');
require_once('../inc/cabecera_contenido.php');
require_once('../../models/conexion.php');
require_once('../../models/ticketCostCenters.php');





?>

<!-- Page content -->
<div id="page-content">
  <!-- Dashboard Header -->
  <!-- For an image header add the class 'content-header-media' and an image as in the following example --

  <!-- Mini Top Stats Row -->
  <div class="row">
    <div class="content-header">
      <div class="header-section">
        <h1>
          <i class="fa fa-edit"></i>Agregar Centro de costos<br><small>Complete el siguiente formulario para agregar un nuevo Centro de costos</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="home.php">Incio</a></li>
      <li>Crear Centro de costos</li>
    </ul>
  </div>
  <!-- END Mini Top Stats Row -->

  <!-- Widgets Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="block">
        <div class="block-title">
          <h2><strong>Agregar Nuevo Centro de costos/strong></h2>
        </div>
        <form id="form-validation" action="../../controllers/administrador/agregarCentroCostoController.php" method="post" class="form-horizontal form-bordered">
          <fieldset>
            <legend><i class="fa fa-angle-right"></i> Datos del Centro de costos</legend>
            <div class="form-group">
              <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Digite el nombre" >
              </div>
              <div class="col-md-6">
                <input type="hidden" id="id_compania" name="id_compania" class="form-control" value="<?php echo $idCompania; ?>" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="prefijo">Prefijo<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="prefijo" name="prefijo" class="form-control" placeholder="Digite el Prprefijo" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="email">Presupuesto<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="presupuesto" name="presupuesto" class="form-control" placeholder="Digite el email" >
              </div>
            </div>
            <div class="form-group ">
              <div class="col-md-8 col-md-offset-4">
                <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Agregar Centro</button>
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
?>
<!-- Include Jquery library from Google's CDN but if something goes wrong get Jquery from local file -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>!window.jQuery && document.write(decodeURI('%3Cscript src="js/vendor/jquery-1.11.2.min.js"%3E%3C/script%3E'));</script>

<!-- Bootstrap.js, Jquery plugins and Custom JS code -->
<script src="../dis/js/vendor/bootstrap.min.js"></script>
<script src="../dis/js/plugins.js"></script>
<script src="../dis/js/app.js"></script>

<!-- Load and execute javascript code used only in this page -->
<script src="../dis/js/pages/formsValidation.js"></script>
<script>$(function(){ FormsValidation.init(); });</script>

<?php
require_once('../inc/fin_template.php');
 ?>
 <?php
} else{
header("Location: ../mensajes/error_autenticacion.html");
}
?>
