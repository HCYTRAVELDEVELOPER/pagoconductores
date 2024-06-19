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
                                    <h5>Visualizar Consolidado</h5>
                                    <span>Información Consolidados</span>
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
                            <h5>Filtro</h5>
                          </div>
                          <div class="card-block">
                          <form action="" method="post">
                            <div class="row">
                                <div class="col-lg-4 col-xl-4 col-sm-12">
                                <h4 class="sub-title text-center">Ciudad Personalizada</h4>
                                  <select name="ciudad_personalizada" id="ciudad_personalizada" class="form-select form-control form-control-warning">
                                      <option value="">Seleccione una Ciudad Personalizada</option>
                                      <?php 
                                        // Consulta para obtener las ciudades personalizadas agrupadas
                                        $sqlCiudadesPersonalizadas = "SELECT DISTINCT CiudadPersonalizada FROM tabla_consolidada";
                                        $resultCiudades = $conn->query($sqlCiudadesPersonalizadas);
                                        if ($resultCiudades->num_rows > 0) {
                                            while($row = $resultCiudades->fetch_assoc()) {
                                                echo "<option value='" . $row['CiudadPersonalizada'] . "'>" . $row['CiudadPersonalizada'] . "</option>";
                                            }
                                        }
                                      ?>
                                  </select>
                                </div>
                                <div class="col-lg-4 col-xl-4 col-sm-12">
                                  <h4 class="sub-title text-center">Fecha Inicio</h4>
                                  <input class="form-control" name="fecha_inicio" id="fecha_inicio" type="date" required />
                                </div>
                                <div class="col-lg-4 col-xl-4 col-sm-12">
                                  <h4 class="sub-title text-center">Fecha Final</h4>
                                  <input class="form-control" name="fecha_fin" id="fecha_fin" type="date" required />
                                </div>
                                <div class="col-lg-4 col-xl-12 col-sm-12"><br>
                                    <input class="btn btn-warning btn-round waves-effect waves-light form-control" type="submit" name="ver_datos" value="Ver Datos">
                                </div>
                            </div>
                          </form>
                          </div>
                        </div>
                        <?php
                        if (isset($_POST['ver_datos'])) {
                          $ciudadPersonalizadaSeleccionada = $_POST['ciudad_personalizada'];
                          $fechaInicio = $_POST['fecha_inicio'] . " 00:00:00";
                          $fechaFin = $_POST['fecha_fin'] . " 23:59:59";
                      
                          // Consulta para obtener la fecha más temprana y la fecha más tardía
                          $sqlFechas = "SELECT MIN(FechaInicio) AS FechaInicio, MAX(FechaFin) AS FechaFin 
                                        FROM tabla_consolidada 
                                        WHERE CiudadPersonalizada = '$ciudadPersonalizadaSeleccionada'";
                          $resultFechas = $conn->query($sqlFechas);
                          $fechas = $resultFechas->fetch_assoc();
                        ?>
                        <div class="card">
                          <div class="card-header">
                            <h5>Datos Consolidados para la ciudad: <?php echo $ciudadPersonalizadaSeleccionada; ?></h5>
                            <a class="btn btn-danger btn-round waves-effect waves-light float-end" href="reporteconsolidado.php?ciudadPersonalizadaSeleccionada=<?php echo $ciudadPersonalizadaSeleccionada;?>&fechaInicio=<?php echo $fechaInicio; ?>&fechaFin=<?php echo $fechaFin;?>"><i class="fa fa-file-pdf-o"></i>Descargar PDF</a>
                          </div>
                          <?php


                            $sql = "SELECT CiudadPartida, ConductorNombre, SumaESTValortransferz, CantidadServicios, SumaValorPesos, FechaInicio, FechaFin, SumaNoShow
                            FROM tabla_consolidada 
                            WHERE CiudadPersonalizada = '$ciudadPersonalizadaSeleccionada'
                            AND FechaInicio >= '$fechaInicio' AND FechaFin <= '$fechaFin'";

                            $sql2=  "SELECT SUM(ValorPrestamo) as TotalPrestamos FROM prestamos                     
                            WHERE FechaInicio >= '$fechaInicio' AND FechaFin <= '$fechaFin'";
                            $result2 = $conn->query($sql2);
                            $row2 = $result2->fetch_assoc();
                            $totalPrestamos = $row2["TotalPrestamos"];




                
                            $result = $conn->query($sql);
                        
                            if ($result->num_rows > 0) {
                                $totalSumaESTValortransferz = 0;
                                $totalCantidadServicios = 0;
                                $totalSumaServicios = 0;
                                $totalNoShow = 0;
                        
                                while($row = $result->fetch_assoc()) {
                                    $totalSumaESTValortransferz += $row["SumaESTValortransferz"];
                                    $totalCantidadServicios += $row["CantidadServicios"];
                                    $totalSumaServicios += $row["SumaValorPesos"];
                                    $totalNoShow += $row["SumaNoShow"];
                                }
                          ?>
                          <div class="card-block">
                          <h6 class="text-center">Informe desde la fecha <b style="color: #FF9242;"><?php echo $fechas['FechaInicio']; ?></b>, hasta la fecha <b style="color: #FF9242;"><?php echo $fechas['FechaFin']; ?></b></h6><br>
                              <div class="col-md-12">
                                  <div class="card">
                                      <div class="card-block">
                                          <div class="d-flex">
                                              <div class="flex-grow-1">
                                                  <div class="col-xs-12 text-center">
                                                      <h5 class="d-inline-block" style="font-weight: bold;">Totales</h5>
                                                  </div><br>
                                                  <div class="row">
                                                      <div class="col-lg-4 col-xl-4 col-sm-12 text-center">
                                                          <div class="f-13 m-b-15" style="font-weight: bold;">
                                                              Suma de los ESTValorTransferz
                                                          </div>
                                                          <p style="color: #FF9242;"><?php echo $totalSumaESTValortransferz; ?></p>
                                                      </div>
                                                      <div class="col-lg-4 col-xl-4 col-sm-12 text-center">
                                                          <div class="f-13 m-b-15" style="font-weight: bold;">
                                                              Cantidad de Servicios
                                                          </div>
                                                          <p style="color: #FF9242;"><?php echo $totalCantidadServicios; ?></p>
                                                      </div>
                                                      <div class="col-lg-4 col-xl-4 col-sm-12 text-center">
                                                          <div class="f-13 m-b-15" style="font-weight: bold;">
                                                            Suma Valor Pesos
                                                          </div>
                                                          <p style="color: #FF9242;"><?php echo $totalSumaServicios; ?></p>
                                                      </div>

                                                      <div class="col-lg-4 col-xl-4 col-sm-12 text-center">
                                                          <div class="f-13 m-b-15" style="font-weight: bold;">
                                                            Suma Valor No Shows
                                                          </div>
                                                          <p style="color: #FF9242;"><?php echo $totalNoShow; ?></p>
                                                      </div>
                                                      <div class="col-lg-4 col-xl-4 col-sm-12 text-center">
                                                          <div class="f-13 m-b-15" style="font-weight: bold;">
                                                            Suma Prestamos
                                                          </div>
                                                          <p style="color: #FF9242;"><?php echo $totalPrestamos; ?></p>
                                                      </div>

                                                      <div class="col-lg-4 col-xl-4 col-sm-12 text-center">
                                                          <div class="f-13 m-b-15" style="font-weight: bold;">
                                                            Total a Pagar 
                                                            <?php
                                                             $totalPagar = $totalSumaServicios  - $totalNoShow - $totalPrestamos;
                                                            ?>
                                                          </div>
                                                          <p style="color: #FF9242;"><?php echo $totalPagar; ?></p>
                                                      </div>
                                                      
                                                      
                                                      
                               
                              </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="card-block">
                            <div class="dt-responsive table-responsive">
                              <table id="new-cons" class="table table-striped table-bordered nowrap">
                                <thead>
                                  <tr>
                                    <th>Ciudad Partida</th>
                                    <th>Conductor Nombre</th>
                                    <th>Suma de los ESTValorTransferz</th>
                                    <th>Cantidad de Servicios</th>
                                    <th>Suma Valor Pesos</th>
                                    <th>Suma Valor NoShow</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $result->data_seek(0); // Reiniciar el puntero del resultado

                                    while($row = $result->fetch_assoc()) {
                                    ?>
                                  <tr>
                                    <td><?php echo $row["CiudadPartida"]; ?></td>
                                    <td><?php echo $row["ConductorNombre"]; ?></td>
                                    <td><?php echo $row["SumaESTValortransferz"]; ?></td>
                                    <td><?php echo $row["CantidadServicios"]; ?></td>
                                    <td><?php echo $row["SumaValorPesos"]; ?></td>
                                    <td><?php echo $row["SumaNoShow"]; ?></td>
                                    <td><?php echo $row["FechaInicio"]; ?></td>
                                    <td><?php echo $row["FechaFin"]; ?></td>
                                  </tr>
                                  <?php
                                    }
                                  ?>
                                </tbody>
                              </table>
                              <?php
                                  } else {
                                    echo "No se encontraron datos consolidados para la ciudad personalizada seleccionada y el rango de fechas especificado.";
                                }
                              }
                              ?>
                            </div>
                          </div>
                          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo valor para los servicios</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <label for="">Ingresa el nuevo valor para todos los servicios:</label>
                                  <input class="form-control" id="nuevoValorMasivo" type="text" >
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button class="btn btn-primary" id="btnActualizarMasivamente">Actualizar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
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


