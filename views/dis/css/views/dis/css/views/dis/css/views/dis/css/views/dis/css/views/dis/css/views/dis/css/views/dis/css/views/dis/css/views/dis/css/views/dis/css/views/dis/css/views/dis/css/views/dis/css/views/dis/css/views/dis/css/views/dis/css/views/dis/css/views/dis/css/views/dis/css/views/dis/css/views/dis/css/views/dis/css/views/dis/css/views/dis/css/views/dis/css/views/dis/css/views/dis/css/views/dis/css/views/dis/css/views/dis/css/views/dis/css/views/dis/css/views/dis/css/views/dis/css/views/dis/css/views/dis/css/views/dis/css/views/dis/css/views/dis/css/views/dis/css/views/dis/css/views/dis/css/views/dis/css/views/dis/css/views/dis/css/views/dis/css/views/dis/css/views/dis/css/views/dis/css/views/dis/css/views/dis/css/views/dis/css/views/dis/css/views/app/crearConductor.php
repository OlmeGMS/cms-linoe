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
require_once('../../models/drivers.php');
require_once('../../facades/carsFacades.php');
require_once('../../facades/driversFacade.php');

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
          <i class="fa fa-edit"></i>Agregar Conductor<br><small>Complete el siguiente formulario para agregar un nuevo conductor</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="home.php">Incio</a></li>
      <li>Crear conductor</li>
    </ul>
  </div>
  <!-- END Mini Top Stats Row -->

  <!-- Widgets Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="block">
        <div class="block-title">
          <h2><strong>Agregar Nuevo Conductor</strong></h2>
        </div>
        <form id="form-validation" action="../../controllers/app/agregarConductorController.php" method="post" class="form-horizontal form-bordered" enctype="multipart/form-data">
          <fieldset>
            <legend><i class="fa fa-angle-right"></i> Datos del conductor</legend>

            <div class="form-group">
              <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="Documento" id="nombre" name="nombre" class="form-control" placeholder="Digite el nombre del conductor" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="primer_apellido">Apellido<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="primer_apellido" name="primer_apellido" class="form-control" placeholder="Digite el apellido del conductor" >
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="email">Email<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="email" id="email" name="email" class="form-control" placeholder="Digite el email" >
              </div>
              <div class="col-md-6">
                <input type="hidden" id="_token" name="_token" class="form-control" value="<?php echo NoCSRF::generate('_token')?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="password">Contraseña<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="password" name="password" class="form-control" placeholder="Digite la contraseña" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="movil">Celular<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="movil" name="movil" class="form-control" placeholder="Digite el número celular " >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="telefono">Teléfono<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Digite el teléfono " >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="Documento">Cédula de ciudadania<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="Documento" name="Documento" class="form-control" placeholder="Digite el Nº de cedula" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="direccion">Direccion<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Digite la dirección de residencia" >
              </div>
            </div>
            <div class="form-group">
                <label class="col-md-4 control-label" for="example-chosen-multiple">Vehículos<span class="text-danger">*</span></label>
                <div class="col-md-6">
                    <select id="example-chosen-multiple[]" name="example-chosen-multiple[]" class="select-chosen" data-placeholder="Seleccione los vehículos que conduce" style="width: 250px;" multiple>
                      <?php echo placasFacade(); ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-4 control-label" for="example-file-input">Foto conductor</label>
                <div class="col-md-6">
                    <input type="file" id="example-file-input" name="example-file-input" accept="image/*">
                </div>
                <div class="col-md-6">

                    <a href="javascript:void(0)" class="enable-tooltip" data-placement="bottom" title="CamaraWeb" onclick="$('#modal-user-camera').modal('show');"><i class="gi gi-photo"></i>Tomar foto con la camara web</a>
                </div>
            </div>
            <div class="form-group ">
              <div class="col-md-8 col-md-offset-4">
                <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Agregar usuario</button>
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
require_once('../inc/footer.php');?>
<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
<div id="modal-user-camera" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-camera"></i> Camara Web</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="index.html" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" onsubmit="return false;">
                    <fieldset>
                        <legend>Toma la foto</legend>
                        <div class="form-group">

                            <div class="col-md-8">
                                <video id="video" width="400" height="300">

                                </video>
                                <a href="#" id="capture" class="btn btn-sm btn-info">Tomar foto</a>
                            </div>
                        </div>

                    </fieldset>
                    <fieldset>
                        <legend>Foto tomada</legend>
                        <div class="form-group">
                            <div class="col-md-8 text-center">
                                <canvas id="canvas" width="400" height="300"></canvas>
                            </div>
                        </div>

                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                            <!--<button type="submit" class="btn btn-sm btn-primary">Save Changes</button>-->
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<!-- END User Settings -->
<?php require_once('../inc/script.php');?>
<script src="../dis/js/pages/formsValidation.js"></script>
<script>$(function(){ FormsValidation.init(); });</script>
<script src="../dis/js/photo.js"></script>

<?php
require_once('../inc/fin_template.php');
 ?>
 <?php
} else{
header("Location: ../mensajes/error_autenticacion.html");
}
?>
