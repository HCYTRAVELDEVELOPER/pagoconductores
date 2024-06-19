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

$ciudadesPartida = isset($_POST['ciudad_partida']) ? $_POST['ciudad_partida'] : [];
$fechaInicio = $_POST['fecha_inicio'] . " 00:00:00";
$fechaFin = $_POST['fecha_fin'] . " 23:59:00";
$ciudadPersonalizada = $_POST['ciudad_personalizada'];

$ciudadesPartidaStr = "'" . implode("','", $ciudadesPartida) . "'";

$sql = "SELECT CiudadPartida, 
        ConductorNombre, 
        SUM(CAST(REPLACE(SUBSTRING(ESTValortransferz, 2), ',', '') AS DECIMAL(10, 2))) AS SumaESTValortransferz, 
        COUNT(*) AS CantidadServicios, 
        Sum(valorpesos) as SumaValorPesos 
        FROM servicios 
        WHERE CiudadPartida IN ($ciudadesPartidaStr) 
        AND Fechaservicio BETWEEN '$fechaInicio' AND '$fechaFin' 
        GROUP BY CiudadPartida, ConductorNombre";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
            <table id="dom-jqry" class="table table-striped table-bordered nowrap">
                <thead>
                    <tr>
                        <th>Ciudad Partida</th>
                        <th>Conductor Nombre</th>
                        <th>Suma de los ESTValorTransferz</th>
                        <th>Cantidad de Servicios</th>
                        <th>Suma Servicios</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalSumaESTValortransferz = 0;
                    $totalCantidadServicios = 0;
                    $totalSumaServicios = 0;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["CiudadPartida"] . "</td>";
                        echo "<td><a href='detalles_servicios.php?conductor=" . urlencode($row["ConductorNombre"]) . "&fecha_inicio=" . urlencode($_POST["fecha_inicio"]) . "&fecha_fin=" . urlencode($_POST["fecha_fin"]) . "&ciudad_partida=" . urlencode($row["CiudadPartida"]) . "'>" . $row["ConductorNombre"] . "</a></td>";

                        echo "<td>" . $row["SumaESTValortransferz"] . "</td>";
                        echo "<td>" . $row["CantidadServicios"] . "</td>";
                        echo "<td>" . $row["SumaValorPesos"] . "</td>";
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
                    echo "</tr>";
                    ?>
                </tbody>
            </table>
    <?php
    // Botón para consolidar los datos
    echo "<form method='post' action='consolidar.php'>";
    echo "<input type='hidden' name='ciudad_partida' value='" . implode(",", $ciudadesPartida) . "'>";
    echo "<input type='hidden' name='fecha_inicio' value='" . $_POST['fecha_inicio'] . "'>";
    echo "<input type='hidden' name='fecha_fin' value='" . $_POST['fecha_fin'] . "'>";
    echo "<input type='hidden' name='ciudad_personalizada' value='" . $_POST['ciudad_personalizada'] . "'>";
    echo "<input class='form-control btn btn-primary' type='submit' name='consolidar' value='Consolidar datos'>";
    echo "</form>";
    
} else {
    echo "No se encontraron resultados";
}

$conn->close();
?>


