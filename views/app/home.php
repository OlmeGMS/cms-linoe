
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
   ?>
   <!-- Page content -->
                      <div id="page-content">
                          <!-- Dashboard 2 Header -->
                          <?php
                                switch ($rol) {
                                  case '1':
                                            echo '<div class="content-header">
                                                <ul class="nav-horizontal text-center">
                                                    <li class="active">
                                                        <a href="home.php"><i class="fa fa-cab"></i> Inicio</a>
                                                    </li>
                                                    <li>
                                                        <a href="usuariosCms"><i class="fa fa-user"></i> Usuarios</a>
                                                    </li>
                                                    <li>
                                                        <a href="listaVehiculos"><i class="fa fa-car"></i> Vehículos</a>
                                                    </li>
                                                    <li>
                                                        <a href="listaConductores"><i class="fa fa-tachometer"></i> Conductores</a>
                                                    </li>
                                                    <li>
                                                        <a href="servicioEstado"><i class="fa fa-database"></i> Servicios</a>
                                                    </li>
                                                    <li>
                                                        <a href="buscadorVale"><i class="fa fa-ticket"></i> Vales</a>
                                                    </li>

                                                </ul>
                                            </div>';
                                    break;

                                    case '2':
                                              echo '<div class="content-header">
                                                  <ul class="nav-horizontal text-center">
                                                      <li class="active">
                                                          <a href="home.php"><i class="fa fa-cab"></i> Inicio</a>
                                                      </li>
                                                      <li>
                                                          <a href="usuariosCms"><i class="fa fa-user"></i> Usuarios</a>
                                                      </li>
                                                      <li>
                                                          <a href="listaVehiculos"><i class="fa fa-car"></i> Vehículos</a>
                                                      </li>
                                                      <li>
                                                          <a href="listaConductores"><i class="fa fa-tachometer"></i> Conductores</a>
                                                      </li>
                                                      <li>
                                                          <a href="servicioEstado"><i class="fa fa-database"></i> Servicios</a>
                                                      </li>
                                                      <li>
                                                          <a href="buscadorVale"><i class="fa fa-ticket"></i> Vales</a>
                                                      </li>
                                                      <li>
                                                          <a href="" id="secMovilidad"><i class="fa fa-desktop"></i> Sec. Movilidad</a>
                                                      </li>

                                                  </ul>
                                              </div>';
                                      break;
                                      case '3':
                                                echo '<div class="content-header">
                                                    <ul class="nav-horizontal text-center">
                                                        <li class="active">
                                                            <a href="home.php"><i class="fa fa-cab"></i> Inicio</a>
                                                        </li>
                                                        <li>
                                                            <a href="listaVehiculos"><i class="fa fa-car"></i> Vehículos</a>
                                                        </li>
                                                        <li>
                                                            <a href="listaConductores"><i class="fa fa-tachometer"></i> Conductores</a>
                                                        </li>
                                                        <li>
                                                            <a href="servicioEstado"><i class="fa fa-database"></i> Servicios</a>
                                                        </li>

                                                    </ul>
                                                </div>';
                                        break;
                                        case '4':
                                                  echo '<div class="content-header">
                                                      <ul class="nav-horizontal text-center">
                                                          <li class="active">
                                                              <a href="home.php"><i class="fa fa-cab"></i> Inicio</a>
                                                          </li>
                                                          <li>
                                                              <a href="listaVehiculos"><i class="fa fa-car"></i> Vehículos</a>
                                                          </li>
                                                          <li>
                                                              <a href="listaConductores"><i class="fa fa-tachometer"></i> Conductores</a>
                                                          </li>
                                                          <li>
                                                              <a href="servicioEstado"><i class="fa fa-database"></i> Servicios</a>
                                                          </li>
                                                          <li>
                                                              <a href="buscarEmpresapagos"><i class="fa fa-dollar"></i> Pagos</a>
                                                          </li>


                                                      </ul>
                                                  </div>';
                                          break;
                                          case '5':
                                                    echo '<div class="content-header">
                                                        <ul class="nav-horizontal text-center">
                                                            <li class="active">
                                                                <a href="home.php"><i class="fa fa-cab"></i> Inicio</a>
                                                            </li>
                                                            <li>
                                                                <a href="servicioEstado"><i class="fa fa-database"></i> Servicios</a>
                                                            </li>

                                                        </ul>
                                                    </div>';
                                            break;

                                            case '6':
                                                      echo '<div class="content-header">
                                                          <ul class="nav-horizontal text-center">
                                                              <li class="active">
                                                                  <a href="home.php"><i class="fa fa-cab"></i> Inicio</a>
                                                              </li>
                                                              <li>
                                                                  <a href="servicioEstado"><i class="fa fa-database"></i> Servicios</a>
                                                              </li>

                                                          </ul>
                                                      </div>';
                                              break;


                                  default:
                                   echo '<div class="content-header">
                                      <ul class="nav-horizontal text-center">
                                          <li class="active">
                                              <a href="home.php"><i class="fa fa-cab"></i> Inicio</a>
                                          </li>
                                      </ul>
                                  </div>';
                                    break;
                                }
                           ?>

                          <!-- END Dashboard 2 Header -->

                          <!-- Dashboard 2 Content -->
                          <div class="row">
                              <div class="col-md-12">
                                  <!-- Web Server Block -->
                                  <div class="block full">
                                      <!-- Web Server Title -->
                                      <div class="block-title">
                                          <div class="block-options pull-right">
                                              <span id="dash-chart-live-info" class="label label-primary"><script>
                                    var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                                    var f=new Date();
                                    document.write(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
                                  </script></span>
                                              <span class="label label-success animation-pulse">Activo</span>
                                          </div>
                                          <h2><strong>¡ Bienvenidos a TaxisYa!</strong></h2>
                                      </div>
                                      <!-- END Web Server Title -->

                                      <!-- Web Server Content -->
                                      <!-- Flot Charts (initialized in js/pages/index2.js), for more examples you can check out http://www.flotcharts.org/ -->
                                      <div id="dash-chart-live" class="chart">
                                        <input type="hidden" name="idCompania" id="idCompania" value="<?php echo $idCompania ?>">
                                        <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $idUsuario ?>">
                                        <input type="hidden" name="idCentroCosto" id="idCentroCosto" value="<?php echo $idCentroCostos?>">
                                        <span id="mensaje_factura" class="hidden"></span>
                                        <span id="control_vencimiento" class="hidden"></span>
                                        <span id="control_admin" class="hidden"></span>
                                          <center><img align="center" src="../dis/img/taxi.jpg"  class="chart" ></center>
                                      </div>
                                      <!-- END Web Server Content -->
                                  </div>

                                  <!-- END Web Server Block -->

                                  <!-- Mini Sales Charts Block -->
                                  <!-- Jquery Sparkline (initialized in js/pages/index2.js), for more examples you can check out http://omnipotent.net/jquery.sparkline/#s-about -->
                                  <div class="block full">
                                      <!-- Mini Sales Charts Title -->
                                      <div class="block-title">

                                          <h2><strong><i class="fa fa-car"></i>TaxisYa - </strong>Administración de los servicios</h2>
                                      </div>
                                      <!-- END Mini Sales Charts Title -->

                                      <!-- Mini Sales Charts Content -->
                                      <div class="row text-justify">
                                          <p>Por medio de este portal usted podra gestionar los servicios y el parque automotor de TaxisYa.</p>
                                      </div>
                                      <!-- END Mini Sales Charts Content -->
                                  </div>
                                  <!-- END Mini Sales Charts Block -->


                                      <!-- END Mini Earnings Charts Content -->
                                  </div>
                                  <!-- END Mini Earnings Charts Block -->



                          </div>
                          <!-- END Dashboard 2 Content -->
                      </div>
                      <!-- END Page Content -->
  <?php
  require_once('../inc/footer.php');
  require_once('../inc/script.php');

  if ($role == 'admin') {
    echo '
        <script src="../dis/js/pages/alertasPresupuesto.js"></script>
        <script>$(function(){ alertasPresupuesto.init(); });</script>

        <script src="../dis/js/pages/vencerVales.js"></script>
        <script>$(function(){ vencerVales.init(); });</script>

        <script src="../dis/js/pages/conteoGastoAdmin.js"></script>
        <script>$(function(){ conteoGastoAdmin.init(); });</script>
    ';
  }elseif ($role == 'manager') {
    echo '
        <script src="../dis/js/pages/alertaPresupuestoManager.js"></script>
        <script>$(function(){ alertasPresupuestoManager.init(); });</script>

        <script src="../dis/js/pages/vencerVales.js"></script>
        <script>$(function(){ vencerVales.init(); });</script>
    ';
  }

  ?>

  <!-- Load and execute javascript code used only in this page -->
  <!--<script type="text/javascript">
    $('#secMovilidad').click(function(){
      var usu = 'user';
      var pass = '12345';
      var datas = {usuario: usu, password: pass};
      $.ajax({
        url : "http://localhost/pruebasScre/login.php",
        method: "POST",
        data : datas,
        dataType : "JSON",
        success:function(data){
          var token = data.token;
          alert(token);
          console.log(response);
        },
        error:function(error){
           alert('mal');
           console.log(error);
        }

      });

    });
  </script>-->

  <script src="../dis/js/push.min.js"></script>
  <script src="../dis/js/pages/index.js"></script>
  <script>
      $(function() {
          Index.init();
      });
  </script>
  <script>
    window.onload = function(){
        Push.Permission.request();
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
