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
    <meta name="keywords" content="flat ui, admin Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="colorlib" />
    <!-- Favicon icon -->
    <link rel="icon" href="../files/assets/images/favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- feather icon -->
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather.css">
    <!-- font-awesome-n -->
    <link rel="stylesheet" type="text/css" href="../files/assets/css/font-awesome-n.min.css">
    <!-- Chartlist chart css -->
    <link rel="stylesheet" href="../files/bower_components/chartist/css/chartist.css" type="text/css" media="all">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/css/widget.css">
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
            <?php

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultas SQL
$query1 = "SELECT CiudadPartida, SUM(CantidadServicios) AS TotalServicios FROM tabla_consolidada GROUP BY CiudadPartida";
$query2 = "SELECT ConductorNombre, AVG(CantidadServicios) AS PromedioServicios FROM tabla_consolidada GROUP BY ConductorNombre";
$query3 = "SELECT CiudadPartida, SUM(SumaValorPesos) AS TotalValorPesos FROM tabla_consolidada GROUP BY CiudadPartida";
$query4 = "SELECT ConductorNombre, AVG(SumaValorPesos) AS PromedioValorPesos FROM tabla_consolidada GROUP BY ConductorNombre";
$query5 = "SELECT MIN(FechaInicio) AS FechaInicio, MAX(FechaFin) AS FechaFin FROM tabla_consolidada";

// Ejecutar consultas y mostrar resultados
$result1 = $conn->query($query1);
$result2 = $conn->query($query2);
$result3 = $conn->query($query3);
$result4 = $conn->query($query4);
$result5 = $conn->query($query5);
            ?>


            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- [ navigation menu ] start -->
                    <?php include("menu1.php"); ?>
                    <!-- [ navigation menu ] end -->
                    <div class="pcoded-content">
                        <!-- [ breadcrumb ] start -->
                        <div class="page-header card">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <i class="feather icon-home bg-c-blue"></i>
                                        <div class="d-inline">
                                            <h5>Dashboard Analytics</h5>
                                            <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <!-- [ page content ] start -->
                                        <div class="row">



                                            <!-- Sales Analytics start -->
                                            <div class="col-xl-8 col-md-12">
                                                <div class="card sale-card">
                                                    <div class="card-header">
                                                        <h5>Deals Analytics</h5>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="row">
                                                            <div class="col-sm-8">
                                                                <div id="allocation-map" class="chart-shadow" style="height:215px"></div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div id="allocation-chart" class="chart-shadow" style="height:215px"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-md-12">

                                            <?php

