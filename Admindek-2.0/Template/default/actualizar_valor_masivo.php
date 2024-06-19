<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['valorPesos']) && isset($_POST['conductor']) && isset($_POST['fechaInicio']) && isset($_POST['fechaFin']) && isset($_POST['ciudadPartida'])) {
    $valorPesos = $_POST['valorPesos'];
    $conductor = $_POST['conductor'];
    $fechaInicio = $_POST['fechaInicio'];
    $fechaFin = $_POST['fechaFin'];
    $ciudadPartida = $_POST['ciudadPartida'];

    $sql = "UPDATE servicios SET ValorPesos = ? WHERE ConductorNombre = ? AND CiudadPartida = ? AND Fechaservicio BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $conn->error);
    }

    $stmt->bind_param("sssss", $valorPesos, $conductor, $ciudadPartida, $fechaInicio, $fechaFin);

    if (!$stmt->execute()) {
        die("Error al ejecutar la consulta: " . $stmt->error);
    }

?>
        <script language="JavaScript" type="text/javascript">
            Swal.fire({
                title: 'Éxito',
                text: 'Valor actualizado correctamente',
                icon: 'success',
                backdrop: true,
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false,
                stopKeydownPropagation: true,
                showConfirmButton: true,

                didClose: () => {
                  window.location.href = 'other.php';
                }
            });
        </script>
<?php



    $stmt->close();
    $conn->close();
} else {
    echo "Faltan parámetros para actualizar los valores";
}
?>
