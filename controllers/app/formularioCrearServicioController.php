<?php
require_once('../../models/conexion.php');
require_once('../../models/users.php');
require_once('../../models/usersDirs.php');
require_once('../../models/barrio.php');


$dir = $_POST['id'];

$consulta = new Users();
$consultaDir = new UsersDirs();
$consultaBarrio = new Barrio();

$barrios = $consultaBarrio->todosBarrios();
$filas = $consultaDir->direccionExpesifica($dir);

foreach($filas as $fila){
  $index = $fila['index_id'];
  $com1 = $fila['comp1'];
  $com2 = $fila['comp2'];
  $no = $fila['no'];
  $barrio = $fila['barrio'];
}

  echo '  <div class="form-group">
          <label class="col-md-2 control-label" for="dir">Dirección<span class="text-danger">*</span></label>
          <div class="col-md-2">
            <select class="form-control" name="dir" id="dir">
            <option value="'.$fila['index_id'].'"selected>'.$fila['index_id'].'</option>
            <option value="Calle">Calle</option>
            <option value="Carrera">Carrera</option>
            <option value="Diagonal">Diagonal</option>
            <option value="Transversal">Transversal</option>
            </select>
            <!--<input type="text" id="dir" name="dir" class="form-control" placeholder="Digite el número telefónico" value="'.$fila['index_id'].'" style="text-align: center;"required>-->
          </div>
          <div class="col-md-2">
            <input type="text" id="nombre_direccion" name="nombre_direccion" class="form-control" placeholder="Digite el número telefónico" value="'.$fila['comp1'].'"required>
          </div>
          <div class="col-md-2">
            <input type="text" id="ndos" name="ndos" class="form-control" placeholder="Digite el número telefónico" value="'.$fila['comp2'].'"required>
          </div>
          <div class="col-md-2">
            <input type="text" id="noo" name="noo" class="form-control" placeholder="Digite el número telefónico" value="'.$fila['no'].'"required>
          </div>
          <div class="col-md-2">
            <input type="hidden" id="usuarioDir" name="usuarioDir" class="form-control" placeholder="Digite el número telefónico" value="'.$fila['user_id'].'"required>
          </div>
        </div>
        </div>
        <!--<fieldset>
        <div class="form-group">
          <label class="col-md-4 control-label" for="barrio">Barrio<span class="text-danger">*</span></label>
          <div class="col-md-6">
            <input type="text" id="barrio" name="barrio" class="form-control" placeholder="Digite el barrio" value="'.$barrio.'" required>
          </div>
        </div>
        </fieldset>-->
        <?php $colonia = $barrio;  echo $colonia?>
';






 ?>