$profitQuery = "SELECT 
                      SUM(SumaESTValortransferz) - SUM(SumaValorPesos) AS TotalProfit 
                    FROM 
                      tabla_consolidada";

    $profitResult = $conn->query($profitQuery);
    $profitRow = $profitResult->fetch_assoc();
    $totalProfit = $profitRow['TotalProfit'];
                                                ?>

                                                <div class="card prod-p-card card-red">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-30">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">Ganancia</h6>
                                                                <h3 class="m-b-0 f-w-700 text-white">$<?php echo number_format($totalProfit, 2); ?></h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-money-bill-alt text-c-red f-18"></i>
                                                            </div>
                                                        </div>
                                                        <p class="m-b-0 text-white"><span class="label label-danger m-r-10"></p>
                                                    </div>
                                                </div>
                                                <div class="card prod-p-card card-blue">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-30">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">Total Orders</h6>
                                                                <h3 class="m-b-0 f-w-700 text-white">15,830</h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-database text-c-blue f-18"></i>
                                                            </div>
                                                        </div>
                                                        <p class="m-b-0 text-white"><span class="label label-primary m-r-10">+12%</span>From Previous Month</p>
                                                    </div>
                                                </div>
                                                <!-- <div class="card prod-p-card card-green">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-30">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">Average Price</h6>
                                                                <h3 class="m-b-0 f-w-700 text-white">$6,780</h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-dollar-sign text-c-green f-18"></i>
                                                            </div>
                                                        </div>
                                                        <p class="m-b-0 text-white"><span class="label label-success m-r-10">+52%</span>From Previous Month</p>
                                                    </div>
                                                </div>
                                                <div class="card prod-p-card card-yellow">
                                                    <div class="card-body">
                                                        <div class="row align-items-center m-b-30">
                                                            <div class="col">
                                                                <h6 class="m-b-5 text-white">Product Sold</h6>
                                                                <h3 class="m-b-0 f-w-700 text-white">6,784</h3>
                                                            </div>
                                                            <div class="col-auto">
                                                                <i class="fas fa-tags text-c-yellow f-18"></i>
                                                            </div>
                                                        </div>
                                                        <p class="m-b-0 text-white"><span class="label label-warning m-r-10">+52%</span>From Previous Month</p>
                                                    </div>
                                                </div> -->

                                            </div>
                                            <!-- Sales Analytics end -->

                                            <!-- peoduct statustic start -->
                                            <div class="col-xl-12">
                                                <div class="card product-progress-card">
                                                    <div class="card-block">
                                                        <div class="row pp-main">
                                                            <div class="col-xl-3 col-md-6">
                                                                <div class="pp-cont">
                                                                    <div class="row align-items-center m-b-20">
                                                                        <div class="col-auto">
                                                                            <i class="fas fa-cube f-24 text-mute"></i>
                                                                        </div>
                                                                        <div class="col text-end">
                                                                            <h2 class="m-b-0 text-c-blue">2476</h2>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row align-items-center m-b-15">
                                                                        <div class="col-auto">
                                                                            <p class="m-b-0">Total Product</p>
                                                                        </div>
                                                                        <div class="col text-end">
                                                                            <p class="m-b-0 text-c-blue"><i class="fas fa-long-arrow-alt-up m-r-10"></i>64%</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-c-blue" style="width:45%"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6">
                                                                <div class="pp-cont">
                                                                    <div class="row align-items-center m-b-20">
                                                                        <div class="col-auto">
                                                                            <i class="fas fa-tag f-24 text-mute"></i>
                                                                        </div>
                                                                        <div class="col text-end">
                                                                            <h2 class="m-b-0 text-c-red">843</h2>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row align-items-center m-b-15">
                                                                        <div class="col-auto">
                                                                            <p class="m-b-0">New Orders</p>
                                                                        </div>
                                                                        <div class="col text-end">
                                                                            <p class="m-b-0 text-c-red"><i class="fas fa-long-arrow-alt-down m-r-10"></i>34%</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-c-red" style="width:75%"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6">
                                                                <div class="pp-cont">
                                                                    <div class="row align-items-center m-b-20">
                                                                        <div class="col-auto">
                                                                            <i class="fas fa-random f-24 text-mute"></i>
                                                                        </div>
                                                                        <div class="col text-end">
                                                                            <h2 class="m-b-0 text-c-yellow">63%</h2>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row align-items-center m-b-15">
                                                                        <div class="col-auto">
                                                                            <p class="m-b-0">Conversion Rate</p>
                                                                        </div>
                                                                        <div class="col text-end">
                                                                            <p class="m-b-0 text-c-yellow"><i class="fas fa-long-arrow-alt-up m-r-10"></i>64%</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-c-yellow" style="width:65%"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-3 col-md-6">
                                                                <div class="pp-cont">
                                                                    <div class="row align-items-center m-b-20">
                                                                        <div class="col-auto">
                                                                            <i class="fas fa-dollar-sign f-24 text-mute"></i>
                                                                        </div>
                                                                        <div class="col text-end">
                                                                            <h2 class="m-b-0 text-c-green">41M</h2>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row align-items-center m-b-15">
                                                                        <div class="col-auto">
                                                                            <p class="m-b-0">Conversion Rate</p>
                                                                        </div>
                                                                        <div class="col text-end">
                                                                            <p class="m-b-0 text-c-green"><i class="fas fa-long-arrow-alt-up m-r-10"></i>54%</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-c-green" style="width:35%"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- peoduct statustic end -->

                                            <!-- Application Sales start -->
                                            <div class="col-xl-12 col-md-12">
                                                <div class="card table-card">
                                                    <div class="card-header">
                                                        <h5>Application Sales</h5>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                                                <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                                <li><i class="feather icon-trash close-card"></i></li>
                                                                <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover m-b-0  table-borderless">
                                                                <thead>
                                                                    <tr>
                                                                    <th>Ciudad de Partida</th>
                                                                    <th>Cantidad de Servicios</th>
                                                                    <th>Valor de EST Transfer</th>
                                                                    <th>Valor en Pesos</th>
                                                                    <th>Ganancia</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                     $query = "SELECT 
                                                                     CiudadPartida, 
                                                                     SUM(CantidadServicios) AS TotalServicios, 
                                                                     SUM(SumaESTValortransferz) AS TotalESTTransfer, 
                                                                     SUM(SumaValorPesos) AS TotalValorPesos, 
                                                                     SUM(SumaESTValortransferz) - SUM(SumaValorPesos) AS Diferencia 
                                                                   FROM 
                                                                     tabla_consolidada 
                                                                   GROUP BY 
                                                                     CiudadPartida";
                                                     
                                                         $result = $conn->query($query);

                                                         $totalServicios = 0;
    $totalESTTransfer = 0;
    $totalValorPesos = 0;
    $totalDiferencia = 0;
                                                                   while ($row = $result->fetch_assoc()) {
                                                                    $totalServicios += $row["TotalServicios"];
                                                                    $totalESTTransfer += $row["TotalESTTransfer"];
                                                                    $totalValorPesos += $row["TotalValorPesos"];
                                                                    $totalDiferencia += $row["Diferencia"];
                                                                    echo "<tr>
                <td>" . $row["CiudadPartida"] . "</td>
                <td>" . $row["TotalServicios"] . "</td>
                <td>" . $row["TotalESTTransfer"] . "</td>
                <td>" . $row["TotalValorPesos"] . "</td>
                <td>" . $row["Diferencia"] . "</td>
              </tr>";
    }

    echo "<tr style='font-weight: bold; text-decoration: underline;'>
            <td>Total</td>
            <td>" . $totalServicios . "</td>
            <td>" . $totalESTTransfer . "</td>
            <td>" . $totalValorPesos . "</td>
            <td>" . $totalDiferencia . "</td>
          </tr>";
                                                                   ?>
                                                                    
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <!-- Application Sales end -->

                                            <!-- map card start -->
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Sales Analytics</h5>
                                                        <div class="card-header-right">
                                                            <ul class="list-unstyled card-option">
                                                                <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
                                                                <li><i class="feather icon-maximize full-card"></i></li>
                                                                <li><i class="feather icon-minus minimize-card"></i></li>
                                                                <li><i class="feather icon-refresh-cw reload-card"></i></li>
                                                                <li><i class="feather icon-trash close-card"></i></li>
                                                                <li><i class="feather icon-chevron-left open-card-option"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="card-block">
                                                        <div id="sales-analytics" style="height: 390px;"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- map card end -->


                                        </div>
                                        <!-- [ page content ] end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ style Customizer ] start -->
                    <div id="styleSelector">
                    </div>
                    <!-- [ style Customizer ] end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Warning Section Starts -->
    <!-- Older IE warning message -->
    <!--[if lt IE 10]>
    <div class="ie-warning">
        <h1>Warning!!</h1>
        <p>You are using an outdated version of Internet Explorer, please upgrade
            <br/>to any of the following web browsers to access this website.
        </p>
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
    <!-- Float Chart js -->
    <script src="../files/assets/pages/chart/float/jquery.flot.js"></script>
    <script src="../files/assets/pages/chart/float/jquery.flot.categories.js"></script>
    <script src="../files/assets/pages/chart/float/curvedLines.js"></script>
    <script src="../files/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script>
    <!-- amchart js -->
    <script src="../files/assets/pages/widget/amchart/amcharts.js"></script>
    <script src="../files/assets/pages/widget/amchart/gauge.js"></script>
    <script src="../files/assets/pages/widget/amchart/serial.js"></script>
    <script src="../files/assets/pages/widget/amchart/light.js"></script>
    <script src="../files/assets/pages/widget/amchart/pie.min.js"></script>
    <script src="../files/assets/pages/widget/amchart/ammap.min.js"></script>
    <script src="../files/assets/pages/widget/amchart/usaLow.js"></script>

    <!-- Chartlist charts -->
    <script src="../files/bower_components/chartist/js/chartist.js"></script>

    <!-- Custom js -->
    <script src="../files/assets/js/pcoded.min.js"></script>
    <script src="../files/assets/js/vertical/vertical-layout.min.js"></script>
    <script type="text/javascript" src="../files/assets/pages/dashboard/analytic-dashboard.min.js"></script>
    <script type="text/javascript" src="../files/assets/js/script.min.js"></script>
</body>

</php>
