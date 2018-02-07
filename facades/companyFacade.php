<?php
function listaEmpresasFacade(){
  $consulta = new Company();
  $empresas = $consulta->listaEmpresasActivas();
  foreach ($empresas as $empresa) {
    echo '<option value="'.$empresa['id'].'">'.$empresa['name_company'].'</option>';
  }
}

function listaEmpresasAfiliadasAppFacade(){
  $consulta = new Company();
  $empresas = $consulta->listaEmpresasAfiliadasApp();
  foreach ($empresas as $empresa) {
    echo '<option value="'.$empresa['id'].'">'.$empresa['name_company'].'</option>';
  }
}

function tablaEmpresasFacade($arg_rol){

  $consulta = new Company();
  $consultaPais = new CmsCountries();
  $consultaDepartamento = new CmsDepartments();
  $consultaCiudad = new CmsCities();
  $filas = $consulta->listaEmpresasActivas();
  $rol = $arg_rol;
  echo'<table id="table-conductor" class="table table-bordered table-striped table-vcenter">
      <thead>
          <tr>
              <th class="text-center" style="width: 80px;">ID</th>
              <th class="text-center">Nombre</th>
              <th class="text-center">Descripción</th>
              <th class="text-center">Ciudad</th>
              <th class="text-center">Departamento</th>
              <th class="text-center">País</th>
              <th class="text-center">Sec. Bogotá</th>
              <th class="text-center">Afiliado app</th>
              <th class="text-center">Acción</th>
          </tr>
      </thead>
      <tbody>';
    foreach ($filas as $fila) {
      $ciudad = $fila['id_cities'];
      $departamento = $fila['id_departments'];
      $pais = $fila['id_contry'];
      $secretaria = $fila['secretary_bog'];
      $app = $fila['app_taxisya'];
      if ($secretaria == 1) {
        $datos = '<span class="label label-info">Si</span>';
      }else {
        $datos = '<span class="label label-info">No</span>';
      }
      if ($app == 1) {
        $taxisYa = '<span class="label label-success">Si</span>';
      }else {
        $taxisYa = '<span class="label label-danger">No</span>';
      }

      $nombreCiudad = $consultaCiudad->obtenerNombreCiudad($ciudad);
      $nombreDepartamento = $consultaDepartamento->obtenerNombreDepartamento($departamento);
      $nombrePais = $consultaPais->obtenerNombrePais($pais);

      echo '
      <td id="empresa_id" name ="" class="text-center">'.$fila['id'].'</td>
      <td id="" name ="" class="text-center">'.$fila['name_company'].'</td>
      <td id="" name ="" class="text-center">'.$fila['description'].'</td>
      <td id="" name ="" class="text-center">'.$nombreCiudad.'</td>
      <td id="" name ="" class="text-center">'.$nombreDepartamento.'</td>
      <td id="" name ="" class="text-center">'.$nombrePais.'</td>
      <td id="" name ="" class="text-center">'.$datos.'</td>
      <td id="" name ="" class="text-center">'.$taxisYa.'</td>
      <td class="text-center">
            <div class="btn-group btn-group-xs">';
                if($rol == 1 || $rol == 2){
                  echo '
                  <a href="modificarempresataxi?id_empresa='.$fila['id'].'" data-toggle="tooltip" title="Editar" class="btn btn-default" ><i class="fa fa-pencil"></i></a>
                  <a href="" data-toggle="tooltip" title="Eliminar" class="btn btn-xs btn-danger" id="Eliminar_empresa"><i class="fa fa-times"></i></a>
                  ';
                }else {
                  echo'
                    <a href="javascript:void(0)" data-toggle="tooltip" title="Bloqueado" class="btn btn-xs btn-info" id=""><i class="fa fa-lock"></i></a>
                  ';
                }
  echo '
            </div>
        </td>

       </tr>';
    }
    echo '<!-- END Responsive Full Block -->
    </tbody>
    </table>';

}

