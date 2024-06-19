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
    <title>Visualización de Datos Consolidados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        select, input[type="submit"] {
            padding: 5px;
            margin-left: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        h2 {
            color: #333;
        }
        p {
            font-style: italic;
            color: #666;
        }
    </style>
</head>
<body>

<?php
// El código PHP anterior aquí
?>

</body>
</html>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener las ciudades personalizadas agrupadas
$sqlCiudadesPersonalizadas = "SELECT DISTINCT CiudadPersonalizada FROM tabla_consolidada";
$resultCiudades = $conn->query($sqlCiudadesPersonalizadas);

if ($resultCiudades->num_rows > 0) {
    echo "<form method='post' action=''>";
    echo "<label for='ciudad_personalizada'>Seleccione una Ciudad Personalizada:</label>";
    echo "<select name='ciudad_personalizada' id='ciudad_personalizada'>";
    while($row = $resultCiudades->fetch_assoc()) {
        echo "<option value='" . $row['CiudadPersonalizada'] . "'>" . $row['CiudadPersonalizada'] . "</option>";
    }
    echo "</select>";
    echo "<input type='submit' name='ver_datos' value='Ver Datos'>";
    echo "</form>";
} else {
    echo "No hay ciudades personalizadas disponibles.";
}

if (isset($_POST['ver_datos'])) {
    $ciudadPersonalizadaSeleccionada = $_POST['ciudad_personalizada'];

    // Consulta para obtener la fecha más temprana y la fecha más tardía
    $sqlFechas = "SELECT MIN(FechaInicio) AS FechaInicio, MAX(FechaFin) AS FechaFin 
                  FROM tabla_consolidada 
                  WHERE CiudadPersonalizada = '$ciudadPersonalizadaSeleccionada'";
    $resultFechas = $conn->query($sqlFechas);
    $fechas = $resultFechas->fetch_assoc();

    echo "<h2>Datos Consolidados para la Ciudad Personalizada: $ciudadPersonalizadaSeleccionada</h2>";
    echo "<p>Informe desde: " . $fechas['FechaInicio'] . " hasta: " . $fechas['FechaFin'] . "</p>";

    $sql = "SELECT CiudadPartida, ConductorNombre, SumaESTValortransferz, CantidadServicios, SumaValorPesos, FechaInicio, FechaFin 
            FROM tabla_consolidada 
            WHERE CiudadPersonalizada = '$ciudadPersonalizadaSeleccionada'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table class='table'>";
        echo "<thead><tr><th>Ciudad Partida</th><th>Conductor Nombre</th><th>Suma de los ESTValorTransferz</th><th>Cantidad de Servicios</th><th>Suma Valor Pesos</th><th>Fecha Inicio</th><th>Fecha Fin</th></tr></thead>";
        echo "<tbody>";

        $totalSumaESTValortransferz = 0;
        $totalCantidadServicios = 0;
        $totalSumaServicios = 0;

        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["CiudadPartida"] . "</td>";
            echo "<td>" . $row["ConductorNombre"] . "</td>";
            echo "<td>" . $row["SumaESTValortransferz"] . "</td>";
            echo "<td>" . $row["CantidadServicios"] . "</td>";
            echo "<td>" . $row["SumaValorPesos"] . "</td>";
            echo "<td>" . $row["FechaInicio"] . "</td>";
            echo "<td>" . $row["FechaFin"] . "</td>";
            echo "</tr>";

            $totalSumaESTValortransferz += $row["SumaESTValortransferz"];
            $totalCantidadServicios += $row["CantidadServicios"];
            $totalSumaServicios += $row["SumaValorPesos"];
        }

        echo "<tr>";
        echo "<td colspan='2'><b>Total:</b></td>";
        echo "<td><b>" . $totalSumaESTValortransferz . "</b></td>";
        echo "<td><b>" . $totalCantidadServicios . "</b></td>";
        echo "<td><b>" . $totalSumaServicios . "</b></td>";
        echo "<td colspan='2'></td>"; // Columnas vacías para las fechas
        echo "</tr>";

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "No se encontraron datos consolidados para la ciudad personalizada seleccionada.";
    }
}

$conn->close();
?>
