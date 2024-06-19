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
$fecha_hora = date('d-m-Y H:i:s');

$correo = $_POST['correo'];
$password = $_POST['password'];
$fecha_hora = date('d-m-Y H:i:s');
$nombres = $_POST['nombres'];
$tipodocumento = $_POST['tipodocumento'];
$documento = $_POST['documento'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];

mysqli_query($conn,"INSERT INTO usuarios (correo, password, created_at, nombres, tipodocumento, documento, telefono, direccion) VALUES ('$correo', '$password', '$fecha_hora', '$nombres', '$tipodocumento', '$documento', '$telefono', '$direccion')");

header("Location:../login.php")

?>