function modificarEmpresaFacade($arg_idEmpresa){
  if (isset($_GET['id_empresa'])){
    $consulta = new Company();
    $consultaPais = new CmsCountries();
    $consultaDepartamento = new CmsDepartments();
    $consultaCiudad = new CmsCities();
    $idEmpresa = $arg_idEmpresa;
    $filas = $consulta->cargarEmpresa($idEmpresa);


    foreach ($filas as $fila) {
      $pais = $consultaPais->obtenerNombrePais($fila['id_contry']);
      $departamento = $consultaDepartamento->obtenerNombreDepartamento($fila['id_departments']);
      $ciudad = $consultaCiudad->obtenerNombreCiudad($fila['id_cities']);
      $idCiudad = $fila['id_cities'];
      $appTaxi = $fila['app_taxisya'];
      echo '
      <form id="form-empresa" action="../../controllers/app/modificarEmpresaTaxisController.php" method="post" class="form-horizontal form-bordered">
        <fieldset>
          <legend><i class="fa fa-angle-right"></i> Datos de la empresa</legend>

          <div class="form-group">
            <label class="col-md-4 control-label" for="nombre">Nombre<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text" id="nombre" name="nombre" class="form-control" value="'.$fila['name_company'].'" >
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-4 control-label" for="descripcion">Descripción<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <input type="text" id="descripcion" name="descripcion" class="form-control" value="'.$fila['description'].'" >
            </div>
            <div class="col-md-6">
              <input type="hidden" id="_token" name="_token" class="form-control" value="'.NoCSRF::generate('_token').'">
            </div>
            <div class="col-md-6">
              <input type="hidden" id="id_empresa" name="id_empresa" class="form-control" value="'.$idEmpresa.'" >
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="pais">País<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <!--<select id="pais" name="pais" class="select-chosen" data-placeholder="Seleccione el país de la empresa" style="width: 250px;">-->
              <select type="text" class="form-control" name="pais" id="pais">
                <option value="'.$fila['id_contry'].'"selected>'.$pais.'</option>';
                echo listaPaisesFacade();
              echo '</select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="departamento">Departamento<span class="text-danger">*</span></label>
            <div class="col-md-6">
               <select type="text" class="form-control" name="departamento" id="departamento">
                    <option value="'.$fila['id_departments'].'"selected>'.$departamento.'</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-md-4 control-label" for="ciudad">Ciudad<span class="text-danger">*</span></label>
            <div class="col-md-6">
              <!--<select id="ciudad" name="ciudad" class="select-chosen" data-placeholder="Seleccione la ciudad de la empresa" style="width: 250px;">-->
              <select type="text" class="form-control" name="ciudad" id="ciudad">
                  <option value="'.$fila['id_cities'].'"selected>'.$ciudad.'</option>
              </select>
            </div>
          </div>';

          if ($idCiudad == 1) {
            if ($appTaxi == 1) {
              echo '
              <div class="form-group" id="afiliado">
              <label class="col-md-4 control-label" for="">Afiliada app TaxisYa<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <label class="switch switch-danger"><input type="checkbox" name="afiliacion" value="afiliacion" checked><span></span></input></label>
              </div>
              </div>
              ';
            }else {
              echo '
              <div class="form-group" id="afiliado">
              <label class="col-md-4 control-label" for="">Afiliada app TaxisYa<span class="text-danger">*</span></label>
              <div class="col-md-6">
                <label class="switch switch-danger"><input type="checkbox" name="afiliacion" value="afiliacion"><span></span></input></label>
              </div>
              </div>
              ';
            }
          }else {
            echo '


            ';
          }



        echo '<div class="form-group ">
            <div class="col-md-8 col-md-offset-4">
              <button href="" type="submit" class="btn btn-sm btn-success"><i class="fa fa-arrow-right"></i> Modificar</button>
              <button id="btn-eliminar" type="reset" class="btn btn-sm btn-warning"><i class="fa fa-repeat"></i> Limpiar</button>
            </div>
          </div>
        </fieldset>
      </form>
      ';
    }

  }else {
    return header("Location: ../views/app/listaEmpresas");
  }

}


 ?>
