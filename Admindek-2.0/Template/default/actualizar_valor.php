<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirigir a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login.php");
    exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['bookingcode']) && isset($_POST['valorPesos'])) {
    $bookingcode = $_POST['bookingcode'];
    $valorPesos = $_POST['valorPesos'];

    $sql = "UPDATE servicios SET ValorPesos = ? WHERE Bookingcode = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("ss", $valorPesos, $bookingcode);

    if (!$stmt->execute()) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

    echo "Valor actualizado correctamente";

    $stmt->close();
    $conn->close();
} else {
    echo "Faltan parámetros para actualizar el valor";
}
?>
