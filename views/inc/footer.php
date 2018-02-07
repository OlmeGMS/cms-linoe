
<!-- Footer -->
    <footer class="clearfix">
        <div class="pull-right">
        Desarollado  <i class="fa fa-heart text-danger"></i> por <a href="" target="_blank">TaxisYa</a>
        </div>
        <div class="pull-left">
         <span id="year-copy"></span> &copy; <a href="javascript:void(0)">TaxisYa</a>
        </div>
        
        <div class="" id="cancelarServiciosAutoDiv">

        </div>
    </footer>

<!-- END Footer -->
   </div>
<!-- END Main Container -->
  </div>
<!-- END Page Container -->
  </div>

<!-- END Page Wrapper -->
<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
<div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header text-center">
                <h2 class="modal-title"><i class="fa fa-pencil"></i> Configuración</h2>
            </div>
            <!-- END Modal Header -->

            <!-- Modal Body -->
            <div class="modal-body">
                <form action="../../controllers/cambiarContrasenaController.php" method="post" class="form-horizontal form-bordered">
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
                        <legend>Actualizar Password</legend>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-password">Nuevo Password</label>
                            <div class="col-md-8">
                                <input type="hidden" id="idUsuario" name="idUsuario" class="form-control" value="<?php echo $idUsuario ?>">
                                <input type="password" id="user-settings-password" name="user-settings-password" class="form-control" placeholder="Por favor digite su nuevo password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="user-settings-repassword">Confirmar Nuevo Password</label>
                            <div class="col-md-8">
                                <input type="password" id="user-settings-repassword" name="user-settings-repassword" class="form-control" placeholder="Confirme por favor su nuevo password">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group form-actions">
                        <div class="col-xs-12 text-right">
                            <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-sm btn-primary">Guardar Cambio</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- END Modal Body -->
        </div>
    </div>
</div>
<!-- END User Settings -->
