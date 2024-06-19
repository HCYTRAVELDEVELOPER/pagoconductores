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

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    // Validación básica
    if (empty($correo) || empty($password)) {
        header("Location: ../login.php?error=2");
        exit();
    }

    // Usar consultas preparadas para evitar SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE correo = ?");
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result !== false && $result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Verificar la contraseña encriptada
        if (password_verify($password, $row['password'])) {
            // Configurar variables de sesión según sea necesario
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['correo'] = $row['correo'];
            // Redirigir al usuario después del inicio de sesión exitoso
            header("Location: ../other.php"); 
            exit();
        } else {
            // Contraseña incorrecta
            header("Location: ../login.php?error=1");
            exit();
        }
    } else {
        // Usuario no encontrado
        header("Location: ../login.php?error=1");
        exit();
    }
}
?>
