<?php
error_reporting(0);
require_once 'dompdf/autoload.inc.php'; // Ruta al autoload de dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

// Variables de conexión y consulta
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";


$ciudadPartida = $_GET['ciudadPartida']; // Ejemplo de ciudad de partida
$conductorNombre = $_GET['conductorNombre']; // Ejemplo de nombre de conductor
$fechaInicio = $_GET['fechaInicio']; // Ejemplo de fecha de inicio
$fechaFin = $_GET['fechaFin'];


$sumaESTValortransferz = 0;
                        $sumaValorPesos = 0;
                        $cantidadViajes = 0;
                        $sumanoshows = 0;
                        $sumaValorPrestamo = 0;
// Configurar opciones para dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true); // Habilitar el parser de HTML5
$options->set('isPhpEnabled', true); // Habilitar el procesamiento de PHP

// Crear instancia de dompdf con las opciones configuradas
$dompdf = new Dompdf($options);

// Consulta SQL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$sql = "SELECT s.Bookingcode, s.Fechaservicio, s.CiudadPartida, s.ConductorNombre, s.ESTValortransferz, s.ValorPesos, 
                s.ApuntoPartida, s.BpuntoDestino, s.ParadasPasajeros, s.Empresaafacturar,
                p.ValorPrestamo
        FROM servicios s
        LEFT JOIN prestamos p ON s.ConductorNombre = p.ConductorNombre
                                AND s.Fechaservicio BETWEEN p.FechaInicio AND p.FechaFin
        WHERE s.ConductorNombre = ? 
        AND s.CiudadPartida = ?
        AND s.Fechaservicio BETWEEN ? AND ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $conductorNombre, $ciudadPartida, $fechaInicio, $fechaFin);

if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

$result = $stmt->get_result();

// Inicio del contenido HTML para el PDF
$html = '<html>
            <head>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        font-size: 10px;
                    }
                    .header {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    .header h2 {
                        margin: 0;
                        padding: 5px;
                    }
                    .header p {
                        margin: 5px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 20px;
                        font-size: 10px;
                    }
                    th, td {
                        border: 1px solid #ccc;
                        padding: 5px;
                        text-align: left;
                    }
                    th {
                        background-color: #f2f2f2;
                        font-weight: bold;
                        text-transform: uppercase;
                    }
                    .totals {
                        margin-top: 20px;
                        font-weight: bold;
                        font-size: 12px;
                    }
                </style>
            </head>
            <body>';

// Encabezado con detalles adicionales
$html .= '<div class="header">';
$html .= '<h2>Informe de Servicios</h2>';
$html .= '<p><strong>Nombre de la Empresa:</strong> NombreEmpresa</p>'; // Reemplaza 'NombreEmpresa' con el nombre real de la empresa
$html .= '<p><strong>Conductor:</strong> ' . $conductorNombre . '</p>';
$html .= '<p><strong>Correo:</strong> conductor@example.com</p>'; // Reemplaza 'conductor@example.com' con el correo real del conductor
$html .= '<p><strong>Fecha de Inicio:</strong> ' . $fechaInicio . '</p>';
$html .= '<p><strong>Fecha Final:</strong> ' . $fechaFin . '</p>';

$html .= '</div>';

// Tabla HTML con los resultados de la consulta
$html .= '<table>
            <thead>
                <tr>
                    <th>Bookingcode</th>
                    <th>Fecha de Servicio</th>                    
                    
                    <th>Punto de Partida</th>
                    <th>Punto de Destino</th>
                    <th>Paradas de Pasajeros</th>
                    <th>Valor en Pesos</th>
                    <th>Noshow</th>
                    
                </tr>
            </thead>
            <tbody>';

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $row['Bookingcode'] . '</td>';
    $html .= '<td>' . $row['Fechaservicio'] . '</td>';
   
    $html .= '<td>' . $row['ApuntoPartida'] . '</td>';
    $html .= '<td>' . $row['BpuntoDestino'] . '</td>';
    $html .= '<td>' . $row['ParadasPasajeros'] . '</td>';
    $html .= '<td>' . $row['ValorPesos'] . '</td>';
    $html .= '<td>' . $row['Empresaafacturar'] . '</td>';
    
    $html .= '</tr>';

    $sumaValorPesos += $row["ValorPesos"];
    $sumanoshows += $row["Empresaafacturar"];
    $sumaValorPrestamo = $row["ValorPrestamo"];
    $cantidadViajes++;


}
$totalPagar = $sumaValorPesos - $sumaValorPrestamo - $sumanoshows;

$html .= '</tbody></table>';

// Totales
$html .= '<div class="totals">';
$html .= '<p><strong>Totales</strong></p>';
$html .= '<p>Total Servicios: '.$cantidadViajes.'</p>'; // Reemplaza con el valor real calculado
$html .= '<p>Total Suma de Servicios: '.$sumaValorPesos.'</p>'; // Reemplaza con el valor real calculado
$html .= '<p>Total Suma No Shows: '.$sumanoshows.'</p>'; // Reemplaza con el valor real calculado
$html .= '<p>Total Valor de Prestamo: '.$sumaValorPrestamo.'</p>'; // Reemplaza con el valor real calculado
$html .= '<p>Total a Pagar: '.$totalPagar.'</p>'; // Reemplaza con el valor real calculado
$html .= '</div>';

// Fin del contenido HTML
$html .= '</body></html>';

// Cargar el contenido HTML en dompdf
$dompdf->loadHtml($html);

// Renderizar el PDF
$dompdf->render();

// Nombre del archivo de salida
$filename = 'informe_servicios.pdf';

// Guardar el PDF en el servidor temporalmente
$output = $dompdf->output();
file_put_contents($filename, $output);

// Descargar el archivo PDF
header('Content-Description: File Transfer');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . filesize($filename));
readfile($filename);

// Eliminar el archivo PDF del servidor después de la descarga
unlink($filename);

// Cerrar conexión y salida
$stmt->close();
$conn->close();
?>
