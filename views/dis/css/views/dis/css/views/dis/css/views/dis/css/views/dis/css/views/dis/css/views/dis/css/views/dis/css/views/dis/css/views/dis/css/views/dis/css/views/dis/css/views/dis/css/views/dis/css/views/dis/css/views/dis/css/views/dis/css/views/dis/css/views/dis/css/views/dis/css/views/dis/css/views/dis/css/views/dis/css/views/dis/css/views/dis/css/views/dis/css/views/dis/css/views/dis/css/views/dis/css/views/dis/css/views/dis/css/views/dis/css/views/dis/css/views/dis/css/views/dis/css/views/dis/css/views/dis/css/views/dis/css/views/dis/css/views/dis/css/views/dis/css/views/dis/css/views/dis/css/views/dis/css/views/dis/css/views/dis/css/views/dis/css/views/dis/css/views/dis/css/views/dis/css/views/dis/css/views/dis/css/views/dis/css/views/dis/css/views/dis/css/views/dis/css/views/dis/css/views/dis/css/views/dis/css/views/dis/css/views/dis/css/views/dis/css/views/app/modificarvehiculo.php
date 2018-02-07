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
$idVehiculo = $_GET['id_vehiculo'];

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
          <i class="fa fa-edit"></i>Modificar Vehículo<br><small>Complete el siguiente formulario para modificar un nuevo vehículo</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="home.php">Incio</a></li>
      <li>Modificar Vehículo</li>
    </ul>
  </div>
  <!-- END Mini Top Stats Row -->

  <!-- Widgets Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="block">
        <div class="block-title">
          <h2><strong>Modificar Vehículo</strong></h2>
        </div>
          <?php echo modificarVehiculoFacade($idVehiculo); ?>
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
<?php
require_once('../inc/fin_template.php');
 ?>
 <?php
} else{
header("Location: ../mensajes/error_autenticacion.html");
}
?>
