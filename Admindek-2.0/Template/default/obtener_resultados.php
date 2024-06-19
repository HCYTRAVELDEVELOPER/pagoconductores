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
      <script src="editar_valor_pesos.js"></script>
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

          <div class="pcoded-main-container">
            <div class="pcoded-wrapper">
              <!-- [ navigation menu ] start -->
              <?php include("menu1.php"); ?>
              <!-- [ navigation menu ] end -->
              <?php
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "sistema_pagos";
                                error_reporting(0);
                                
                                $conn = new mysqli($servername, $username, $password, $dbname);
                                
                                if ($conn->connect_error) {
                                    die("Conexión fallida: " . $conn->connect_error);
                                }
                                
                                $ciudadesPartida = isset($_GET['ciudad_partida']) ? $_GET['ciudad_partida'] : [];
                                $fechaInicio = $_GET['fecha_inicio'] . " 00:00:00";
                                $fechaFin = $_GET['fecha_fin'] . " 23:59:00";
                                $ciudadPersonalizada = $_GET['ciudad_personalizada'];
                                
                                $ciudadesPartidaStr = "'" . implode("','", $ciudadesPartida) . "'";
                                
                                $sql = "SELECT CiudadPartida, 
                                        ConductorNombre, 
                                        SUM(CAST(REPLACE(SUBSTRING(ESTValortransferz, 2), ',', '') AS DECIMAL(10, 2))) AS SumaESTValortransferz, 
                                        COUNT(*) AS CantidadServicios,
                                        SUM(Empresaafacturar) as SumaEmpresaafacturar,
                                        SUM(valorpesos) as SumaValorPesos 
                                        FROM servicios 
                                        WHERE CiudadPartida IN ($ciudadesPartidaStr) 
                                        AND Fechaservicio BETWEEN '$fechaInicio' AND '$fechaFin' 
                                        GROUP BY CiudadPartida, ConductorNombre";
                                
                                $result = $conn->query($sql);
                                
                                if ($result->num_rows > 0) {
                              ?>
              <div class="pcoded-content">
                <!-- [ breadcrumb ] start -->
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <i class="feather icon-inbox bg-c-yellow"></i>
                                <div class="d-inline">
                                    <h5>Filtro Ciudades</h5>
                                    <span>Tabla Filtro Ciudades</span>
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
                          <h5>Resultados Ciudad <?php echo $ciudadPersonalizada; ?></h5>
                            <!-- <span>Events assigned to the table can be exceptionally useful for user interaction, however you must be aware that DataTables will add and remove rows from the DOM as they are needed (i.e. when paging only the visible elements are actually available in the DOM). As such, this can lead to the odd hiccup when working with events.</span> -->
                          </div>
                          <div class="card-block">
                        <div class="table-responsive dt-responsive">
                            <h6 class="text-center">De la fecha <b style="color: #FF9242;"><?php echo $fechaInicio ?></b>, hasta la fecha <b style="color: #FF9242;"><?php echo $fechaFin; ?></b></h6><br>
                            <table id="new-cons" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>Ciudad Partida</th>
                                        <th>Conductor Nombre</th>
                                        <th>Suma de los ESTValorTransferz</th>
                                        <th>Cantidad de Servicios</th>
                                        <th>Suma Servicios</th>
                                        <th>Suma No Shows</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      while($row = $result->fetch_assoc()) {
                                          echo "<tr>";
                                          echo "<td>" . $row["CiudadPartida"] . "</td>";
                                          echo "<td><a href='detalles_servicios.php?conductor=" . urlencode($row["ConductorNombre"]) . "&fecha_inicio=" . urlencode($_GET["fecha_inicio"]) . "&fecha_fin=" . urlencode($_GET["fecha_fin"]) . "&ciudad_partida=" . urlencode($row["CiudadPartida"]) . "&ciudades_busqueda=" . urlencode(implode(",", $ciudadesPartida) ) . "'>" . $row["ConductorNombre"] . "</a></td>";
                                          echo "<td>" . $row["SumaESTValortransferz"] . "</td>";
                                          echo "<td>" . $row["CantidadServicios"] . "</td>";
                                          echo "<td>" . $row["SumaValorPesos"] . "</td>";
                                          echo "<td>" . $row["SumaEmpresaafacturar"] . "</td>"; 
                                          echo "</tr>";
                                          $totalSumaESTValortransferz += $row["SumaESTValortransferz"];
                                          $totalCantidadServicios += $row["CantidadServicios"];
                                          $totalSumaServicios += $row["SumaValorPesos"];
                                          $totalSumaNoShows += $row["SumaEmpresaafacturar"];
                                          
                                      }
                                      ?>
                                </tbody>
                            </table><br>
                            <table id="new-cons" class="table table-striped table-bordered nowrap">
                                <thead>
                                    <tr>
                                        <th>Totales ESTValorTransferz</th>
                                        <th>Total Cantidad de Servicios</th>
                                        <th>Total Suma Servicios</th>
                                        <th>Total Suma No Shows</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo $totalSumaESTValortransferz; ?></td>
                                        <td><?php echo $totalCantidadServicios; ?></td>
                                        <td><?php echo $totalSumaServicios; ?></td>
                                        <td><?php echo $totalSumaNoShows; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                            <form action="consolidar.php" method="post">
                                <input type="hidden" name="ciudad_partida" value="<?php echo implode(",", $ciudadesPartida); ?>">
                                <input type="hidden" name='fecha_inicio' value="<?php echo $_GET['fecha_inicio'] ?>">
                                <input type="hidden" name='fecha_fin' value="<?php echo $_GET['fecha_fin'] ?>">
                                <input type="hidden" name='ciudad_personalizada' value="<?php echo $_GET['ciudad_personalizada'] ?>">
                                <div style="display: flex; justify-content: flex-end;">
                                  <input class="btn btn-warning btn-round waves-effect waves-light" type="submit" name="consolidar" value="Consolidar datos">
                                </div>
                              </form>
                          </div>
                        </div>
                        <?php
                                  } else {
                                    echo "<h2>No se encontraron resultados para la Ciudad: $ciudadPersonalizada</h2>";
                                }
                                
                                $conn->close();
                        ?>
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



      <!-- Warning Section Starts -->
      <!-- Older IE warning message -->
    <!--[if lt IE 10]>
<div class="ie-warning">
    <h1>Warning!!</h1>
    <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
    <div class="iew-container">
        <ul class="iew-download">
            <li>
                <a href="http://www.google.com/chrome/">
                    <img src="../files/assets/images/browser/chrome.png" alt="Chrome">
                    <div>Chrome</div>
                </a>
            </li>
            <li>
                <a href="https://www.mozilla.org/en-US/firefox/new/">
                    <img src="../files/assets/images/browser/firefox.png" alt="Firefox">
                    <div>Firefox</div>
                </a>
            </li>
            <li>
                <a href="http://www.opera.com">
                    <img src="../files/assets/images/browser/opera.png" alt="Opera">
                    <div>Opera</div>
                </a>
            </li>
            <li>
                <a href="https://www.apple.com/safari/">
                    <img src="../files/assets/images/browser/safari.png" alt="Safari">
                    <div>Safari</div>
                </a>
            </li>
            <li>
                <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                    <img src="../files/assets/images/browser/ie.png" alt="">
                    <div>IE (9 & above)</div>
                </a>
            </li>
        </ul>
    </div>
    <p>Sorry for the inconvenience!</p>
</div>
<![endif]-->
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

</php>
