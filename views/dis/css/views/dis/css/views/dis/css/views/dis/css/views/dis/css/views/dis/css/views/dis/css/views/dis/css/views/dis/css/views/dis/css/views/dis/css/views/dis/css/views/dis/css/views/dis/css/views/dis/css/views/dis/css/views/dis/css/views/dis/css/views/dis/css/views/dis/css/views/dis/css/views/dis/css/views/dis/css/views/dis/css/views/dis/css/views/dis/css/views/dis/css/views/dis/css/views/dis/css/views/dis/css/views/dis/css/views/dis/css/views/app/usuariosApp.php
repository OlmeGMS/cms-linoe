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
require_once('../../models/users.php');
require_once('../../facades/CmsUsersFacades.php');
require_once('../../facades/usersFacade.php');
$consulta = new Users();
?>
<!-- Page content -->
<div id="page-content">
    <!-- Table Responsive Header -->
    <div class="content-header">
        <div class="header-section">
            <h1>
                <i class="gi gi-iphone"></i>Usuarios Registrados<br><small>Aquí podras ver todos los usuarios registrados en el sistema!</small>
            </h1>
        </div>
    </div>
    <ul class="breadcrumb breadcrumb-top">
        <li>Tabla</li>
        <li><a href="">Consulta de usuarios Apps</a></li>
    </ul>
    <!-- END Table Responsive Header -->

    <!-- Responsive Full Block -->
    <div class="block full">
        <!-- All Orders Title -->
        <div class="block-title">
          <!--  <div class="block-options pull-right">
                <a href="javascript:void(0)" class="btn btn-alt btn-sm btn-default" data-toggle="tooltip" title="Configuración"><i class="fa fa-cog"></i></a>
            </div> -->
            <h2><strong>Todos</strong> Los Usuarios Apps</h2> <a href="crearUsuarioApp.php"><i class="fa fa-plus"></i>Crear Nuevo Usuario</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="$('#modal-search-user').modal('show');" id="btn-search-user"><i class="fa fa-search"></i>Busqueda personalizada</a>
            &nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" onclick="$('#modal-search-user-calendar').modal('show');" id="btn-search-user-calendar"><i class="fa fa-calendar"></i>Busqueda por fechas</a>
        </div>
        <!-- END All Orders Title -->
        <div class="table-responsive remove-margin-bottom">
        <!-- All Orders Content -->
        <table id="table-usuarios-app" class="table table-bordered table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" style="width: 100px;">ID</th>
                    <th class="text-center">Nombre</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Celular</th>
                    <th class="text-center">Sistema</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php echo listaUsersFacade(); ?>
    <!-- END Responsive Full Block -->
          </tbody>
        </table>
            <a id="reporteExcel" href="../../controllers/app/reportes/reporteExcelUsurioAppController.php" data-toggle="tooltip" title="Excel" class="btn btn-default" ><i class="fa fa-file-excel-o"></i></a>
          <!--  <a id="reportePDF" href="../../controllers/app/reportes/pdf/reportePdfUsuariosAppCotrollers.php" data-toggle="tooltip" title="PDF" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a> -->
      </div>
<!-- END All Orders Content -->



<!-- button export PFD -->
<!--<a href="../../reportePdf.php" data-toggle="tooltip" title="pdf" class="btn btn-default" ><i class="fa fa-file-pdf-o"></i></a>-->
</div>
<!-- END All Orders Block -->
</div>
<!-- END Page Content -->
<?php
require_once('../inc/footer.php');?>
<!-- Modal Busqueda-->
<div id="modal-search-user" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-search"></i> Busqueda</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="../../controllers/app/buscardorUsuarioAppController.php" method="post" class="form-horizontal form-bordered">
                    <fieldset>
                        <legend>Información</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Usuario</label>
                            <div class="col-md-8">
                                <p class="form-control-static"><?php echo $nombre ?></p>

                            </div>
                        </div>

                    </fieldset>
                    <fieldset>
                        <legend>Item de busqueda</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-password">Buscar por</label>
                            <div class="col-md-8">
                                <select type="text" id="item-busqueda" name="item-busqueda" class="form-control" placeholder="">
                                  <option value="" selected disabled>Seleccione el item de busqueda</option>
                                  <option value="name">Nombre</option>
                                  <option value="lastname">Apellido</option>
                                  <option value="email">Email</option>
                                  <option value="cellphone">Celular</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-repassword">Busqueda</label>
                            <div class="col-md-8">
                                <input type="text" id="frase" name="frase" class="form-control" placeholder="Digite la busqueda">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-sm btn-primary">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<div id="modal-search-user-calendar" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-calendar"></i> Busqueda</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="../../controllers/app/buscardorUsuarioAppFechaController.php" method="post" class="form-horizontal form-bordered">
                    <fieldset>
                        <legend>Información</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Usuario</label>
                            <div class="col-md-8">
                                <p class="form-control-static"><?php echo $nombre ?></p>

                            </div>
                        </div>

                    </fieldset>
                    <fieldset>
                        <legend>Item de busqueda</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-password">Buscar por</label>
                            <div class="col-md-8">
                                <select type="text" id="item-busqueda" name="item-busqueda" class="form-control" placeholder="">
                                  <option value="" selected disabled>Seleccione el item de busqueda</option>
                                  <option value="name">Nombre</option>
                                  <option value="lastname">Apellido</option>
                                  <option value="email">Email</option>
                                  <option value="cellphone">Celular</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-repassword">Busqueda</label>
                            <div class="col-md-8">
                                <input type="text" id="frase" name="frase" class="form-control" placeholder="Digite la busqueda">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="example-daterange1">Rango de fechas</label>
                            <div class="col-md-8">
                                <div class="input-group input-daterange" data-date-format="yyyy-mm-dd">
                                    <input type="text" id="fecha1" name="fecha1" class="form-control text-center" placeholder="Desde">
                                    <span class="input-group-addon"><i class="fa fa-angle-right"></i></span>
                                    <input type="text" id="fecha2" name="fecha2" class="form-control text-center" placeholder="Hasta">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-sm btn-primary">Buscar</button>
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

<script src="../dis/js/pages/tablaFinalizados.js"></script>
<script>$(function(){ TablesApp.init(); });</script>
<!-- Load and execute javascript code used only in this page -->
<script src="js/pages/uiProgress.js"></script>
<script>$(function(){ UiProgress.init(); });</script>

<script type="text/javascript">
$('tr #Eliminar_usuarioApp').click(function(e){

  e.preventDefault();
  var opcion = confirm('¿Esta seguro en eliminar este usuario?');
  if (opcion) {
    var fila = $(this).parent().parent().parent();
    var usuario = fila.find('#id_usuario').text();
    var data = {idUsuario: usuario};

    $.post("../../controllers/app/EliminarUsuarioAppController.php", data, function(res, est, jqXHR){
      alert('El usuario ha sido eliminado');
      fila.remove();
    });
  }
});
</script>

<?php
require_once('../inc/fin_template.php');
} else{
header("Location: ../mensajes/error_autenticacion.html");
}

?>
