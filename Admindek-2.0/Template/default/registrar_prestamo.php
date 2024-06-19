<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirigir a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login.php");
    exit();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sistema_pagos";
                
    $conn = new mysqli($servername, $username, $password, $dbname);
                
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>PagosConductores</title>
  <!-- php5 Shim and Respond.js IE10 support of php5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 10]>
      <script src="https://oss.maxcdn.com/libs/php5shiv/3.7.0/php5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Meta -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="description" content="Admindek Bootstrap admin template made using Bootstrap 5 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
      <meta name="keywords" content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
      <meta name="author" content="colorlib" />
      <!-- Favicon icon -->
      <link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">
      <!-- Google font-->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
      <!-- Required Fremwork -->
      <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/css/bootstrap.min.css">
      <!-- waves.css -->
      <link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
      <!-- feather icon -->
      <link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather.css">
      <!-- themify-icons line icon -->
      <link rel="stylesheet" type="text/css" href="../files/assets/icon/themify-icons/themify-icons.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" type="text/css" href="../files/assets/icon/font-awesome/css/font-awesome.min.css">
      <!-- Data Table Css -->
      <link rel="stylesheet" type="text/css" href="../files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" type="text/css" href="../files/assets/pages/data-table/css/buttons.dataTables.min.css">
      <link rel="stylesheet" type="text/css" href="../files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" type="text/css" href="../files/assets/pages/data-table/extensions/responsive/css/responsive.dataTables.css">
      <!-- Style.css -->
      <link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="../files/assets/css/pages.css">

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      
    </head>

    <body>
      <!-- [ Pre-loader ] start -->
      <div class="loader-bg">
        <div class="loader-bar"></div>
      </div>
      <!-- [ Pre-loader ] end -->
      <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
          <!-- [ Header ] start -->
          <?php include("menu2.php"); ?>
         <!-- [ chat user list ] start -->
           
            <!-- [ chat user list ] end -->

            <!-- [ chat message ] start -->
           
            <!-- [ chat message ] end -->


          <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
              <!-- [ navigation menu ] start -->
              <?php include("menu1.php"); ?>
              <!-- [ navigation menu ] end -->
              <?php
              error_reporting(0);
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "sistema_pagos";
                
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                if ($conn->connect_error) {
                    die("Conexión fallida: " . $conn->connect_error);
                }
              ?>
              <div class="pcoded-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="feather icon-inbox bg-c-yellow"></i>
                                <div class="d-inline">
                                    <h5>Préstamo</h5>
                                    <span>Información Préstamo</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- [ breadcrumb ] end -->
                <div class="pcoded-inner-content">
                  <!-- Main-body start -->
                  <div class="main-body">
                    <div class="page-wrapper">
                      <!-- Page-body start -->
                      <div class="page-body">
                        <!-- DOM/Jquery table start -->
                        <div class="card">
                          <div class="card-header">
                            <h5>Registrar Préstamo</h5>
                          </div>
                            <?php
                                // Obtener los parámetros de la URL
                                if (isset($_GET['conductor']) && isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin']) && isset($_GET['ciudad_partida']) && isset($_GET['ciudades_busqueda'])) {
                                    $conductor = htmlspecialchars($_GET['conductor']);
                                    $fechaInicio = htmlspecialchars($_GET['fecha_inicio']);
                                    $fechaFin = htmlspecialchars($_GET['fecha_fin']);
                                    $ciudad_partida = htmlspecialchars($_GET['ciudad_partida']);
                                    $ciudades_busqueda = htmlspecialchars($_GET['ciudades_busqueda']);
                                } else {
                                    echo "Faltan parámetros en la URL.";
                                    exit;
                                }
                            ?>
                          <div class="card-block">
                          <form action="guardar_prestamo.php" method="post">
                            <div class="row">
                                <div class="col-lg-4 col-xl-6 col-sm-12 m-b-30">
                                  <h4 class="sub-title text-center">Ciudad Personalizada</h4>
                                  <input type="text" name="conductor" id="conductor" value="<?php echo $conductor; ?>" class="form-control" readonly>
                                </div>
                                <div class="col-lg-4 col-xl-6 col-sm-12 m-b-30">
                                  <h4 class="sub-title text-center">Fecha Inicio</h4>
                                  <input class="form-control" name="fecha_inicio" id="fecha_inicio" type="date"  value="<?php echo $fechaInicio; ?>" readonly/>
                                </div>
                                <div class="col-lg-4 col-xl-6 col-sm-12 m-b-30">
                                  <h4 class="sub-title text-center">Fecha Final</h4>
                                  <input class="form-control" name="fecha_fin" id="fecha_fin" type="date" value="<?php echo $fechaFin; ?>" readonly/>
                                </div>
                                <div class="col-lg-4 col-xl-6 col-sm-12 m-b-30">
                                  <h4 class="sub-title text-center">Monto del Préstamo</h4>
                                  <input class="form-control" name="prestamo" id="prestamo" type="number"/>
                                </div>
                                <div class="col-lg-4 col-xl-12 col-sm-12"><br>
                                <input class="form-control" name="ciudad_partida" id="ciudad_partida" type="hidden" value="<?php echo $ciudad_partida; ?>" readonly/>
                                    <input class="form-control" name="ciudades_busqueda" id="ciudades_busqueda" type="hidden" value="<?php echo $ciudades_busqueda; ?>" readonly/>
                                    <input class="btn btn-warning btn-round waves-effect waves-light form-control" type="submit" value="Registrar Préstamo">
                                </div>
                            </div>
                          </form>
                          </div>
                        </div>
                        <!-- DOM/Jquery table end -->
                        <!-- Row Created Callback table end -->
                      </div>
                      
                      <!-- Page-body start -->
                    </div>
                  </div>
                  <!-- Main-body end -->
                  
                  <div id="styleSelector">

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




<!-- Warning Section Ends -->
<!-- Required Jquery -->
<script type="text/javascript" src="../files/bower_components/jquery/js/jquery.min.js"></script>
<script type="text/javascript" src="../files/bower_components/jquery-ui/js/jquery-ui.min.js"></script>
<script type="text/javascript" src="../files/bower_components/popper.js/js/popper.min.js"></script>
<script type="text/javascript" src="../files/bower_components/bootstrap/js/bootstrap.min.js"></script>
<!-- waves js -->
<script src="../files/assets/pages/waves/js/waves.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="../files/bower_components/jquery-slimscroll/js/jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="../files/bower_components/modernizr/js/modernizr.js"></script>
<script type="text/javascript" src="../files/bower_components/modernizr/js/css-scrollbars.js"></script>
<!-- waves js -->
<script src="../files/assets/pages/waves/js/waves.min.js"></script>
<!-- data-table js -->
<script src="../files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../files/assets/pages/data-table/js/jszip.min.js"></script>
<script src="../files/assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="../files/assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../files/bower_components/datatables.net-buttons/js/buttons.php5.min.js"></script>
<script src="../files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- Custom js -->
<script src="../files/assets/pages/data-table/extensions/responsive/js/responsive-custom.js"></script>
<script src="../files/assets/js/pcoded.min.js"></script>
<script src="../files/assets/js/vertical/vertical-layout.min.js"></script>
<script src="../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="../files/assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>


