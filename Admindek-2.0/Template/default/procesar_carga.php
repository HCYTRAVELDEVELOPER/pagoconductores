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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetAlert Ejemplo</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
error_reporting(0);
// Incluir la biblioteca php-excel-reader
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

// Establecer la conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La conexión a la base de datos falló: " . $conn->connect_error);
}

// Verificar si se envió un archivo
if (isset($_FILES['archivo_excel']) && $_FILES['archivo_excel']['error'] === UPLOAD_ERR_OK) {
    // Ruta temporal del archivo subido
    $archivo_temporal = $_FILES['archivo_excel']['tmp_name'];

    // Crear una instancia de la clase excel_reader
    $excel = new Spreadsheet_Excel_Reader($archivo_temporal);

    // Definir la tabla destino y obtener las columnas de la tabla servicios
    $tabla_destino = "servicios";
    $columnas_destino = obtenerColumnas($conn, $tabla_destino); // Función para obtener las columnas de la tabla

    // Preparar la consulta SQL para inserción
    $sql = "INSERT INTO $tabla_destino (" . implode(', ', $columnas_destino) . ") VALUES (" . str_repeat('?, ', count($columnas_destino) - 1) . "?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Error al preparar la consulta: ' . htmlspecialchars($conn->error));
    }

    // Iterar sobre las filas del archivo Excel (empezando desde la segunda fila, omitiendo encabezados)
    for ($fila = 2; $fila <= $excel->rowcount(); $fila++) {
        // Obtener datos de la fila actual del archivo Excel
        $row = [];
        for ($col = 1; $col <= $excel->colcount(); $col++) {
            $row[] = $excel->val($fila, $col);
        }

        // Asignar valores y ejecutar la consulta preparada
        $tipos = obtenerTipos($conn, $tabla_destino); // Función para obtener los tipos de datos de las columnas
        $stmt = vincularParametros($stmt, $tipos, $row); // Función para vincular parámetros

        if ($stmt->execute()) {
            //echo "Fila $fila insertada correctamente.<br>";
        } else {
            echo "Error al insertar fila $fila: " . htmlspecialchars($stmt->error) . "<br>";
        }
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conn->close();
    
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Éxito',
                text: 'Archivo subido y procesado correctamente',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirigir al usuario al menú principal
                    window.location.href = 'other.php'; // Reemplaza 'menu.html' con la URL de tu menú
                }
            });
        });
    </script>";
} else {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: 'Error',
                text: 'Error al subir el archivo',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    </script>";
} 

// Función para obtener las columnas de la tabla desde la base de datos
function obtenerColumnas($conn, $tabla) {
    $columnas = [];
    $query = "SHOW COLUMNS FROM $tabla";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $columnas[] = $row['Field'];
        }
    }
    return $columnas;
}

// Función para obtener los tipos de datos de las columnas
function obtenerTipos($conn, $tabla) {
    $tipos = [];
    $query = "SHOW COLUMNS FROM $tabla";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tipos[] = $row['Type'];
        }
    }
    return $tipos;
}

// Función para vincular parámetros
function vincularParametros($stmt, $tipos, $valores) {
    $params = [];
    foreach ($tipos as $key => $type) {
        switch (true) {
            case strpos($type, 'int') !== false:
                $params[] = (int) $valores[$key];
                break;
            case strpos($type, 'float') !== false:
                $params[] = (float) $valores[$key];
                break;
            default:
                $params[] = (string) $valores[$key];
        }
    }
    $bind_names[] = implode('', array_map(function ($val) {
        return 's';
    }, $params));
    $bind_params = array_merge($bind_names, $params);
    $stmt->bind_param(...$bind_params);
    return $stmt;
}
?>
</body>
</html>
