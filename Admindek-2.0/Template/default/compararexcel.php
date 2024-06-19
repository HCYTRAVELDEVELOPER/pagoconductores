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

// Incluir las bibliotecas excel_reader2 y SpreadsheetReader
require_once('vendor/php-excel-reader/excel_reader2.php');
require_once('vendor/SpreadsheetReader.php');

// Incluir la biblioteca PHPExcel
require_once('PHPExcel/Classes/PHPExcel.php');

// Ruta de los archivos de Excel
$archivo1 = 'plantilla.xls'; // Ruta del primer archivo
$archivo2 = 'junio.xls'; // Ruta del segundo archivo

// Función para cargar datos de un archivo Excel
function cargarDatosExcel($archivo) {
    $reader = new SpreadsheetReader($archivo);
    $sheets = $reader->Sheets();
    $reader->ChangeSheet(0); // Cambiar a la primera hoja

    $datos = [];
    foreach ($reader as $fila) {
        $datos[] = $fila;
    }
    return $datos;
}

// Función para organizar los datos según las columnas del primer archivo
function organizarDatos($datosArchivo1, $datosArchivo2) {
    $dataOrganizado = [];

    foreach ($datosArchivo1 as $indice => $fila) {
        if ($indice === 0) {
            // Ignorar la primera fila que contiene encabezados
            continue;
        }

        $filaOrganizada = [];
        foreach ($fila as $columna => $valor) {
            // Buscar la columna correspondiente en el segundo archivo
            $columnaArchivo2 = array_search($valor, $datosArchivo2[0]);

            // Si se encuentra la columna en el segundo archivo, añadir su valor organizado
            if ($columnaArchivo2 !== false && isset($datosArchivo2[$indice][$columnaArchivo2])) {
                $filaOrganizada[] = $datosArchivo2[$indice][$columnaArchivo2];
            } else {
                $filaOrganizada[] = ''; // Añadir valor vacío si no se encuentra la columna correspondiente
            }
        }
        $dataOrganizado[] = $filaOrganizada;
    }
    return $dataOrganizado;
}

// Cargar datos del primer archivo
$datosArchivo1 = cargarDatosExcel($archivo1);

// Cargar datos del segundo archivo
$datosArchivo2 = cargarDatosExcel($archivo2);

// Organizar datos del segundo archivo en el mismo orden que el primer archivo
$dataOrganizado = organizarDatos($datosArchivo1, $datosArchivo2);

// Crear un nuevo objeto PHPExcel
$objPHPExcel = new PHPExcel();

// Configurar las propiedades del documento
$objPHPExcel->getProperties()->setCreator("Tu Nombre")
                             ->setLastModifiedBy("Tu Nombre")
                             ->setTitle("Archivo Organizado")
                             ->setSubject("Archivo Organizado")
                             ->setDescription("Archivo generado y organizado")
                             ->setKeywords("archivo organizado excel php")
                             ->setCategory("Archivo");

// Seleccionar la hoja activa
$objPHPExcel->setActiveSheetIndex(0);
$hoja = $objPHPExcel->getActiveSheet();

// Escribir los datos organizados en el nuevo archivo
foreach ($dataOrganizado as $fila => $datos) {
    foreach ($datos as $columna => $valor) {
        $hoja->setCellValueByColumnAndRow($columna, $fila + 1, $valor);
    }
}

// Establecer el formato de archivo
$tipoArchivo = 'Excel5';
$archivoNuevo = 'archivo_organizado.xls';

// Guardar el archivo en el servidor
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $tipoArchivo);
$objWriter->save($archivoNuevo);

// Descargar el archivo generado
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $archivoNuevo . '"');
header('Cache-Control: max-age=0');

readfile($archivoNuevo);
unlink($archivoNuevo); // Eliminar el archivo después de la descarga

exit;
?>