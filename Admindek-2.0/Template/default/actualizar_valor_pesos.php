<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirigir a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login.php");
    exit();
}

if (isset($_POST['booking']) && isset($_POST['valor'])) {
    $booking = $_POST['booking'];
    $valor = $_POST['valor'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "sistema_pagos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "UPDATE servicios SET ValorPesos = ? WHERE Bookingcode = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo "Error al preparar la consulta: " . $conn->error;
    }

    $stmt->bind_param("ss", $valor, $booking);

    if (!$stmt->execute()) {
        echo "Error al ejecutar la consulta: " . $stmt->error;
    } else {
        echo "success";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Faltan parámetros para ejecutar la consulta";
}
?>
