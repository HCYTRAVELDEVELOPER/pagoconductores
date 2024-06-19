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
                                <i class="feather icon-inbox bg-c-yellow"></i>
                                <div class="d-inline">
                                    <h5>Conductores</h5>
                                    <span>Tabla Conductores</span>
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
                            <h5>Conductores Agregados</h5>
                          </div>
                          <div class="card-block">
                            <div class="table-responsive dt-responsive">
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
                                    
                                $sql = "SELECT id, nombre_conductor, correo, telefono, placa, ciudad FROM conductores ORDER BY id desc";
                                $result = $conn->query($sql);

                                if ($result !== false && $result->num_rows > 0) {
                                        
                            ?>
                            <table id="new-cons" class="table table-striped table-bordered nowrap">
                                <thead>
                                  <tr>
                                    <th>Nombre Conductor</th>
                                    <th>Correo</th>
                                    <th>Telefono</th>
                                    <th>Placa</th>
                                    <th>Cuidad</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        while ($row = $result->fetch_assoc()) {
                                            $telefono = $row["telefono"];
                                            $mensaje = "Hola, le escribimos de HCYGRUPO, queremos informarle que el valor de su servicio ha sido actualizado, por favor comuníquese con nosotros para más información. Gracias.";
                                            $enlace_whatsapp = "https://wa.me/$telefono/?text=$mensaje";
                                    ?>
                                  <tr>
                                    <td><?php echo $row["nombre_conductor"]; ?></td>
                                    <td><?php echo $row["correo"]; ?></td>
                                    <td><a href="<?php echo $enlace_whatsapp; ?>" target="_blank"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/1197px-WhatsApp.svg.png" alt="WhatsApp" width="20px"></a><?php echo $row["telefono"]; ?></td>
                                    <td><?php echo $row["placa"]; ?></td>
                                    <td><?php echo $row["ciudad"]; ?></td>
                                  </tr>
                                  <?php
                                      }
                                  ?>
                                </tbody>
                            </table>
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
                                  <button type="button" class="btn btn-secondary btn-round waves-effect waves-light" data-bs-dismiss="modal">Close</button>
                                  <button class="btn btn-warning btn-round waves-effect waves-light" id="btnActualizarMasivamente">Actualizar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <?php
                                  } else {
                                    echo "No se encontraron resultados";
                                  }
                                 
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
