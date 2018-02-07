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
require_once('../../models/company.php');
require_once('../../models/cmsCountries.php');
require_once('../../models/cmsDepartments.php');
require_once('../../models/cmsCities.php');
require_once('../../facades/companyFacade.php');
require_once('../../facades/cmsCitiesFacades.php');
require_once('../../facades/cmsCountriesFacade.php');
require_once('../../facades/cmsDepartmentsFacade.php');

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
          <i class="fa fa-cab"></i>Agregar Empresa<br><small>Complete el siguiente formulario para agregar una nueva empresa de taxis</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="home.php">Incio</a></li>
      <li>Crear Empresa de taxis</li>
    </ul>
  </div>
  <!-- END Mini Top Stats Row -->

  <!-- Widgets Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="block">
        <div class="block-title">
          <h2><strong>Agregar Nueva empresa</strong></h2>
        </div>
        <form id="form-empresa" action="../../controllers/app/agregarEmpresaTaxisController.php" method="post" class="form-horizontal form-bordered">
          <fieldset>
            <legend><i class="fa fa-angle-right"></i> Datos de la empresa</legend>

            <div class="form-group">
              <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Digite el nombre de la empresa" >
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label" for="descripcion">Descripción<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <input type="text" id="descripcion" name="descripcion" class="form-control" placeholder="Digite la descripción de la empresa" >
              </div>
              <div class="col-md-6">
                <input type="hidden" id="_token" name="_token" class="form-control" value="<?php echo NoCSRF::generate('_token')?>">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="pais">País<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <!--<select id="pais" name="pais" class="select-chosen" data-placeholder="Seleccione el país de la empresa" style="width: 250px;">-->
                <select type="text" class="form-control" name="pais" id="pais">
                  <option value=""disabled selected>Seleccione el país de la empresa</option>
                  <?php echo listaPaisesFacade(); ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="departamento">Departamento<span class="text-danger">*</span></label>
              <div class="col-md-6">
                 <select type="text" class="form-control" name="departamento" id="departamento">

                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="ciudad">Ciudad<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <!--<select id="ciudad" name="ciudad" class="select-chosen" data-placeholder="Seleccione la ciudad de la empresa" style="width: 250px;">-->
                <select type="text" class="form-control" name="ciudad" id="ciudad">

                </select>
              </div>
            </div>

            <div class="form-group" id="afiliado">

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
<script src="../dis/js/pages/validadorEmpresa.js"></script>
<script>$(function(){ ValidadorEmpresa.init(); });</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#pais').change(function(){
      $('#ciudad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
      $('#pais option:selected').each(function(){
        var idPais = $(this).val();
        var data = {id: idPais};
        $.post("../../controllers/app/validadorPaisController.php", data, function(datos){
          $("#departamento").html(datos);
        });
      });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#departamento').change(function(){
      $('#departamento option:selected').each(function(){
        var departamentoid = $(this).val();
        var data = {departamento: departamentoid};
        $.post("../../controllers/app/validadorDepartamentoController.php", data, function(datos){
          $("#ciudad").html(datos);
        });
      });
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#ciudad').change(function(){
      $('#ciudad option:selected').each(function(){
        var idCiudad = $(this).val();
        var data = {id: idCiudad};
        $.post("../../controllers/app/validadorEmpresaAfiliadoController.php", data, function(datos){
          $("#afiliado").html(datos);
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
