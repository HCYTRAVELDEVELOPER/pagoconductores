<?php
require_once 'dompdf/autoload.inc.php'; // Ruta al autoload de dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

// Variables de conexión y consulta
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";


$ciudadPersonalizadaSeleccionada = $_GET['ciudadPersonalizadaSeleccionada']; // Ejemplo de ciudad seleccionada
$fechaInicio = $_GET['fechaInicio']; // Ejemplo de fecha de inicio
$fechaFin = $_GET['fechaFin']; // Ejemplo de fecha de fin";

$totalSumaESTValortransferz = 0;
$totalCantidadServicios = 0;
$totalSumaServicios = 0;
$totalNoShow = 0;
$cantidad = 0;

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

$sql = "SELECT CiudadPartida, ConductorNombre, SumaESTValortransferz, CantidadServicios, SumaValorPesos, FechaInicio, FechaFin, SumaNoShow
        FROM tabla_consolidada 
        WHERE CiudadPersonalizada = ? 
        AND FechaInicio >= ? AND FechaFin <= ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $ciudadPersonalizadaSeleccionada, $fechaInicio, $fechaFin);

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
$html .= '<div class="header-info">';
$html .= '<img src="ruta/al/logo_empresa.png" alt="Logo Empresa" style="max-width: 200px;">'; // Reemplaza con la ruta real de tu logo
$html .= '<h2>Informe de Servicios</h2>';
$html .= '<p><strong>Nombre de la Empresa:</strong> HCYGrupo</p>'; // Nombre de la empresa
$html .= '<p><strong>Ciudad Personalizada:</strong> ' . $ciudadPersonalizadaSeleccionada . '</p>';
$html .= '<p><strong>Fecha de Inicio:</strong> ' . $fechaInicio . '</p>';
$html .= '<p><strong>Fecha Fin:</strong> ' . $fechaFin . '</p>';
$html .= '</div>';

// Tabla HTML con los resultados de la consulta
$html .= '<table>
            <tr>
                <th>Ciudad de Partida</th>
                <th>Conductor</th>
                <th>Suma ESTValorTransferz</th>
                <th>Cantidad de Servicios</th>
                <th>Suma Valor Pesos</th>
                <th>Suma No Shows</th>
                <th>Fecha de Inicio</th>
                <th>Fecha Fin</th>
                
            </tr>';


while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $row['CiudadPartida'] . '</td>';
    $html .= '<td>' . $row['ConductorNombre'] . '</td>';
    $html .= '<td>' . $row['SumaESTValortransferz'] . '</td>';
    $html .= '<td>' . $row['CantidadServicios'] . '</td>';
    $html .= '<td>' . $row['SumaValorPesos'] . '</td>';
    $html .= '<td>' . $row['SumaNoShow'] . '</td>';
    $html .= '<td>' . $row['FechaInicio'] . '</td>';
    $html .= '<td>' . $row['FechaFin'] . '</td>';
    
    $html .= '</tr>';

    $totalSumaESTValortransferz += $row["SumaESTValortransferz"];
    $totalCantidadServicios += $row["CantidadServicios"];
    $totalSumaServicios += $row["SumaValorPesos"];
    $totalNoShow += $row["SumaNoShow"];
    $cantidad++;
}
$totalPagar = $totalSumaServicios  - $totalNoShow;
$html .= '</table>';

// Totales en forma de tabla
$html .= '<table style="margin-top: 20px; width: 50%;">
            
            <tr>
                <td><strong>Total Cantidad de Servicios:</strong></td>
                <td>'.$cantidad.'</td> <!-- Reemplaza con el total real -->
            </tr>

            <tr>
                <td><strong>Total Suma ESTValorTransferz:</strong></td>
                <td>'.$totalSumaESTValortransferz.'</td> <!-- Reemplaza con el total real -->
            </tr>
            
            <tr>
                <td><strong>Total Suma Servicios:</strong></td>
                <td>'.$totalSumaServicios.'</td> <!-- Reemplaza con el total real -->
            </tr>
            <tr>
                <td><strong>Total Suma No Shows:</strong></td>
                <td>'.$totalNoShow.'</td> <!-- Reemplaza con el total real -->
            </tr>
            
            <tr>
                <td><strong>Total a Pagar:</strong></td>
                <td>'.$totalPagar.'</td> <!-- Reemplaza con el total real -->
            </tr>
          </table>';

// Fin del contenido HTML
$html .= '</body></html>';

// Cargar el contenido HTML en dompdf
$dompdf->loadHtml($html);

// Renderizar el PDF
$dompdf->render();

// Nombre del archivo de salida
$filename = 'informe_consolidado.pdf';

// Guardar el PDF en el servidor (en lugar de enviar al navegador)
file_put_contents($filename, $dompdf->output());

// Establecer encabezados para descargar el archivo
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Content-Length: ' . filesize($filename));

// Enviar el archivo al navegador
readfile($filename);

// Cerrar conexión y salida
$stmt->close();
$conn->close();

// Salir del script después de la descarga
exit;
?>