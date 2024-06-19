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
<html>
<head>
    <title>Detalles de Servicios</title>
    <style>
/* Estilos para el modal */
.modal {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
}

/* Contenido del modal */
.modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}

/* Cerrar el modal */
.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="editar_valor_pesos.js"></script>
</head>
<body>

<?php
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

    $sql = "SELECT Bookingcode, Fechaservicio, CiudadPartida, ConductorNombre, ESTValortransferz, ValorPesos, 
                   ApuntoPartida, BpuntoDestino, ParadasPasajeros 
            FROM servicios 
            WHERE ConductorNombre = ? 
            AND CiudadPartida = ?
            AND Fechaservicio BETWEEN ? AND ?";

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
        echo "<table border='1'>";
        echo "<tr><th>Bookingcode</th><th>Fechaservicio</th><th>CiudadPartida</th><th>ConductorNombre</th><th>ESTValortransferz</th><th>ValorPesos</th><th>ApuntoPartida</th><th>BpuntoDestino</th><th>ParadasPasajeros</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["Bookingcode"] . "</td>";
            echo "<td>" . $row["Fechaservicio"] . "</td>";
            echo "<td>" . $row["CiudadPartida"] . "</td>";
            echo "<td>" . $row["ConductorNombre"] . "</td>";
            echo "<td>" . $row["ESTValortransferz"] . "</td>";
            echo "<td class='valor-pesos' data-booking='" . $row["Bookingcode"] . "' contenteditable>" . $row["ValorPesos"] . "</td>";
            echo "<td>" . $row["ApuntoPartida"] . "</td>";
            echo "<td>" . $row["BpuntoDestino"] . "</td>";
            echo "<td>" . $row["ParadasPasajeros"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        // Botón Volver
        echo "<a href='obtener_resultados.php'>Volver</a>";
        
        // Botón para abrir el modal
        echo "<button id='btnModal'>Cambiar Valor Masivamente</button>";

        // Modal
        echo "<div id='myModal' class='modal'>";
        echo "<div class='modal-content'>";
        echo "<span class='close'>&times;</span>";
        echo "<p>Ingrese el nuevo valor para todos los servicios:</p>";
        echo "<input type='text' id='nuevoValorMasivo'>";
        echo "<button id='btnActualizarMasivamente'>Actualizar</button>";
        echo "</div>";
        echo "</div>";
    } else {
        echo "No se encontraron resultados";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Faltan parámetros para ejecutar la consulta";
}
?>




<script>
// Obtener el modal
var modal = document.getElementById("myModal");

// Obtener el botón que abre el modal
var btn = document.getElementById("myBtn");

// Obtener el elemento <span> que cierra el modal
var span = document.getElementsByClassName("close")[0];

// Cuando el usuario haga clic en el botón, abrir el modal
btn.onclick = function() {
  modal.style.display = "block";
}

// Cuando el usuario haga clic en <span> (x), cerrar el modal
span.onclick = function() {
  modal.style.display = "none";
}

// Cuando el usuario haga clic en cualquier parte fuera del modal, cerrarlo
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
