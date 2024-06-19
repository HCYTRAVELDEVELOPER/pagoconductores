<?php
session_start();

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    // Redirigir a la página de inicio de sesión si no ha iniciado sesión
    header("Location: login.php");
    exit();
}
error_reporting(1);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if(isset($_POST['consolidar'])) {
    $ciudadesPartida = explode(",", $_POST['ciudad_partida']);
    $fechaInicio = $_POST['fecha_inicio'] . " 00:00:00";
    $fechaFin = $_POST['fecha_fin'] . " 23:59:00";
    $ciudadPersonalizada = $_POST['ciudad_personalizada'];

    $ciudadesPartidaStr = "'" . implode("','", $ciudadesPartida) . "'";

    $sql = "SELECT CiudadPartida, 
            ConductorNombre, 
            SUM(CAST(REPLACE(SUBSTRING(ESTValortransferz, 2), ',', '') AS DECIMAL(10, 2))) AS SumaESTValortransferz, 
            COUNT(*) AS CantidadServicios, 
            SUM(valorpesos) as SumaValorPesos,
            SUM(Empresaafacturar) as SumaEmpresaafacturar
            FROM servicios 
            WHERE CiudadPartida IN ($ciudadesPartidaStr) 
            AND Fechaservicio BETWEEN '$fechaInicio' AND '$fechaFin' 
            GROUP BY CiudadPartida, ConductorNombre";

    $result = $conn->query($sql);

   

    if ($result->num_rows > 0) {
        $consolidatedTableName = "tabla_consolidada"; // Nombre de la tabla consolidada
        $insertQuery = "INSERT INTO $consolidatedTableName (CiudadPartida, ConductorNombre, SumaESTValortransferz, CantidadServicios, SumaValorPesos, CiudadPersonalizada, FechaInicio, FechaFin, SumaNoShow) VALUES ";

        // Iterar a través de los resultados para construir la consulta de inserción
        while($row = $result->fetch_assoc()) {
            $insertQuery .= "('{$row["CiudadPartida"]}', '{$row["ConductorNombre"]}', '{$row["SumaESTValortransferz"]}', '{$row["CantidadServicios"]}', '{$row["SumaValorPesos"]}', '$ciudadPersonalizada', '$fechaInicio', '$fechaFin', '{$row["SumaEmpresaafacturar"]}'), ";
            
        }
        $insertQuery = rtrim($insertQuery, ', '); // Eliminar la coma y el espacio extra al final
        echo $insertQuery;

        // Ejecutar la consulta de inserción
        if ($conn->query($insertQuery) === TRUE) {
            header('Location:pagos_conductores.php?men=ok');
            /* echo "Datos consolidados insertados correctamente en la tabla $consolidatedTableName"; */
            
            ?>

            <a href="visualizar_consolidado1.php">Ver datos consolidados</a>
<?php
            
        } else {
           // header('Location:other.php?men=error');
            /* echo "Error al insertar datos consolidados: " . $conn->error; */
        }
    } else {
        echo "No se encontraron resultados para consolidar";
    }
}

$conn->close();
?>
