<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirigir a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login.php");
    exit();
}

error_reporting(0);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['bookingcode'])) {
    $bookingcode = $_POST['bookingcode'];

    $sql = "SELECT ESTValortransferz FROM servicios WHERE Bookingcode = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("s", $bookingcode);

    if (!$stmt->execute()) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    
    $valorEST = str_replace('$', '', $row["ESTValortransferz"]);
    $valorEST = str_replace(',', '', $valorEST);
    $nuevoValor = floatval($valorEST) * 1.5;

    $sqlUpdate = "UPDATE servicios SET Empresaafacturar = ? WHERE Bookingcode = ?";
    $stmtUpdate = $conn->prepare($sqlUpdate);

    if ($stmtUpdate === false) {
        die("Error al preparar la actualización: " . $conn->error);
    }

    $stmtUpdate->bind_param("ds", $nuevoValor, $bookingcode);

    if (!$stmtUpdate->execute()) {
        die("Error al ejecutar la actualización: " . $stmtUpdate->error);
    }

    echo "Actualización exitosa";
    
    $stmt->close();
    $stmtUpdate->close();
    $conn->close();
} else {
    echo "Faltan parámetros para realizar la actualización";
}
?>
