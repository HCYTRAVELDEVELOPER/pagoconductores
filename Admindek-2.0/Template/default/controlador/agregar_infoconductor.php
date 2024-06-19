<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre_conductor = $_POST['nombre_conductor'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$placa = $_POST['placa'];
$ciudad = $_POST['ciudad'];

mysqli_query($conn,"INSERT INTO conductores (nombre_conductor, correo, telefono, placa, ciudad) VALUES ('$nombre_conductor', '$correo', '$telefono', '$placa', '$ciudad')");

header("Location:../informacion_conductores.php?men=ok");

?>