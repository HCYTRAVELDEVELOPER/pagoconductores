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
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description"
        content="Admindek Bootstrap admin template made using Bootstrap 5 and it has huge amount of ready made feature, UI components, pages which completely fulfills any dashboard needs." />
    <meta name="keywords"
        content="bootstrap, bootstrap admin template, admin theme, admin dashboard, dashboard template, admin template, responsive" />
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
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- feather icon -->
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather.css">
    <!-- jqpagination css -->
    <link rel="stylesheet" type="text/css" href="../files/assets/pages/jqpagination/jqpagination.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="../files/assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/css/pages.css">
    <style>
        body {
            background-image: url('https://www.terra.com.co/u/fotografias/m/2024/3/9/f685x385-25431_63124_5050.jpeg');
            background-size: cover; /* Hace que la imagen cubra toda el área */
            background-repeat: no-repeat; /* Evita que la imagen se repita */
            background-attachment: fixed; /* Hace que la imagen se quede fija al hacer scroll */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0; /* Elimina el margen por defecto del body */
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.8); /* Fondo blanco semi-transparente para el contenido */
            padding: 20px;
            border-radius: 10px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-text {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-content">
            <div class="page-header card">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="feather icon-box bg-c-blue"></i>
                            <div class="d-inline">
                                <h5 style="color: white;">Menú Principal</h5>
                                <span style="color: white;">Modulos</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pcoded-inner-content">
                <div class="main-body">
                    <div class="page-wrapper">
                        <div class="page-body">
                            <!-- Contenido de la página -->
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-4">
                                <a href="pagos_conductores.php" class="card text-white card-primary">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <h5 class="card-title">Pago conductores</h5>
                                        <p class="card-text">Modulo para pago a conductores por servicios realizados.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <a href="informacion_conductores.php" class="card text-white bg-secondary">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <h5 class="card-title">Infomación Conductores</h5>
                                        <p class="card-text">Modulo para la Gestión de creación de conductores</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <a href="visualizar_consolidado1.php" class="card text-white card-success">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <h5 class="card-title">Consolidados</h5>
                                        <p class="card-text">Modulo para el seguimiento e impresión de Consolidados para pago.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <a href="dashboard-analytics.php" class="card text-white card-danger">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <h5 class="card-title">Estadisticas</h5>
                                        <p class="card-text">Modulo para el seguimiento y visualizción de Estadisticas</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <a href="masivo_excel.php" class="card text-white card-warning">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <h5 class="card-title">Cargue Masivo</h5>
                                        <p class="card-text">Modulo para el cargue del archivo de excel que alimenta el app.</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <a href="tb_infousuarios.php" class="card text-white card-info">
                                    <div class="card-header"></div>
                                    <div class="card-body">
                                        <h5 class="card-title">Pasajeros</h5>
                                        <p class="card-text">Modulo para la Gestión y seguimiento de Pasajeros </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main-body end -->
       
    </div>

   

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
    <!-- jqpagination js -->
    <script type="text/javascript" src="../files/assets/pages/jqpagination/jquery.jqpagination.js"></script>
    <script src="../files/assets/js/pcoded.min.js"></script>
    <script src="../files/assets/js/vertical/vertical-layout.min.js"></script>
    <script src="../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- Custom js -->
    <script type="text/javascript" src="../files/assets/js/script.js"></script>
</body>

</html>
