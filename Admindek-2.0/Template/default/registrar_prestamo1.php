<!-- archivo: registrar_prestamo.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Registrar Préstamo</title>
</head>
<body>
    <?php
    // Obtener los parámetros de la URL
    if (isset($_GET['conductor']) && isset($_GET['fecha_inicio']) && isset($_GET['fecha_fin'])) {
        $conductor = htmlspecialchars($_GET['conductor']);
        $fechaInicio = htmlspecialchars($_GET['fecha_inicio']);
        $fechaFin = htmlspecialchars($_GET['fecha_fin']);
    } else {
        echo "Faltan parámetros en la URL.";
        exit;
    }
    ?>
    <h2>Registrar Préstamo</h2>
    <form action="guardar_prestamo.php" method="POST">
        <label for="conductor">Nombre del Conductor:</label>
        <input type="text" id="conductor" name="conductor" value="<?php echo $conductor; ?>" readonly><br><br>
        
        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="<?php echo $fechaInicio; ?>" readonly><br><br>
        
        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" value="<?php echo $fechaFin; ?>" readonly><br><br>
        
        <label for="prestamo">Monto del Préstamo:</label>
        <input type="number" id="prestamo" name="prestamo" required><br><br>
        
        <input type="submit" value="Registrar Préstamo">
    </form>
</body>
</html>
