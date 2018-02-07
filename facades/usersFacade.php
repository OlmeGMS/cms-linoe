<?php
function listaUsersFacade(){
  $consulta = new Users();
  $filas = $consulta->todosUsersUltimos();
  foreach($filas as $fila){
    $nombre = $fila['name'];
    $apellido = $fila['lastname'];
    $nombreCompleto = "$nombre $apellido";

    echo '
    <tr>
        <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="nombre_usuario" name ="" class="text-center">'.$nombreCompleto.'</td>
        <td id="email_usuario" name ="" class="text-center">'.$fila['email'].'</td>
        <td id="email_usuario" name ="" class="text-center">'.$fila['cellphone'].'</td>';
        if ($fila['type'] == 1) {
          echo '<td id="dispositivo" name ="" class="text-center"><span class="fa fa-apple"></span></td>';
        }else{
          echo '<td id="dispositivo" name ="" class="text-center"><span class="fa fa-android"></span></td>';
        }
        echo'<td id="accion" class="text-center">
              <div class="btn-group btn-group-xs">
                  <a id="editar_usuario" href="modificarUsuarioApp?id_app='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-info" style="width: 15px;"></i></a>
                  <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_usuarioApp"><i class="fa fa-times"></i></a>
              </div>
        </td>

     </tr>';
  }

}

function verUsuarioApp($arg_id){
  $consulta = new Users();
  $idUserApp = $arg_id;
  $filas = $consulta->cargarUsuarioApp($idUserApp);
  foreach($filas as $fila){
    $nombre = $fila['name'];
    $apellido = $fila['lastname'];
    $nombreCompleto = "$nombre $apellido";
    $dispostivo = $fila['type'];
    if ($dispostivo == 1) {
      $marca = 'Apple  <i class="fa fa-apple"></i>';
    }else{
      $marca = 'Android  <i class="fa fa-android"></i>';
    }
    echo '
    <form action="usuariosApp" method="post" class="form-horizontal form-bordered">
      <fieldset>

        <legend><i class="fa fa-angle-right"></i> Datos del usuario</legend>
        <div class="form-group">
          <label class="col-md-4 control-label" for="nombre">Nombre</label>
          <div class="col-md-6">
            <p type="text" id="nombre" name="nombre" class="form-control" value="">'.$nombreCompleto .'</p>
          </div>

        </div>


        <div class="form-group">
          <label class="col-md-4 control-label" for="email">Email</label>
          <div class="col-md-6">
            <p type="email" id="email" name="email" class="form-control" value="">'.$fila['email'].'</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="Documento">Celular</label>
          <div class="col-md-6">
            <p type="text" id="Documento" name="Documento" class="form-control" value="">'.$fila['cellphone'].'</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="Documento">Fecha Creación</label>
          <div class="col-md-6">
            <p type="text" id="Documento" name="Documento" class="form-control" value="">'.$fila['created_at'].'</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="Documento">Fecha Actualización</label>
          <div class="col-md-6">
            <p type="text" id="Documento" name="Documento" class="form-control" value="">'.$fila['updated_at'].'</p>
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label" for="Documento">Dispositivo</label>
          <div class="col-md-6">
            <p type="text" id="Documento" name="Documento" class="form-control" value="">'.$marca.'</p>
          </div>
        </div>
<br>

        <div class="form-group ">
          <div class="col-md-8 col-md-offset-4">
            <!--<button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Editar usuario</button>-->
            <button href="usuariosApp" type="" id="btn-volver" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Volver</button>
          </div>
        </div>
      </fieldset>
      </form>

    ';
  }
}

function listaUsersBusquedaFacade($arg_item, $arg_frase){
  $consulta = new Users();
  $item = $arg_item;
  $frase = $arg_frase;
  $filas = $consulta->busquedaPersonalizdaUsuario($item, $frase);
  foreach($filas as $fila){
    $nombre = $fila['name'];
    $apellido = $fila['lastname'];
    $nombreCompleto = "$nombre $apellido";

    echo '
    <tr>
        <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="nombre_usuario" name ="" class="text-center">'.$nombreCompleto.'</td>
        <td id="email_usuario" name ="" class="text-center">'.$fila['email'].'</td>
        <td id="email_usuario" name ="" class="text-center">'.$fila['cellphone'].'</td>';
        if ($fila['type'] == 1) {
          echo '<td id="dispositivo" name ="" class="text-center"><span class="fa fa-apple"></span></td>';
        }else{
          echo '<td id="dispositivo" name ="" class="text-center"><span class="fa fa-android"></span></td>';
        }
        echo'<td id="accion" class="text-center">
              <div class="btn-group btn-group-xs">
                  <a id="editar_usuario" href="modificarUsuarioApp?id_app='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-info" style="width: 15px;"></i></a>
                  <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_usuarioCms"><i class="fa fa-times"></i></a>
              </div>
        </td>

     </tr>';
  }

}

function listaUsersBusquedaFechaFacade($arg_item, $arg_frase, $arg_fecha1, $arg_fecha2){
  $consulta = new Users();
  $item = $arg_item;
  $frase = $arg_frase;
  $fecha1 = $arg_fecha1;
  $fecha2 = $arg_fecha2;
  $filas = $consulta->busquedaXFecha($item, $frase, $fecha1, $fecha2);
  foreach($filas as $fila){
    $nombre = $fila['name'];
    $apellido = $fila['lastname'];
    $nombreCompleto = "$nombre $apellido";

    echo '
    <tr>
        <td id="id_usuario" name ="" class="text-center">'.$fila['id'].'</td>
        <td id="nombre_usuario" name ="" class="text-center">'.$nombreCompleto.'</td>
        <td id="email_usuario" name ="" class="text-center">'.$fila['email'].'</td>
        <td id="email_usuario" name ="" class="text-center">'.$fila['cellphone'].'</td>';
        if ($fila['type'] == 1) {
          echo '<td id="dispositivo" name ="" class="text-center"><span class="fa fa-apple"></span></td>';
        }else{
          echo '<td id="dispositivo" name ="" class="text-center"><span class="fa fa-android"></span></td>';
        }
        echo'<td id="accion" class="text-center">
              <div class="btn-group btn-group-xs">
                  <a id="editar_usuario" href="modificarUsuarioApp?id_app='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-info" style="width: 15px;"></i></a>
                  <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_usuarioCms"><i class="fa fa-times"></i></a>
              </div>
        </td>

     </tr>';
  }

}

 ?>
