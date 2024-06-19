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
    <!-- Google font-->     <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"><link href="https://fonts.googleapis.com/css?family=Quicksand:500,700" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap/css/bootstrap.min.css">
    <!-- waves.css -->
    <link rel="stylesheet" href="../files/assets/pages/waves/css/waves.min.css" type="text/css" media="all">
    <!-- feather icon -->
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/feather/css/feather.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/icofont/css/icofont.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/font-awesome/css/font-awesome.min.css">
    <!-- Select 2 css -->
    <link rel="stylesheet" href="../files/bower_components/select2/css/select2.min.css" />
    <!-- Multi Select css -->
    <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap-multiselect/css/bootstrap-multiselect.css" />
    <link rel="stylesheet" type="text/css" href="../files/bower_components/multiselect/css/multi-select.css" />
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="../files/assets/icon/themify-icons/themify-icons.css">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="../files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="../files/assets/pages/data-table/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
    <!-- Chartlist chart css -->
    <link rel="stylesheet" href="../files/bower_components/chartist/css/chartist.css" type="text/css" media="all">
    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="../files/assets/pages/advance-elements/css/bootstrap-datetimepicker.css">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="../files/bower_components/bootstrap-daterangepicker/css/daterangepicker.css" />
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="../files/bower_components/datedropper/css/datedropper.min.css" />
    <!-- Color Picker css -->
    <link rel="stylesheet" type="text/css" href="../files/bower_components/spectrum/css/spectrum.css" />
    <!-- Mini-color css -->
    <link rel="stylesheet" type="text/css" href="../files/bower_components/jquery-minicolors/css/jquery.minicolors.css" />
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
            <div id="sidebar" class="users p-chat-user showChat">
                <div class="had-container">
                    <div class="p-fixed users-main">
                        <div class="user-box">
                            <div class="chat-search-box">
                                <a class="back_friendlist">
                                    <i class="feather icon-x"></i>
                                </a>
                                <div class="right-icon-control">
                                    <div class="input-group input-group-button">
                                        <input type="text" id="search-friends" name="footer-email" class="form-control" placeholder="Search Friend">
                                        <button class="btn btn-primary waves-effect waves-light" type="button">
                                            <i class="feather icon-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="main-friend-list">
                                <div class="media userlist-box waves-effect waves-light" data-id="1" data-status="online" data-username="Josephin Doe">
                                    <a class="media-left" href="#!">
                                                <img class="media-object img-radius img-radius" src="../files/assets/images/avatar-3.jpg" alt="Generic placeholder image ">
                                                <div class="live-status bg-success"></div>
                                            </a>
                                    <div class="media-body">
                                        <div class="chat-header">Josephin Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box waves-effect waves-light" data-id="2" data-status="online" data-username="Lary Doe">
                                    <a class="media-left" href="#!">
                                                <img class="media-object img-radius" src="../files/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                                <div class="live-status bg-success"></div>
                                            </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Lary Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box waves-effect waves-light" data-id="3" data-status="online" data-username="Alice">
                                    <a class="media-left" href="#!">
                                                <img class="media-object img-radius" src="../files/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                                <div class="live-status bg-success"></div>
                                            </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alice</div>
                                    </div>
                                </div>
                                <div class="media userlist-box waves-effect waves-light" data-id="4" data-status="offline" data-username="Alia">
                                    <a class="media-left" href="#!">
                                                <img class="media-object img-radius" src="../files/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                                <div class="live-status bg-default"></div>
                                            </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alia<small class="d-block text-muted">10 min ago</small></div>
                                    </div>
                                </div>
                                <div class="media userlist-box waves-effect waves-light" data-id="5" data-status="offline" data-username="Suzen">
                                    <a class="media-left" href="#!">
                                                <img class="media-object img-radius" src="../files/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                                <div class="live-status bg-default"></div>
                                            </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Suzen<small class="d-block text-muted">15 min ago</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ chat user list ] end -->

            <!-- [ chat message ] start -->
            <div class="showChat_inner">
                <div class="d-flex chat-inner-header">
                    <a class="back_chatBox">
                        <i class="feather icon-x"></i> Josephin Doe
                    </a>
                </div>
                <div class="main-friend-chat">
                    <div class="d-flex chat-messages">
                        <a class="media-left photo-table" href="#!">
                            <div class="flex-shrink-0">
                                <img class="media-object img-radius img-radius m-t-5" src="../files/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                            </div>
                        </a>
                        <div class="flex-grow-1 chat-menu-content">
                            <div class="">
                                <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            </div>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                    <div class="d-flex chat-messages">
                        <div class="flex-grow-1 chat-menu-reply">
                            <div class="">
                                <p class="chat-cont">Ohh! very nice</p>
                            </div>
                            <p class="chat-time">8:22 a.m.</p>
                        </div>
                    </div>
                    <div class="d-flex chat-messages">
                        <a class="media-left photo-table" href="#!">
                            <div class="flex-shrink-0">
                                <img class="media-object img-radius img-radius m-t-5" src="../files/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                            </div>
                        </a>
                        <div class="media-body chat-menu-content">
                            <div class="">
                                <p class="chat-cont">can you come with me?</p>
                            </div>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                </div>
                <div class="chat-reply-box">
                    <div class="right-icon-control">
                        <div class="input-group input-group-button">
                            <input type="text" class="form-control" placeholder="Write hear . . ">
                            <button class="btn btn-primary waves-effect waves-light" type="button">
                                <i class="feather icon-message-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ chat message ] end -->


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
                                        <i class="feather icon-feather bg-c-yellow"></i>
                                        <div class="d-inline">
                                            <h5>Pagos Conductores</h5>
                                            <span>Filtros por Ciudades y Fechas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ breadcrumb ] end -->

                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <!-- Select2 start -->
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Seleccciona las cuidades a filtrar</h5>
                                                        <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
                                                    </div>
                                                    <div class="card-block">
                                                        <form id="filtro-form" action="obtener_resultados.php" method="GET">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-xl-6 m-b-30">
                                                                    <h4 class="sub-title text-center">Cuidad de Partida</h4>
                                                                    <p>
                                                                        Filtra la cuidad de partida:
                                                                    </p>
                                                                    <select class="form-select js-example-basic-multiple col-sm-12" name="ciudad_partida[]" id="ciudad_partida" multiple="multiple" required>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-12 col-xl-6 m-b-30">
                                                                    <h4 class="sub-title text-center">Ciudad Personalizada</h4>
                                                                    <p>
                                                                        Filtra la cuidad personalizada:
                                                                    </p>
                                                                    <select class="form-select js-example-basic-multiple col-sm-12" name="ciudad_personalizada" id="ciudad_personalizada" multiple="multiple" required>
                                                                        <option value=""></option>
                                                                        <option value="IGUAZU">IGUAZU</option>
                                                                        <option value="SAO PAULO">SAO PAULO</option>
                                                                        <option value="CURITIBA">CURITIBA</option>
                                                                        <option value="FLORIANOPOLIS">FLORIANOPOLIS</option>
                                                                        <option value="SALVADOR DE BAHIA">SALVADOR DE BAHIA</option>
                                                                        <option value="MANAOS">MANAOS</option>
                                                                        <option value="RIO DE JANEIRO">RIO DE JANEIRO</option>
                                                                        <option value="PORTO ALEGRE">PORTO ALEGRE</option>
                                                                        <option value="MONTEVIDEO">MONTEVIDEO</option>
                                                                        <option value="MENDOZA">MENDOZA</option>
                                                                        <option value="SALTA">SALTA</option>
                                                                        <option value="EL CALAFATE">EL CALAFATE</option>
                                                                        <option value="USHUAIA">USHUAIA</option>
                                                                        <option value="BARILOCHE">BARILOCHE</option>
                                                                        <option value="PUERTO MADRYN">PUERTO MADRYN</option>
                                                                        <option value="BUENOS AIRES">BUENOS AIRES</option>
                                                                        <option value="CORDOBA">CORDOBA</option>
                                                                        <option value="LA PAZ">LA PAZ</option>
                                                                        <option value="SANTA CRUZ (VIRU VIRU)">SANTA CRUZ (VIRU VIRU)</option>
                                                                        <option value="ASUNCION DEL PARAGUAY">ASUNCION DEL PARAGUAY</option>
                                                                        <option value="CIUDAD DE MEXICO">CIUDAD DE MEXICO</option>
                                                                        <option value="EL SALVADOR">EL SALVADOR</option>
                                                                        <option value="CANCUN">CANCUN</option>
                                                                        <option value="REPUBLICA DOMINICANA">REPUBLICA DOMINICANA</option>
                                                                        <option value="MIAMI">MIAMI</option>
                                                                        <option value="DALLAS">DALLAS</option>
                                                                        <option value="PHILADELFIA">PHILADELFIA</option>
                                                                        <option value="BOSTON">BOSTON</option>
                                                                        <option value="NEW YORK">NEW YORK</option>
                                                                        <option value="SAN FRANCISCO">SAN FRANCISCO</option>
                                                                        <option value="LAS VEGAS">LAS VEGAS</option>
                                                                        <option value="GUADALAJARA">GUADALAJARA</option>
                                                                        <option value="MONTERREY">MONTERREY</option>
                                                                        <option value="LISBOA">LISBOA</option>
                                                                        <option value="JUJUAY">JUJUAY</option>
                                                                        <option value="NATAL">NATAL</option>
                                                                        <option value="BRASILIA">BRASILIA</option>
                                                                        <option value="LIMA">LIMA</option>
                                                                        <option value="MACCHU PICCHU">MACCHU PICCHU</option>
                                                                        <option value="PANAMA">PANAMA</option>
                                                                        <option value="ACAPULCO">ACAPULCO</option>
                                                                        <option value="DF MEXICO">DF MEXICO</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-12 col-xl-6 m-b-30">
                                                                    <h4 class="sub-title text-center">Fecha Inicio</h4>
                                                                    <p>Filtra por la fecha de inicio:</p>
                                                                    <input class="form-control" name="fecha_inicio" id="fecha_inicio" type="date" required />
                                                                    <!-- <input id="dropper-dangercolor" class="form-control" type="text" name="fecha_inicio" placeholder="Select your time" /> -->
                                                                </div>
                                                                <div class="col-sm-12 col-xl-6 m-b-30">
                                                                    <h4 class="sub-title text-center">Fecha Fin</h4>
                                                                    <p>Filtra por la fecha fin:</p>
                                                                    <input class="form-control" name="fecha_fin" id="fecha_fin" type="date" required />
                                                                    <!-- <input id="dropper-width"  class="form-control" type="text" name="fecha_fin" placeholder="Select your date" /> -->
                                                                </div>
                                                                <div class="col-sm-12 col-xl-12 m-b-30">
                                                                    <button type="submit" class="btn btn-warning btn-round waves-effect waves-light form-control">Realizar Filtro</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
                                                        <script>
                                                            $(document).ready(function(){
                                                                $.ajax({
                                                                    url: 'obtener_ciudades.php',
                                                                    type: 'GET',
                                                                    success: function(response) {
                                                                        $('#ciudad_partida').html(response);
                                                                    }
                                                                });
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                                <!-- Select2 end -->
                                                <!-- Multi-select start -->
                                                <!-- <div class="card">
                                                        <div class="card-header">
                                                            <h5>Tabla registros ciudades relacionadas:</h5>
                                                            <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code> tag</span>
                                                        </div>
                                                        <div class="card-block">
                                                            <div class="table-responsive dt-responsive">
                                                                <div id="resultados"></div>
                                                            </div>
                                                        </div>
                                                </div> -->
                                                <!-- Multi-select end -->
                                            </div>
                                        </div>
                                    </div>
                                        <!-- Page body end -->
                                </div>
                            </div>
                        </div>
                    </div>
                        <!-- Main-body end -->
                    <div id="styleSelector"></div>
                </div>
            </div>
        </div>
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
<!-- Select 2 js -->
<script type="text/javascript" src="../files/bower_components/select2/js/select2.full.min.js"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="../files/bower_components/bootstrap-multiselect/js/bootstrap-multiselect.js"></script>
<script type="text/javascript" src="../files/bower_components/multiselect/js/jquery.multi-select.js"></script>
<script type="text/javascript" src="../files/assets/js/jquery.quicksearch.js"></script>
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
<!-- Bootstrap date-time-picker js -->
<script type="text/javascript" src="../files/assets/pages/advance-elements/moment-with-locales.min.js"></script>
<script type="text/javascript" src="../files/bower_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="../files/assets/pages/advance-elements/bootstrap-datetimepicker.min.js"></script>
<!-- Date-range picker js -->
<script type="text/javascript" src="../files/bower_components/bootstrap-daterangepicker/js/daterangepicker.js"></script>
<!-- Date-dropper js -->
<script type="text/javascript" src="../files/bower_components/datedropper/js/datedropper.min.js"></script>
<!-- Color picker js -->
<script type="text/javascript" src="../files/bower_components/spectrum/js/spectrum.js"></script>
<script type="text/javascript" src="../files/bower_components/jscolor/js/jscolor.js"></script>
<!-- Mini-color js -->
<script type="text/javascript" src="../files/bower_components/jquery-minicolors/js/jquery.minicolors.min.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="../files/assets/pages/advance-elements/custom-picker.js"></script>
<script src="../files/assets/pages/data-table/js/data-table-custom.js"></script>
<script type="text/javascript" src="../files/assets/pages/advance-elements/select2-custom.js"></script>
<script src="../files/assets/js/pcoded.min.js"></script>
<script src="../files/assets/js/vertical/vertical-layout.min.js"></script>
<script src="../files/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="../files/assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</php>
<?php
    if (isset($_GET['men']) && $_GET['men'] == 'ok') {
?>
        <script language="JavaScript" type="text/javascript">
            Swal.fire({
                title: 'Éxito',
                text: 'Datos consolidados insertados correctamente',
                icon: 'success',
                backdrop: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: true,
                showConfirmButton: true,

                didClose: () => {
                  window.location.href = 'other.php';
                }
            });
        </script>
<?php

    }
?>
<?php
    if (isset($_GET['men']) && $_GET['men'] == 'error') {
?>
        <script language="JavaScript" type="text/javascript">
            Swal.fire({
                title: 'Error',
                text: 'Hubo un error, vuelva a intentarlo',
                icon: 'error',
                backdrop: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: true,
                showConfirmButton: true,

                didClose: () => {
                  window.location.href = 'other.php';
                }
            });
        </script>
<?php

    }
?>