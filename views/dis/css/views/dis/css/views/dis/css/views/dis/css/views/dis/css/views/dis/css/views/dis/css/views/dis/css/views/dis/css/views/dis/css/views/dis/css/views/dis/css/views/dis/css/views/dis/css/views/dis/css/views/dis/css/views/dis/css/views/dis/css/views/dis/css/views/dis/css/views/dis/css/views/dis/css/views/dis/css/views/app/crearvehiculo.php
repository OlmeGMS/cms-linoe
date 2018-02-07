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
require_once('../../models/company.php');
require_once('../../models/cmsCountries.php');
require_once('../../models/cmsDepartments.php');
require_once('../../models/cmsCities.php');
require_once('../../models/brandsCars.php');
require_once('../../models/lineCars.php');
require_once('../../facades/carsFacades.php');
require_once('../../facades/companyFacade.php');
require_once('../../facades/cmsCitiesFacades.php');
require_once('../../facades/cmsCountriesFacade.php');
require_once('../../facades/cmsDepartmentsFacade.php');
require_once('../../facades/brandsCarFacade.php');
require_once('../../facades/lineCarsFacade.php');

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
          <i class="fa fa-edit"></i>Agregar Vehículo<br><small>Complete el siguiente formulario para agregar un nuevo vehículo</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="home.php">Incio</a></li>
      <li>Crear Vehículo</li>
    </ul>
  </div>
  <!-- END Mini Top Stats Row -->

  <!-- Widgets Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="block">
        <div class="block-title">
          <h2><strong>Agregar Nuevo Vehículo</strong></h2>
        </div>
        <form id="form-validation" action="../../controllers/app/agregarVehiculoController.php" method="post" class="form-horizontal form-bordered">
          <fieldset>
            <legend><i class="fa fa-angle-right"></i> Datos del vehículo</legend>

            <div class="form-group">
              <label class="col-md-4 control-label" for="placa">Placa<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="Documento" id="placa" name="placa" class="form-control" placeholder="Digite la placa" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="nafiliacion">Móvil<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="nafiliacion" name="nafiliacion" class="form-control" placeholder="Digite el móvil" >
              </div>
              <div class="col-md-6">
                <input type="hidden" id="_token" name="_token" class="form-control" value="<?php echo NoCSRF::generate('_token')?>">
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="marca">Marca<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <select id="marca" name="marca" class="select-chosen" data-placeholder="Seleccione la marca" style="width: 250px;">

                  <option value=""disabled selected>Seleccione la marca</option>
                  <?php echo listaMarcasFacade(); ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="lineas">Linea<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <!--<select id="lineas" name="lineas" class="select-chosen" data-placeholder="Seleccione la marca" style="width: 250px;">-->
                <select type="text" class="form-control" name="lineas" id="lineas">
                  <option value=""disabled selected>Seleccione la marca</option>

                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="modelo">Modelo del vehículo<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <select type="text" class="form-control" name="modelo" id="modelo">
                  <option value=""disabled selected>Seleccione año del modelo</option>
                  <?php echo aniosModelo(); ?>

                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="empresa">Empresa<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <select id="empresa" name="empresa" class="select-chosen" data-placeholder="Seleccione la empresa del taxi" style="width: 250px;">
                  <option value=""disabled selected>Seleccione la empresa</option>
                  <?php echo listaEmpresasFacade(); ?>
                </select>
                <input type="hidden" id="ultimo_pago" name="ultimo_pago" class="form-control" value="2030-12-30" >
              </div>
            </div>
            <div class="form-group" id="factorCalidad">

            </div>

            <div class="form-group ">
              <div class="col-md-8 col-md-offset-4">
                <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Agregar</button>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#marca').change(function(){
      $('#marca option:selected').each(function(){
        var marca = $(this).val();
        var data = {idMarca: marca};
        $.post("../../controllers/app/validarLineaController.php", data, function(datos){
          $("#lineas").html(datos);
        });
      });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#empresa').change(function(){
      $('#empresa option:selected').each(function(){
        var idEmpresa = $(this).val();
        var data = {id: idEmpresa};
        $.post("../../controllers/app/validadorFactorCalidadController.php", data, function(datos){
          $("#factorCalidad").html(datos);
        });
      });
    });
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
