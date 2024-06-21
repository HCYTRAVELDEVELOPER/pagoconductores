<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirigir a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login.php");
    exit();

    //conexion a la bd

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
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

      
    </head>
    

    <body>
      <!-- [ Pre-loader ] start -->
      
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
                
                if (isset($_GET['conductor']) && isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin']) && isset($_GET['ciudad_partida'])) {
                    $conductor = $_GET['conductor'];
                    $fechaInicio = $_GET['fecha_inicio'] . " 00:00:00";
                    $fechaFin = $_GET['fecha_fin'] . " 23:59:59";
                    $ciudadPartida = $_GET['ciudad_partida'];
                    $ciudades_busqueda = $_GET['ciudades_busqueda'];


                    // Consulta para obtener el préstamo
   
                    
                
                            $sql = "SELECT s.Bookingcode, s.Fechaservicio, s.CiudadPartida, s.ConductorNombre, s.ESTValortransferz, s.ValorPesos, 
                            s.ApuntoPartida, s.BpuntoDestino, s.ParadasPasajeros, s.Empresaafacturar,
                            p.ValorPrestamo
                    FROM servicios s
                    LEFT JOIN prestamos p ON s.ConductorNombre = p.ConductorNombre
                                            AND s.Fechaservicio BETWEEN p.FechaInicio AND p.FechaFin
                    WHERE s.ConductorNombre = ? 
                    AND s.CiudadPartida = ?
                    AND s.Fechaservicio BETWEEN ? AND ?";
                
                    $stmt = $conn->prepare($sql);
                
                    if ($stmt === false) {
                        die("Error al preparar la consulta: " . $conn->error);
                    }
                
                    $stmt->bind_param("ssss", $conductor, $ciudadPartida, $fechaInicio, $fechaFin);
                
                    if (!$stmt->execute()) {
                        die("Error al ejecutar la consulta: " . $stmt->error);
                    }
                
                    $result = $stmt->get_result();
                
                    if ($result->num_rows > 0) {
                        // Inicializar las variables para calcular las sumas y contar los viajes
                        $sumaESTValortransferz = 0;
                        $sumaValorPesos = 0;
                        $cantidadViajes = 0;
                        $sumanoshows = 0;
                        $sumaValorPrestamo = 0;
                        // Recorrer los resultados para calcular las sumas y contar los viajes
                        while ($row = $result->fetch_assoc()) {
                          // Convertir el valor ESTValortransferz a un número
                          $valorEST = str_replace('$', '', $row["ESTValortransferz"]);
                          $valorEST = str_replace(',', '', $valorEST);
                          $sumaESTValortransferz += floatval($valorEST);
                  
                          $sumaValorPesos += $row["ValorPesos"];
                          $sumanoshows += $row["Empresaafacturar"];
                          $sumaValorPrestamo = $row["ValorPrestamo"];
                          $cantidadViajes++;
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
                                    <h5>Detalles Servicios</h5>
                                    <span><?php echo $conductor; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header card">
                    <div class="row align-items-end">
                        <div class="col-lg-12">
                          <a class="btn btn-danger btn-round waves-effect waves-light float-center" href="informepersonalconductor.php?ciudadPartida=<?php echo $ciudadPartida;?>&conductorNombre=<?php echo $conductor; ?>&fechaInicio=<?php echo $fechaInicio; ?>&fechaFin=<?php echo $fechaFin;?>"><i class="fa fa-file-pdf-o"></i><span>Descargar PDF</span></a>
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
                            <h5>Totales</h5>
                            <?php
                              echo "<a class='btn btn-warning btn-round waves-effect waves-light float-end' href='registrar_prestamo.php?conductor=" . urlencode($conductor) . "&fecha_inicio=" . urlencode($_GET['fecha_inicio']) . "&fecha_fin=" . urlencode($_GET['fecha_fin']) . "&ciudad_partida=" . urldecode($_GET['ciudad_partida']) . "&ciudades_busqueda=" . urldecode($_GET['ciudades_busqueda']) ."'>Registrar Préstamo</a>";
                            ?>
                          </div>
                          <div class="card-block">
                            <div class="row">
                              <div class="col-lg-4 col-xl-4 col-sm-12">
                                <div class="badge-box text-center">
                                  <div class="sub-title">
                                    <h6>Suma de ESTValortransferz</h6>
                                  </div>
                                  <h6 style="color: #FF9242;"><?php echo $sumaESTValortransferz; ?></h6>
                                </div>
                              </div>
                              <div class="col-lg-4 col-xl-4 col-sm-12">
                                <div class="badge-box text-center">
                                  <div class="sub-title">
                                    <h6>Suma de Valor Pesos:</h6>
                                  </div>
                                  <h6 style="color: #FF9242;"><?php echo $sumaValorPesos; ?></h6>
                                </div>
                              </div>
                              <div class="col-lg-4 col-xl-4 col-sm-12">
                                <div class="badge-box text-center">
                                  <div class="sub-title">
                                    <h6>Suma no shows:</h6>
                                  </div>
                                  <h6 style="color: #FF9242;"><?php echo $sumanoshows; ?></h6>
                                </div>
                              </div>
                              <div class="col-lg-4 col-xl-4 col-sm-12">
                                <div class="badge-box text-center">
                                  <div class="sub-title">
                                    <h6>Cantidad de Viajes:</h6>
                                  </div>
                                  <h6 style="color: #FF9242;"><?php echo $cantidadViajes; ?></h6>
                                </div>
                              </div>

                              <div class="col-lg-4 col-xl-4 col-sm-12">
                                <div class="badge-box text-center">
                                  <div class="sub-title">
                                    <h6>Prestamo:</h6>
                                  </div>
                                  <h6 style="color: #FF9242;"><?php echo $sumaValorPrestamo; ?></h6>
                                </div>
                              </div>

                              <div class="col-lg-4 col-xl-4 col-sm-12">
                                <div class="badge-box text-center">
                                  <div class="sub-title">
                                    <h6>Total a Pagar:</h6>
                                    <?php
                                      $totalPagar = $sumaValorPesos - $sumaValorPrestamo - $sumanoshows;
                                    ?>
                                  </div>
                                  <h6 style="color: #FF9242;"><?php echo $totalPagar; ?></h6>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="card">
                          <div class="card-header">
                            <h5>Tabla</h5>
                              <?php
                                echo "<!-- Botón para abrir el modal -->
                                <button id='btnModal' class='btn btn-warning btn-round waves-effect waves-light float-end'>Cambiar Valor Masivamente</button>";
                              ?>
                          </div>
                          <?php
                            $stmt->execute();
                            $result = $stmt->get_result();
                          ?>
                          <div class="card-block">
                            <div class="table-responsive dt-responsive">
                              <table id="new-cons" class="table table-striped table-bordered nowrap">
                                <thead>
                                  <tr>
                                  <th></th>
                                  <th>Multar</th>
                                    <th>Bookingcode</th>
                                    <th>ParadasPasajeros</th>
                                    <th>Fechaservicio</th>
                                    <th>CiudadPartida</th>
                                    <th>No Show</th>
                                    <th>ESTValortransferz</th>
                                    <th>ValorPesos</th>
                                    <th>ApuntoPartida</th>
                                    <th>BpuntoDestino</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    <?php
                                      while ($row = $result->fetch_assoc()) {
                                    ?>
                                  <tr>
                                  <td></td>
                                  <td><button id="botonModal1" class='btnModal2 btn btn-danger btn-round waves-effect waves-light' data-bookingcode= <?php echo $row["Bookingcode"]; ?>>Multar</button></td>
                                    <td><?php echo $row["Bookingcode"]; ?></td>
                                    <td><?php echo $row["ParadasPasajeros"]; ?></td>
                                    <td><?php echo $row["Fechaservicio"]; ?></td>
                                    <td><?php echo $row["CiudadPartida"]; ?></td>
                                    <td><?php echo $row["Empresaafacturar"]; ?></td>
                                    <td><?php echo $row["ESTValortransferz"]; ?></td>
                                    <?php echo "<td contenteditable='true' class='editable' data-bookingcode='" . $row["Bookingcode"] . "'>" . $row["ValorPesos"] . "</td>";  ?>
                                    <td><?php echo  $row["ApuntoPartida"]; ?></td>
                                    <td><?php echo $row["BpuntoDestino"]; ?></td>
                                    
                                    
                                  </tr>
                                  <?php
                                      }

                                      echo "
                                      <!-- Modal -->
                                      <div id='myModal' class='modal' style='display:none; position:fixed; z-index:1; left:0; top:0; width:100%; height:100%; overflow:auto; background-color:rgb(0,0,0); background-color:rgba(0,0,0,0.4);'>
                                        <div class='modal-content' style='background-color:#fefefe; margin:15% auto; padding:20px; border:1px solid #888; width:80%; max-width:600px;'>
                                          <span class='close' style='color:#aaa; float:right; font-size:28px; font-weight:bold;'>&times;</span>
                                          <h2>Actualizar Valor Masivo</h2>
                                          <p>Ingrese el nuevo valor para todos los servicios:</p>
                                          <input type='text' id='nuevoValorMasivo' class='form-control mb-3'>
                                          <button id='btnActualizarMasivamente' class='btn btn-success'>Actualizar</button>
                                        </div>
                                      </div>";

                                      echo "<div id='myModal1' class='modal' style='display:none; position:fixed; z-index:1; left:0; top:0; width:100%; height:100%; overflow:auto; background-color:rgb(0,0,0); background-color:rgba(0,0,0,0.4);'>";
                                    echo "<div class='modal-content' style='background-color:#fefefe; margin:15% auto; padding:20px; border:1px solid #888; width:80%; max-width:600px;'>";
                                    echo "<span class='close' style='color:#aaa; float:right; font-size:28px; font-weight:bold;'>&times;</span>";
                                    echo "<p>¿Aplicar multa del 150% sobre el valor ESTValortransferz por no Show?</p>";
                                    echo "<button id='btnSi' class='btn btn-success'>Sí</button> <br>";
                                    echo "<button id='btnNo' class='btn btn-danger'>No</button>";
                                    echo "</div>";
                                    echo "</div>";
                                  ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                          
                        </div>
                        <?php
                                  } else {
                                    echo "No se encontraron resultados";
                                  }
                                  $stmt->close();
                                  $conn->close();
                                } else {
                                  echo "Faltan parámetros para ejecutar la consulta";
                                }
                        ?>
                        <!-- DOM/Jquery table end -->
                        <!-- Row Created Callback table end -->
                      </div>
                      
                      <!-- Page-body start -->
                    </div>
                  </div>
               
                  <!-- Main-body end -->
                  <script>

$(document).ready(function() {
    var modal1 = document.getElementById("myModal1");

    // Obtener el botón que abre el modal
    var btnSi = document.getElementById("btnSi");
    var btnNo = document.getElementById("btnNo");
    var span1 = document.getElementsByClassName("close")[0];
    var bookingcodeToUpdate = null;

    // Cuando el usuario haga clic en el botón, abrir el modal
    $('.btnModal2').on('click', function() {
        bookingcodeToUpdate = $(this).data('bookingcode');
        modal1.style.display = "block";
    });

    // Cuando el usuario haga clic en <span> (x), cerrar el modal
    span1.onclick = function() {
        modal1.style.display = "none";
        bookingcodeToUpdate = null;
    }

    // Obtener el modal 
    var modal2 = document.getElementById("myModal");

    // Obtener el botón que abre el modal
    var btn2 = document.getElementById("btnModal");

    // Obtener el elemento <span> que cierra el modal
    var span2 = document.getElementsByClassName("close")[1];

    // Cuando el usuario haga clic en el botón, abrir el modal
    btn2.onclick = function() {
        modal2.style.display = "block";
    }

    // Cuando el usuario haga clic en <span> (x), cerrar el modal
    span2.onclick = function() {
        modal2.style.display = "none";
    }

    // Cuando el usuario haga clic en cualquier parte fuera del modal, cerrarlo
    window.onclick = function(event) {
        if (event.target == modal1) {
            modal1.style.display = "none";
            bookingcodeToUpdate = null;
        }
        if (event.target == modal2) {
            modal2.style.display = "none";
        }
    }

    // Actualizar valor con multa
    btnSi.onclick = function() {
        if (bookingcodeToUpdate) {
            $.ajax({
                url: 'actualizar_valor_con_multa.php',
                method: 'POST',
                data: { bookingcode: bookingcodeToUpdate },
                success: function(response) {
                    alert('Valor actualizado correctamente con multa');
                    modal1.style.display = "none";
                    location.reload();
                }
            });
        }
    }

    // Cerrar el modal al hacer clic en "No"
    btnNo.onclick = function() {
        modal1.style.display = "none";
        bookingcodeToUpdate = null;
    }

    // Actualizar valor individualmente
    $('.editable').on('blur', function() {
        var bookingcode = $(this).data('bookingcode');
        var newValue = $(this).text();
        
        $.ajax({
            url: 'actualizar_valor.php',
            method: 'POST',
            data: { bookingcode: bookingcode, valorPesos: newValue },
            success: function(response) {
                alert('Valor actualizado correctamente');
            }
        });
    });

    // Actualizar valor masivamente
    $('#btnActualizarMasivamente').on('click', function() {
        var nuevoValor = $('#nuevoValorMasivo').val();
        
        $.ajax({
            url: 'actualizar_valor_masivo.php',
            method: 'POST',
            data: { valorPesos: nuevoValor, conductor: "<?php echo $conductor; ?>", fechaInicio: "<?php echo $fechaInicio; ?>", fechaFin: "<?php echo $fechaFin; ?>", ciudadPartida: "<?php echo $ciudadPartida; ?>" },
            success: function(response) {
                Swal.fire({
                title: 'Éxito',
                text: 'Valor actualizado correctamente',
                icon: 'success',
                backdrop: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: true,
                showConfirmButton: true,

                didClose: () => {
                  location.reload();
                }
                });
            }
        });
    });
});

</script>
                  <div id="styleSelector">

                  </div>
                </div>
              </div>
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
<?php
    if (isset($_GET['men']) && $_GET['men'] == 1 && isset($_GET['conductor']) && isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin']) && isset($_GET['ciudad_partida']) && isset($_GET['ciudades_busqueda'])) {
      $conductor1 = $_GET['conductor'];
      $fechaInicio1 = $_GET['fecha_inicio'];
      $fechaFin1 = $_GET['fecha_fin'];
      $ciudad_partida1 = $_GET['ciudad_partida'];
      $ciudades_busqueda1 = $_GET['ciudades_busqueda'];
?>
        <script language="JavaScript" type="text/javascript">
            Swal.fire({
                title: 'Éxito',
                text: 'Prestamo realizado con éxito',
                icon: 'success',
                backdrop: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: true,
                showConfirmButton: true,
                didClose: () => {
                  window.location.href = 'detalles_servicios.php?conductor=<?php echo $conductor1;?>&fecha_inicio=<?php echo $fechaInicio1;?>&fecha_fin=<?php echo $fechaFin1;?>&ciudad_partida=<?php echo $ciudad_partida1;?>&ciudades_busqueda=<?php echo $ciudades_busqueda1;?>';
                }
            });
        </script>
<?php

    }
?>