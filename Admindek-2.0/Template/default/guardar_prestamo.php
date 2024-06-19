<!-- archivo: guardar_prestamo.php -->
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['conductor']) && isset($_POST['fecha_inicio']) && isset($_POST['fecha_fin']) && isset($_POST['prestamo']) && isset($_POST['ciudad_partida']) && isset($_POST['ciudades_busqueda'])) {
    $conductor = $_POST['conductor'];
    $fechaInicio = $_POST['fecha_inicio'];
    $fechaFin = $_POST['fecha_fin'];
    $prestamo = $_POST['prestamo'];
    $ciudad_partida = $_POST['ciudad_partida'];
    $ciudades_busqueda = $_POST['ciudades_busqueda'];

    // Consulta para insertar el préstamo
    $sql = "INSERT INTO prestamos (ConductorNombre, FechaInicio, FechaFin, ValorPrestamo) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("sssd", $conductor, $fechaInicio, $fechaFin, $prestamo);

    if ($stmt->execute()) {
        /* echo "Prestamo realizado con éxito"; */
        header("Location: detalles_servicios.php?conductor=$conductor&fecha_inicio=$fechaInicio&fecha_fin=$fechaFin&ciudad_partida=$ciudad_partida&ciudades_busqueda=$ciudades_busqueda&men=1");
    } else {
        echo "Error al registrar el préstamo: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Faltan parámetros para registrar el préstamo";
}
?>
