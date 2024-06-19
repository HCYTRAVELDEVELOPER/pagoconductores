<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'dompdf/autoload.inc.php'; // Ruta al autoload de dompdf

use Dompdf\Dompdf;
use Dompdf\Options;

// Variables de conexión y consulta
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_pagos";
$ciudadPartida = 'Salta'; // Ejemplo de ciudad de partida
$conductorNombre = 'HUMBERTO CONDON'; // Ejemplo de nombre de conductor
$fechaInicio = "2024-02-01";
$fechaFin = "2024-06-30";

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

$sql = "SELECT s.Bookingcode, s.Fechaservicio, s.CiudadPartida, s.ConductorNombre, 
               SUM(CAST(REPLACE(SUBSTRING(s.ESTValortransferz, 2), ',', '') AS DECIMAL(10, 2))) AS SumaESTValortransferz, 
               COUNT(*) AS CantidadServicios,
               SUM(s.Empresaafacturar) as SumaEmpresaafacturar,
               SUM(s.ValorPesos) as SumaValorPesos,
               p.ValorPrestamo
        FROM servicios s
        LEFT JOIN prestamos p ON s.ConductorNombre = p.ConductorNombre
                                AND s.Fechaservicio BETWEEN p.FechaInicio AND p.FechaFin
        WHERE s.ConductorNombre = ? 
        AND s.CiudadPartida = ?
        AND s.Fechaservicio BETWEEN ? AND ?
        GROUP BY s.CiudadPartida, s.ConductorNombre";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $conductorNombre, $ciudadPartida, $fechaInicio, $fechaFin);

if (!$stmt->execute()) {
    die("Error al ejecutar la consulta: " . $stmt->error);
}

$result = $stmt->get_result();

// Calcular totales
$totalSumaESTValortransferz = 0;
$totalCantidadServicios = 0;
$totalSumaServicios = 0;
$totalSumaNoShows = 0;

// Inicio del contenido HTML para el PDF
$html = '<html>
            <head>
                <style>
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 20px;
                    }
                    th, td {
                        border: 1px solid black;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f2f2f2;
                    }
                    .header-info {
                        margin-bottom: 20px;
                    }
                    .totals {
                        margin-top: 20px;
                        font-weight: bold;
                    }
                    .totals td {
                        padding: 8px;
                        text-align: right;
                    }
                    .horizontal-table {
                        width: 100%;
                        overflow-x: auto;
                    }
                </style>
            </head>
            <body>';

// Encabezado con detalles adicionales
$html .= '<div class="header-info">';
$html .= '<h2>Informe de Servicios</h2>';
$html .= '<p><strong>Nombre de la Empresa:</strong> NombreEmpresa</p>'; // Reemplaza 'NombreEmpresa' con el nombre real de la empresa
$html .= '<p><strong>Conductor:</strong> ' . $conductorNombre . '</p>';
$html .= '<p><strong>Correo:</strong> conductor@example.com</p>'; // Reemplaza 'conductor@example.com' con el correo real del conductor
$html .= '<p><strong>Fecha de Inicio:</strong> ' . $fechaInicio . '</p>';
$html .= '<p><strong>Fecha Final:</strong> ' . $fechaFin . '</p>';
$html .= '<p><strong>Valor de Préstamo:</strong> $1000.00</p>'; // Reemplaza '$1000.00' con el valor real del préstamo
$html .= '</div>';

// Tabla HTML con los resultados de la consulta
$html .= '<div class="horizontal-table">';
$html .= '<table>
            <tr>
                <th>Bookingcode</th>
                <th>Fecha de Servicio</th>
                <th>Ciudad de Partida</th>
                <th>Conductor</th>
                <th>Valor Transferz</th>
                <th>Valor en Pesos</th>
                <th>Punto de Partida</th>
                <th>Punto de Destino</th>
                <th>Paradas de Pasajeros</th>
                <th>Empresa a Facturar</th>
                <th>Valor de Préstamo</th>
            </tr>';

while ($row = $result->fetch_assoc()) {
    $html .= '<tr>';
    $html .= '<td>' . $row['Bookingcode'] . '</td>';
    $html .= '<td>' . $row['Fechaservicio'] . '</td>';
    $html .= '<td>' . $row['CiudadPartida'] . '</td>';
    $html .= '<td>' . $row['ConductorNombre'] . '</td>';
    $html .= '<td>' . $row['SumaESTValortransferz'] . '</td>';
    $html .= '<td>' . $row['SumaValorPesos'] . '</td>';
    $html .= '<td>' . $row['ApuntoPartida'] . '</td>';
    $html .= '<td>' . $row['BpuntoDestino'] . '</td>';
    $html .= '<td>' . $row['ParadasPasajeros'] . '</td>';
    $html .= '<td>' . $row['Empresaafacturar'] . '</td>';
    $html .= '<td>' . $row['ValorPrestamo'] . '</td>';
    $html .= '</tr>';

    // Sumar para los totales
    $totalSumaESTValortransferz += $row["SumaESTValortransferz"];
    $totalCantidadServicios += $row["CantidadServicios"];
    $totalSumaServicios += $row["SumaValorPesos"];
    $totalSumaNoShows += $row["SumaEmpresaafacturar"];
}

$html .= '</table>';
$html .= '</div>'; // Cierre de div horizontal-table

// Mostrar totales
$html .= '<div class="totals">';
$html .= '<table>';
$html .= '<tr><td>Total Suma ESTValortransferz:</td><td>' . $totalSumaESTValortransferz . '</td></tr>';
$html .= '<tr><td>Total Cantidad de Servicios:</td><td>' . $totalCantidadServicios . '</td></tr>';
$html .= '<tr><td>Total Suma Servicios:</td><td>' . $totalSumaServicios . '</td></tr>';
$html .= '<tr><td>Total Suma No Shows:</td><td>' . $totalSumaNoShows . '</td></tr>';
$html .= '</table>';
$html .= '</div>';

// Fin del contenido HTML
$html .= '</body></html>';

// Cargar el contenido HTML en dompdf
$dompdf->loadHtml($html);

// Renderizar el PDF
$dompdf->render();

// Nombre del archivo de salida
$filename = 'informe_servicios.pdf';

// Enviar el PDF al navegador para su descarga
$dompdf->stream($filename, array('Attachment' => 0));

// Cerrar conexión y salida
$stmt->close();
$conn->close();
?>
