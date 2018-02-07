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
require_once('../../models/driversCars.php');
require_once('../../models/brandsCars.php');
require_once('../../models/lineCars.php');
require_once('../../models/company.php');
require_once('../../facades/carsFacades.php');
require_once('../../facades/driversFacade.php');
require_once('../../facades/brandsCarFacade.php');
require_once('../../facades/lineCarsFacade.php');
require_once('../../facades/companyFacade.php');
$idConductor = $_GET['id_conductor'];

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
          <i class="fa fa-edit"></i>Modificar Conductor<br><small>Complete el siguiente formulario para modificar el conductor</small>
        </h1>
      </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
      <li><a href="home.php">Incio</a></li>
      <li>Modificar conductor</li>
    </ul>
  </div>
  <!-- END Mini Top Stats Row -->

  <!-- Widgets Row -->
  <div class="row">

    <div class="col-md-12">
      <div class="block">
        <div class="block-title">
          <h2><strong>Modificar Conductor</strong></h2>
        </div>
        <!-- Clickable Wizard Content -->
            <?php echo modificarConductorDocumentoFacade($idConductor); ?>
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

                            <div class="col-md-8" align=center>
                                <video id="video" width="400" height="300" align=center>

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
<!--<script src="../dis/js/pages/formsValidation.js"></script>-->
<script src="../dis/js/pages/formsWizard.js"></script>
<script>$(function(){ FormsWizard.init(); });</script>
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
<script src="../dis/js/roteJs.js"></script>
<script type="text/javascript">

  function girar0(){
    $("#documento1").rotate({angle:0});
  }
  function girar90(){
    $("#documento1").rotate({angle:90});
  }
  function girar180(){
    $("#documento1").rotate({angle:180});
  }
  function girar270(){
    $("#documento1").rotate({angle:270});
  }
  //documento2
  function girar02(){
    $("#documento2").rotate({angle:0});
  }
  function girar902(){
    $("#documento2").rotate({angle:90});
  }
  function girar1802(){
    $("#documento2").rotate({angle:180});
  }
  function girar2702(){
    $("#documento2").rotate({angle:270});
  }
  //documento3
  function girar03(){
    $("#documento3").rotate({angle:0});
  }
  function girar903(){
    $("#documento3").rotate({angle:90});
  }
  function girar1803(){
    $("#documento3").rotate({angle:180});
  }
  function girar2703(){
    $("#documento3").rotate({angle:270});
  }
  //documento4
  function girar04(){
    $("#documento4").rotate({angle:0});
  }
  function girar904(){
    $("#documento4").rotate({angle:90});
  }
  function girar1804(){
    $("#documento4").rotate({angle:180});
  }
  function girar2704(){
    $("#documento4").rotate({angle:270});
  }
</script>

<?php
require_once('../inc/fin_template.php');
 ?>
 <?php
} else{
header("Location: ../mensajes/error_autenticacion.html");
}
?>
