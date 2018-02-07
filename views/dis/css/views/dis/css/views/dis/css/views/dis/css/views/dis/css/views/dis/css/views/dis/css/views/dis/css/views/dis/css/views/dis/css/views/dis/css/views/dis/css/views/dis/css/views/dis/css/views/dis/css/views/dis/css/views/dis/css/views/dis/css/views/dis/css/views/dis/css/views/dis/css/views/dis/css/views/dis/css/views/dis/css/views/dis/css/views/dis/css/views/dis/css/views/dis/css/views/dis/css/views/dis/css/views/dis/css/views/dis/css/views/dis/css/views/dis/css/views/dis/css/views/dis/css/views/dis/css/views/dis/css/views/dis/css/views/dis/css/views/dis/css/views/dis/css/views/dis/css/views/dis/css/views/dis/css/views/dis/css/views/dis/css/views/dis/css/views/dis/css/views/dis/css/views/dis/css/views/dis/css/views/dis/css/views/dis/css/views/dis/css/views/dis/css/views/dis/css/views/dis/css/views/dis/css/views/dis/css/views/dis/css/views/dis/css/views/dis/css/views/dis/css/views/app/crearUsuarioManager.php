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
require_once('../../models/ticket_users.php');
require_once('../../models/ticketCostCenters.php');
require_once('../../facades/vales/facadeTicketCostCenters.php');

if ($idCompania != 0) {
  $idEmpresa = $idCompania;
}else{
  $idEmpresa = $_GET['empresa'];
}


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
          <i class="fa fa-edit"></i>Agregar Usuario<br><small>Complete el siguiente formulario para agregar un nuevo usuario</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="home.php">Incio</a></li>
      <li>Crear Usuario</li>
    </ul>
  </div>
  <!-- END Mini Top Stats Row -->

  <!-- Widgets Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="block">
        <div class="block-title">
          <h2><strong>Agregar Nuevo Usuario</strong></h2>
        </div>
        <form id="form-validation" action="../../controllers/app/vales/agregarUsuarioMangerController.php" method="post" class="form-horizontal form-bordered">
          <fieldset>
            <legend><i class="fa fa-angle-right"></i> Datos del usuario</legend>
            <div class="form-group">
              <label class="col-md-4 control-label" for="centro_costo">Centro de costo<span class="text-danger">*</span></label>
              <div class="col-md-6">
              <select class="form-control" name="centro_costo" id="centro_costo">
                <option value="disabled "disabled selected>Seleccione Centro de costos</option>
                <?php selectCentroCostosXIdCompania($idEmpresa); ?>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Digite el nombre" >
              </div>
              <div class="col-md-6">
                <input type="hidden" id="id_compania" name="id_compania" class="form-control" value="<?php echo $idEmpresa?>" >
              </div>
              <div class="col-md-6">
                <input type="hidden" id="id_usuario" name="id_usuario" class="form-control" value="<?php echo $idUsuario?>" >
              </div>
              <div class="col-md-6">
                <input type="hidden" id="rol" name="rol" class="form-control" value="manager" >
              </div>
              <div class="col-md-6">
                <input type="hidden" id="_token" name="_token" class="form-control" value="<?php echo NoCSRF::generate('_token')?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="Documento">Cedula<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="Documento" name="Documento" class="form-control" placeholder="Digite el número de contacto" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="telefono">Telélfono<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="telefono" name="telefono" class="form-control" placeholder="Digite el número de contacto" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="email">Email<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="email" id="email" name="email" class="form-control" placeholder="Digite el email" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="password">Password<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="password" id="password" name="password" class="form-control" placeholder="Digite el password" >
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
require_once('../inc/footer.php');
require_once('../inc/script.php');?>
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
require_once('../../models/ticket_users.php');
require_once('../../models/ticketCostCenters.php');
require_once('../../facades/facadeTicketCostCenters.php');


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
          <i class="fa fa-edit"></i>Agregar Usuario<br><small>Complete el siguiente formulario para agregar un nuevo usuario</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="home.php">Incio</a></li>
      <li>Crear Usuario</li>
    </ul>
  </div>
  <!-- END Mini Top Stats Row -->

  <!-- Widgets Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="block">
        <div class="block-title">
          <h2><strong>Agregar Nuevo Usuario</strong></h2>
        </div>
        <form id="form-validation" action="../../controllers/administrador/agregarUsuarioMangerController.php" method="post" class="form-horizontal form-bordered">
          <fieldset>
            <legend><i class="fa fa-angle-right"></i> Datos del usuario</legend>
            <div class="form-group">
              <label class="col-md-4 control-label" for="centro_costo">Centro de costo</label>
              <div class="col-md-6">
              <select class="form-control" name="centro_costo" id="centro_costo">
                <option value="disabled "disabled selected>Seleccione Centro de costos</option>
                <?php selectCentroCostosXIdCompania($idCompania); ?>
              </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Digite el nombre" >
              </div>
              <div class="col-md-6">
                <input type="hidden" id="id_compania" name="id_compania" class="form-control" value="<?php echo $idCompania; ?>" >
              </div>
              <div class="col-md-6">
                <input type="hidden" id="id_usuario" name="id_usuario" class="form-control" value="<?php echo $idUsuario; ?>" >
              </div>
              <div class="col-md-6">
                <input type="hidden" id="rol" name="rol" class="form-control" value="manager" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="movil">Telélfono<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="movil" name="movil" class="form-control" placeholder="Digite el número de contacto" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="email">Email<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="email" id="email" name="email" class="form-control" placeholder="Digite el email" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="pass">Password<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="password" id="pass" name="pass" class="form-control" placeholder="Digite el password" >
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
require_once('../inc/footer.php');
require_once('../inc/script.php');?>
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
