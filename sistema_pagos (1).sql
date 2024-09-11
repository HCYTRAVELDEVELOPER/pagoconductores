-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2024 a las 19:08:33
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_pagos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `app_cargue`
--

CREATE TABLE `app_cargue` (
  `llave` int(11) NOT NULL,
  `Mes` varchar(200) NOT NULL,
  `ID` varchar(200) NOT NULL,
  `Paisorigen` varchar(200) NOT NULL,
  `BookingCode` varchar(200) NOT NULL,
  `Origen` varchar(200) NOT NULL,
  `TRF` varchar(200) NOT NULL,
  `ParadasPasajeros` varchar(200) NOT NULL,
  `Status` varchar(200) NOT NULL,
  `Fecha` varchar(200) NOT NULL,
  `Hora` varchar(200) NOT NULL,
  `UrbanoIntermunicipal` varchar(200) NOT NULL,
  `Tipo` varchar(200) NOT NULL,
  `Servicio` varchar(200) NOT NULL,
  `Sentido` varchar(200) NOT NULL,
  `Vehiculo` varchar(200) NOT NULL,
  `Conductorstatus` varchar(200) NOT NULL,
  `APuntopartida` varchar(600) NOT NULL,
  `Ciudadpartida` varchar(300) NOT NULL,
  `Paispartida` varchar(200) NOT NULL,
  `BPuntodestino` varchar(600) NOT NULL,
  `Ciudaddestino` varchar(200) NOT NULL,
  `Vuelo` varchar(200) NOT NULL,
  `Observacionesubicacion` varchar(300) NOT NULL,
  `Observacionesclienterecogida` varchar(300) NOT NULL,
  `Observaciones` varchar(600) NOT NULL,
  `Operario` varchar(300) NOT NULL,
  `Formadepago` varchar(300) NOT NULL,
  `Flota` varchar(300) NOT NULL,
  `UsuarioAPPNombre` varchar(300) NOT NULL,
  `UsuarioAPPtelefonomovil` varchar(300) NOT NULL,
  `UsuarioAPPusuario` varchar(200) NOT NULL,
  `UsuarioAPPemail` varchar(200) NOT NULL,
  `Empresaafacturar` varchar(200) NOT NULL,
  `Sedeafacturar` varchar(200) NOT NULL,
  `Conductornombre` varchar(300) NOT NULL,
  `Conductorusuario` varchar(400) NOT NULL,
  `Placa` varchar(200) NOT NULL,
  `Marca` varchar(200) NOT NULL,
  `ESTValortotal` varchar(300) NOT NULL,
  `ESTValortransferz` varchar(400) NOT NULL,
  `ESTValortotaltiempo` varchar(400) NOT NULL,
  `ESTValortotaldistancia` varchar(200) NOT NULL,
  `ESTTiempototalmins` varchar(200) NOT NULL,
  `ESTDistanciatotalmtrs` varchar(200) NOT NULL,
  `ValorFinalServicio` varchar(200) NOT NULL,
  `FormaCobroFinalAutomatico` varchar(200) NOT NULL,
  `Moneda` varchar(200) NOT NULL,
  `Tipotarifa` varchar(200) NOT NULL,
  `DescuentoAplicado` varchar(200) NOT NULL,
  `Valortarifaminima` varchar(200) NOT NULL,
  `Valorunidadtiempo` varchar(200) NOT NULL,
  `Valorunidaddistancia` varchar(300) NOT NULL,
  `ValortotaltiempoFINAL` varchar(300) NOT NULL,
  `ValortotaldistanciaFINAL` varchar(300) NOT NULL,
  `Metroscobrorecargo` varchar(300) NOT NULL,
  `Aplicarecargo` varchar(200) NOT NULL,
  `Valorespera` varchar(200) NOT NULL,
  `Impuestoporcentaje` varchar(300) NOT NULL,
  `ImpuestovalorfinalIVA` varchar(300) NOT NULL,
  `empresaganacia` varchar(300) NOT NULL,
  `conductorganancia` varchar(300) NOT NULL,
  `Utilidadconductor` varchar(300) NOT NULL,
  `Utilidadempresa` varchar(320) NOT NULL,
  `Usuarioliquidacion` varchar(300) NOT NULL,
  `Fechaliquidacion` varchar(300) NOT NULL,
  `Observacionesliquidacion` varchar(300) NOT NULL,
  `Fechaservicio` varchar(300) NOT NULL,
  `Fechaaceptaserviciodriver` varchar(300) NOT NULL,
  `Horallegadaorigendriver` varchar(300) NOT NULL,
  `Horaabordaje` varchar(300) NOT NULL,
  `Horafinalizaserviciodriver` varchar(300) NOT NULL,
  `Fechafinalizadriverviaje` varchar(300) NOT NULL,
  `Tiempodeesperaorigenmins` varchar(300) NOT NULL,
  `TiempototalfinalabordofinalizaMins` varchar(300) NOT NULL,
  `TiempototaldelviajeaceptafinalizaMins` varchar(200) NOT NULL,
  `Distanciatotalfinalmtrs` varchar(200) NOT NULL,
  `Calificacioncliente` varchar(300) NOT NULL,
  `Comentarioscalificacioncliente` varchar(300) NOT NULL,
  `Calificacionconductor` varchar(300) NOT NULL,
  `Comentarioscalificacionconductor` varchar(300) NOT NULL,
  `Canceladopor` varchar(200) NOT NULL,
  `Usuariocancela` varchar(300) NOT NULL,
  `Canceladofecha` varchar(300) NOT NULL,
  `Canceladomotivo` varchar(300) NOT NULL,
  `Canceladonotas` varchar(300) NOT NULL,
  `ObservacionCanceladoconductor` varchar(300) NOT NULL,
  `ObservacionCanceladoadminOP` varchar(300) NOT NULL,
  `Paradasadicionalestotales` varchar(300) NOT NULL,
  `Paradasadicionalesvalorunitario` varchar(300) NOT NULL,
  `Paradasadicionalesvalortotal` varchar(300) NOT NULL,
  `Firmarecibido` varchar(300) NOT NULL,
  `RechazadoporconductoresIDS` varchar(300) NOT NULL,
  `IDgruposervicios` varchar(300) NOT NULL,
  `Numeroexpediente` varchar(300) NOT NULL,
  `DocumentoAdjunto` varchar(300) NOT NULL,
  `DocumentoAdjuntofirmado` varchar(300) NOT NULL,
  `Centrodecosto` varchar(300) NOT NULL,
  `Latitudactualdriver` varchar(300) NOT NULL,
  `Longitudactualdriver` varchar(300) NOT NULL,
  `estadocargue` varchar(100) NOT NULL,
  `valorpesos` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `llave` int(11) NOT NULL,
  `Mes` varchar(200) NOT NULL,
  `ID` varchar(200) NOT NULL,
  `Paisorigen` varchar(200) NOT NULL,
  `BookingCode` varchar(200) NOT NULL,
  `Origen` varchar(200) NOT NULL,
  `TRF` varchar(200) NOT NULL,
  `ParadasPasajeros` varchar(200) NOT NULL,
  `Status` varchar(200) NOT NULL,
  `Fecha` varchar(200) NOT NULL,
  `Hora` varchar(200) NOT NULL,
  `UrbanoIntermunicipal` varchar(200) NOT NULL,
  `Tipo` varchar(200) NOT NULL,
  `Servicio` varchar(200) NOT NULL,
  `Sentido` varchar(200) NOT NULL,
  `Vehiculo` varchar(200) NOT NULL,
  `Conductorstatus` varchar(200) NOT NULL,
  `APuntopartida` varchar(600) NOT NULL,
  `Ciudadpartida` varchar(300) NOT NULL,
  `Paispartida` varchar(200) NOT NULL,
  `BPuntodestino` varchar(600) NOT NULL,
  `Ciudaddestino` varchar(200) NOT NULL,
  `Vuelo` varchar(200) NOT NULL,
  `Observacionesubicacion` varchar(300) NOT NULL,
  `Observacionesclienterecogida` varchar(300) NOT NULL,
  `Observaciones` varchar(600) NOT NULL,
  `Operario` varchar(300) NOT NULL,
  `Formadepago` varchar(300) NOT NULL,
  `Flota` varchar(300) NOT NULL,
  `UsuarioAPPNombre` varchar(300) NOT NULL,
  `UsuarioAPPtelefonomovil` varchar(300) NOT NULL,
  `UsuarioAPPusuario` varchar(200) NOT NULL,
  `UsuarioAPPemail` varchar(200) NOT NULL,
  `Empresaafacturar` varchar(200) NOT NULL,
  `Sedeafacturar` varchar(200) NOT NULL,
  `Conductornombre` varchar(300) NOT NULL,
  `Conductorusuario` varchar(400) NOT NULL,
  `Placa` varchar(200) NOT NULL,
  `Marca` varchar(200) NOT NULL,
  `ESTValortotal` varchar(300) NOT NULL,
  `ESTValortransferz` varchar(400) NOT NULL,
  `ESTValortotaltiempo` varchar(400) NOT NULL,
  `ESTValortotaldistancia` varchar(200) NOT NULL,
  `ESTTiempototalmins` varchar(200) NOT NULL,
  `ESTDistanciatotalmtrs` varchar(200) NOT NULL,
  `ValorFinalServicio` varchar(200) NOT NULL,
  `FormaCobroFinalAutomatico` varchar(200) NOT NULL,
  `Moneda` varchar(200) NOT NULL,
  `Tipotarifa` varchar(200) NOT NULL,
  `DescuentoAplicado` varchar(200) NOT NULL,
  `Valortarifaminima` varchar(200) NOT NULL,
  `Valorunidadtiempo` varchar(200) NOT NULL,
  `Valorunidaddistancia` varchar(300) NOT NULL,
  `ValortotaltiempoFINAL` varchar(300) NOT NULL,
  `ValortotaldistanciaFINAL` varchar(300) NOT NULL,
  `Metroscobrorecargo` varchar(300) NOT NULL,
  `Aplicarecargo` varchar(200) NOT NULL,
  `Valorespera` varchar(200) NOT NULL,
  `Impuestoporcentaje` varchar(300) NOT NULL,
  `ImpuestovalorfinalIVA` varchar(300) NOT NULL,
  `empresaganacia` varchar(300) NOT NULL,
  `conductorganancia` varchar(300) NOT NULL,
  `Utilidadconductor` varchar(300) NOT NULL,
  `Utilidadempresa` varchar(320) NOT NULL,
  `Usuarioliquidacion` varchar(300) NOT NULL,
  `Fechaliquidacion` varchar(300) NOT NULL,
  `Observacionesliquidacion` varchar(300) NOT NULL,
  `Fechaservicio` varchar(300) NOT NULL,
  `Fechaaceptaserviciodriver` varchar(300) NOT NULL,
  `Horallegadaorigendriver` varchar(300) NOT NULL,
  `Horaabordaje` varchar(300) NOT NULL,
  `Horafinalizaserviciodriver` varchar(300) NOT NULL,
  `Fechafinalizadriverviaje` varchar(300) NOT NULL,
  `Tiempodeesperaorigenmins` varchar(300) NOT NULL,
  `TiempototalfinalabordofinalizaMins` varchar(300) NOT NULL,
  `TiempototaldelviajeaceptafinalizaMins` varchar(200) NOT NULL,
  `Distanciatotalfinalmtrs` varchar(200) NOT NULL,
  `Calificacioncliente` varchar(300) NOT NULL,
  `Comentarioscalificacioncliente` varchar(300) NOT NULL,
  `Calificacionconductor` varchar(300) NOT NULL,
  `Comentarioscalificacionconductor` varchar(300) NOT NULL,
  `Canceladopor` varchar(200) NOT NULL,
  `Usuariocancela` varchar(300) NOT NULL,
  `Canceladofecha` varchar(300) NOT NULL,
  `Canceladomotivo` varchar(300) NOT NULL,
  `Canceladonotas` varchar(300) NOT NULL,
  `ObservacionCanceladoconductor` varchar(300) NOT NULL,
  `ObservacionCanceladoadminOP` varchar(300) NOT NULL,
  `Paradasadicionalestotales` varchar(300) NOT NULL,
  `Paradasadicionalesvalorunitario` varchar(300) NOT NULL,
  `Paradasadicionalesvalortotal` varchar(300) NOT NULL,
  `Firmarecibido` varchar(300) NOT NULL,
  `RechazadoporconductoresIDS` varchar(300) NOT NULL,
  `IDgruposervicios` varchar(300) NOT NULL,
  `Numeroexpediente` varchar(300) NOT NULL,
  `DocumentoAdjunto` varchar(300) NOT NULL,
  `DocumentoAdjuntofirmado` varchar(300) NOT NULL,
  `Centrodecosto` varchar(300) NOT NULL,
  `Latitudactualdriver` varchar(300) NOT NULL,
  `Longitudactualdriver` varchar(300) NOT NULL,
  `estadocargue` varchar(100) NOT NULL,
  `valorpesos` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `nombres` varchar(100) NOT NULL,
  `tipodocumento` varchar(100) NOT NULL,
  `documento` varchar(100) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `convenio` varchar(200) NOT NULL,
  `sintomas` varchar(100) NOT NULL,
  `contacto` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `correo`, `password`, `created_at`, `nombres`, `tipodocumento`, `documento`, `telefono`, `direccion`, `convenio`, `sintomas`, `contacto`) VALUES
(41, 'HCYTRAVEL@HCYTRAVEL.com', '$2y$10$VpeP3UP.WFQk7gBpKiCW3.PyHXOeIdWvYHKeIqqKxjcQAik1ruRmq', '2020-10-23 08:44:41', 'alex nino', 'CC', '80114616', '311449965', 'carrera 125 85 32', 'Paciente Particular', 'administrador', ''),
(74, 'agente.cirec@cirec.org', '$2y$10$VpeP3UP.WFQk7gBpKiCW3.PyHXOeIdWvYHKeIqqKxjcQAik1ruRmq', '2020-10-23 08:44:41', 'alex nino', 'CC', '80114616', '311449965', 'carrera 125 85 32', 'Paciente Particular', 'admisiones', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `app_cargue`
--
ALTER TABLE `app_cargue`
  ADD PRIMARY KEY (`llave`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`llave`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `app_cargue`
--
ALTER TABLE `app_cargue`
  MODIFY `llave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3068;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `llave` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2422;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
