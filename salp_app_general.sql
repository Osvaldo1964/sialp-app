-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 24-02-2024 a las 16:25:13
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `salp_app_general`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actas`
--

CREATE TABLE `actas` (
  `idActa` bigint NOT NULL,
  `tipActa` bigint NOT NULL,
  `iteActa` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `numActa` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `fecActa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recActa` bigint NOT NULL,
  `valActa` float(15,2) NOT NULL,
  `estActa` int DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `actas`
--

INSERT INTO `actas` (`idActa`, `tipActa`, `iteActa`, `numActa`, `fecActa`, `recActa`, `valActa`, `estActa`) VALUES
(1, 2, '1', '001030', '2024-02-24 05:00:00', 1, 25000000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulos`
--

CREATE TABLE `capitulos` (
  `idCapitulo` bigint NOT NULL,
  `nomCapitulo` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `tipCapitulo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `capitulos`
--

INSERT INTO `capitulos` (`idCapitulo`, `nomCapitulo`, `tipCapitulo`) VALUES
(1, 'Ingresos', 1),
(2, 'Costos y Gastos', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `idContacto` bigint NOT NULL,
  `nomContacto` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `emaContacto` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `msgContacto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `ipdContacto` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `disContacto` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `ageContacto` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `creContacto` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`idContacto`, `nomContacto`, `emaContacto`, `msgContacto`, `ipdContacto`, `disContacto`, `ageContacto`, `creContacto`) VALUES
(1, 'Fernando Herrera', 'toolsfordeveloper@gmail.com', 'Mensaje del primer suscriptor!', '127.0.0.1', 'PC', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:91.0) Gecko/20100101 Firefox/91.0', '2021-08-20 04:06:18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costoconsumo`
--

CREATE TABLE `costoconsumo` (
  `idCosto` bigint NOT NULL,
  `perCosto` int NOT NULL,
  `csmCosto` float(15,2) NOT NULL,
  `vlrCosto` float(15,2) NOT NULL,
  `totCosto` float(15,2) NOT NULL,
  `estCosto` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `costoconsumo`
--

INSERT INTO `costoconsumo` (`idCosto`, `perCosto`, `csmCosto`, `vlrCosto`, `totCosto`, `estCosto`) VALUES
(1, 202403, 3000.00, 200.00, 7000.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalleacta`
--

CREATE TABLE `detalleacta` (
  `idDetalle` bigint NOT NULL,
  `actDetalle` bigint NOT NULL,
  `eleDetalle` bigint NOT NULL,
  `fecDetalle` date NOT NULL,
  `vlrDetalle` float(15,2) NOT NULL,
  `estDetalle` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docuactas`
--

CREATE TABLE `docuactas` (
  `idImagen` bigint NOT NULL,
  `actImagen` bigint NOT NULL,
  `nomImagen` varchar(100) COLLATE utf8mb3_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `docuactas`
--

INSERT INTO `docuactas` (`idImagen`, `actImagen`, `nomImagen`) VALUES
(2, 1, 'pro_29fa3d8ca95f9461574d55375a04b54a.pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos`
--

CREATE TABLE `elementos` (
  `idElemento` bigint NOT NULL,
  `gruElemento` bigint NOT NULL,
  `iteElemento` bigint NOT NULL,
  `codElemento` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `recElemento` bigint NOT NULL,
  `usoElemento` bigint NOT NULL,
  `desElemento` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `dirElemento` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `latElemento` float(15,2) NOT NULL,
  `lonElemento` float(15,2) NOT NULL,
  `rutElemento` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `ainElemento` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `finElemento` date DEFAULT NULL,
  `abaElemento` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fbaElemento` date DEFAULT NULL,
  `estElemento` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `elementos`
--

INSERT INTO `elementos` (`idElemento`, `gruElemento`, `iteElemento`, `codElemento`, `recElemento`, `usoElemento`, `desElemento`, `dirElemento`, `latElemento`, `lonElemento`, `rutElemento`, `ainElemento`, `finElemento`, `abaElemento`, `fbaElemento`, `estElemento`) VALUES
(8, 1, 1, 'LED01002', 2, 3, '', 'Calle prueba', 15.20, 16.22, 'led01001', '001-2022', '2022-01-20', NULL, NULL, 1),
(9, 1, 1, 'LED01001', 2, 3, '<p>EL DIA 2020-02-25 SE LE CAMBIO EL FILAMENTO</p> <p>EL DIA 2020-2523SD SE LAVO</p> <ol> <li>se inauguro</li> <li>se lavo</li> <li>se voto</li> </ol>', 'Calle prueba', 15.20, 16.22, 'led01001', '001-2022', '2022-01-20', '009-1520', '2022-02-15', 1),
(10, 2, 1, 'LED902929', 3, 1, '<p>ESTA DSKSKDSD LSD SDLFS</p> <p>DSLDLDSAF&Ntilde;DSF</p> <p>DKDALKD</p>', 'CARRERA LARTLR', 15.20, 16.22, 'led902929', 'KWEWELLWE', '2022-01-20', NULL, NULL, 1),
(11, 2, 1, 'LED902929', 3, 1, '<p>ESTA DSKSKDSD LSD SDLFS</p> <p>DSLDLDSAF&Ntilde;DSF</p> <p>DKDALKD</p>', 'CARRERA LARTLR', 15.20, 16.22, 'led902929', 'KWEWELLWE', '2022-01-20', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estratos`
--

CREATE TABLE `estratos` (
  `idEstrato` bigint NOT NULL,
  `desEstrato` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `estEstrato` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `estratos`
--

INSERT INTO `estratos` (`idEstrato`, `desEstrato`, `estEstrato`) VALUES
(1, 'COMERCIALES NIVEL I', 1),
(2, 'COMERCIALES NIVEL II', 1),
(3, 'COMERCIALES NIVEL III', 1),
(4, 'RESIDENCIAL ESTRATO 1', 1),
(5, 'RESIDENCIAL ESTRATO 2', 1),
(6, 'RESIDENCIAL ESTRATO 3', 1),
(7, 'RESIDENCIAL ESTRATO 4', 1),
(8, 'RESIDENCIAL ESTRATO 5', 1),
(9, 'RESIDENCIAL ESTRATO 6', 1),
(10, 'INDUSTRIAL I', 1),
(11, 'INDUSTRIAL II', 1),
(12, 'INDUSTRIAL III', 1),
(13, 'OFICIAL I', 1),
(14, 'OFICIAL II', 1),
(15, 'INDETERMINADO', 1),
(16, 'NO REGULADOS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

CREATE TABLE `facturacion` (
  `idFactura` bigint NOT NULL,
  `perFactura` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `relFactura` bigint NOT NULL,
  `canFactura` int NOT NULL,
  `facFactura` float(15,2) NOT NULL,
  `recFactura` float(15,2) NOT NULL,
  `estFactura` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `facturacion`
--

INSERT INTO `facturacion` (`idFactura`, `perFactura`, `relFactura`, `canFactura`, `facFactura`, `recFactura`, `estFactura`) VALUES
(1, '202401', 2, 1500, 5000.00, 4500.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idGrupo` bigint NOT NULL,
  `capGrupo` bigint NOT NULL,
  `desGrupo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `creGrupo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estGrupo` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`idGrupo`, `capGrupo`, `desGrupo`, `creGrupo`, `estGrupo`) VALUES
(1, 1, 'Recaudo Impuesto Alumbrado Público', '2024-02-13 07:27:25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gruposalp`
--

CREATE TABLE `gruposalp` (
  `idGruposalp` bigint NOT NULL,
  `codGruposalp` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `desGruposalp` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `vidGruposalp` float(6,2) NOT NULL,
  `tipGruposalp` bigint NOT NULL,
  `estGruposalp` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `gruposalp`
--

INSERT INTO `gruposalp` (`idGruposalp`, `codGruposalp`, `desGruposalp`, `vidGruposalp`, `tipGruposalp`, `estGruposalp`) VALUES
(1, '01', 'Bombillas de Sodio', 3.50, 2, 1),
(2, '02', 'Luminarias LED', 10.00, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `idImagen` bigint NOT NULL,
  `idElemento` bigint NOT NULL,
  `nomImagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`idImagen`, `idElemento`, `nomImagen`) VALUES
(1, 1, 'pro_fc7d732eb2acba1328d11dbb2fc42739.jpg'),
(2, 11, 'pro_989c4abcee9f94324809987176032347.jpg'),
(3, 11, 'pro_7404c582081c5ebb7268c400c56ceeed.jpg'),
(4, 9, 'pro_118e53fde66f0610b0bb1f22e6c4e165.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemsacta`
--

CREATE TABLE `itemsacta` (
  `idItemacta` bigint NOT NULL,
  `codItemacta` varchar(10) NOT NULL,
  `desItemacta` varchar(60) NOT NULL,
  `tipItemacta` bigint NOT NULL,
  `estItemacta` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `itemsacta`
--

INSERT INTO `itemsacta` (`idItemacta`, `codItemacta`, `desItemacta`, `tipItemacta`, `estItemacta`) VALUES
(1, '01', 'EXPANSION', 2, 1),
(2, '02', 'MODERNIZACION', 2, 1),
(3, '03', 'REPOSICION', 2, 1),
(4, '04', 'HURTO', 4, 1),
(5, '05', 'DAÑO', 4, 1),
(6, '06', 'OBSOLESCENCIA  ', 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itemsalp`
--

CREATE TABLE `itemsalp` (
  `idItem` bigint NOT NULL,
  `gruItem` bigint NOT NULL,
  `desItem` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `csmItem` int NOT NULL,
  `estItem` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `itemsalp`
--

INSERT INTO `itemsalp` (`idItem`, `gruItem`, `desItem`, `csmItem`, `estItem`) VALUES
(1, 1, '40w', 30, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `idModulo` bigint NOT NULL,
  `titModulo` varchar(50) NOT NULL,
  `desModulo` text NOT NULL,
  `estModulo` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`idModulo`, `titModulo`, `desModulo`, `estModulo`) VALUES
(1, 'Dashboard', 'Página principal de la App', 1),
(2, 'Configuración', '- C.R.U.D. Usuarios\r\n- C.R.U.D. Permisos\r\n- Parámetros Generales', 1),
(3, 'Estructura', '- C.R.U.D. Capitulos\r\n- C.R.U.D. Grupos\r\n- C.R.U.D. Subgrupos\r\n- C.R.U.D. Rubros\r\n- C.R.U.D. Auxiliares', 1),
(4, 'Componentes', '- C.R.U.D. Variables SALP\r\n- C.R.U.D. Grupos\r\n- C.R.U.D. UCAPs\r\n- C.R.U.D. Tipos de Actas', 1),
(5, 'Movimientos', '- Registro Modelo Contractual\n- Regristro Ejecución Real\n- Registro de Actas\n- Registro consumo y costos Energía\n- Registro Valores Variables\n- Registro Valores Variables Costos Máximos\n- Registro Porcentajes Tasas de Retorno', 1),
(6, 'Gestion Documental', 'Registro Documentos', 1),
(16, 'Informes', 'Informes de Cartera', 1),
(17, 'Suscriptores', 'Registro Suscriptores', 1),
(18, 'Contactos', 'Registro de Contactos', 1),
(19, 'Páginas', 'Páginas del Sitio WEB', 1),
(20, 'Pqrs', 'Control y Seguimiento PQRs', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parametros`
--

CREATE TABLE `parametros` (
  `idParam` int NOT NULL,
  `depParam` varchar(15) DEFAULT NULL,
  `munParam` varchar(20) DEFAULT NULL,
  `empParam` varchar(200) NOT NULL,
  `dirParam` varchar(200) NOT NULL,
  `nitParam` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `parametros`
--

INSERT INTO `parametros` (`idParam`, `depParam`, `munParam`, `empParam`, `dirParam`, `nitParam`) VALUES
(1, 'Magdalena', 'Plato', 'Icaruscol S.A.S.', 'Carrera 6 No. 11-07 ', '900.900.900-1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idPermiso` bigint NOT NULL,
  `idRol` bigint NOT NULL,
  `idModulo` bigint NOT NULL,
  `reaPermiso` int NOT NULL,
  `wriPermiso` int NOT NULL,
  `updPermiso` int NOT NULL,
  `delPermiso` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idPermiso`, `idRol`, `idModulo`, `reaPermiso`, `wriPermiso`, `updPermiso`, `delPermiso`) VALUES
(44, 2, 1, 0, 1, 0, 0),
(45, 2, 2, 1, 0, 0, 0),
(46, 2, 3, 0, 1, 0, 0),
(47, 2, 4, 0, 0, 1, 0),
(48, 2, 5, 0, 1, 0, 0),
(49, 2, 6, 1, 0, 0, 1),
(162, 3, 1, 1, 0, 1, 1),
(163, 3, 2, 1, 1, 0, 1),
(164, 3, 3, 1, 1, 0, 0),
(165, 3, 4, 1, 0, 0, 0),
(166, 3, 5, 1, 1, 1, 1),
(167, 3, 6, 0, 0, 0, 0),
(168, 3, 7, 0, 0, 0, 0),
(169, 3, 8, 1, 1, 1, 1),
(434, 5, 1, 1, 0, 0, 0),
(435, 5, 2, 1, 1, 0, 0),
(436, 5, 3, 0, 0, 0, 0),
(437, 5, 4, 0, 0, 0, 0),
(438, 5, 5, 0, 0, 0, 0),
(439, 5, 6, 0, 0, 0, 0),
(440, 5, 7, 0, 0, 0, 0),
(441, 5, 8, 0, 0, 0, 0),
(442, 5, 9, 1, 0, 0, 0),
(443, 5, 10, 0, 0, 0, 0),
(444, 5, 11, 0, 0, 0, 0),
(445, 5, 12, 0, 0, 0, 0),
(446, 5, 13, 0, 0, 0, 0),
(447, 5, 14, 0, 0, 0, 0),
(448, 5, 15, 0, 0, 0, 0),
(449, 5, 16, 0, 0, 0, 0),
(450, 5, 17, 0, 0, 0, 0),
(451, 5, 18, 0, 0, 0, 0),
(452, 5, 19, 1, 0, 0, 0),
(453, 1, 1, 1, 1, 1, 1),
(454, 1, 2, 1, 1, 1, 1),
(455, 1, 3, 1, 1, 1, 1),
(456, 1, 4, 1, 1, 1, 1),
(457, 1, 5, 1, 1, 1, 1),
(458, 1, 6, 1, 1, 1, 1),
(459, 1, 16, 1, 1, 1, 1),
(460, 1, 17, 1, 1, 1, 1),
(461, 1, 18, 1, 1, 1, 1),
(462, 1, 19, 1, 1, 1, 1),
(463, 1, 20, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `idpost` bigint NOT NULL,
  `titulo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `contenido` text CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `portada` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `datecreate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ruta` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`idpost`, `titulo`, `contenido`, `portada`, `datecreate`, `ruta`, `status`) VALUES
(1, 'Inicio', '<div class=\"p-t-80\"> <h3 class=\"ltext-103 cl5\">Nuestras marcas</h3> </div> <div> <p>Trabajamos con las mejores marcas del mundo ...</p> </div> <div class=\"row\"> <div class=\"col-md-3\"><img src=\"Assets/images/m1.png\" alt=\"Marca 1\" width=\"110\" height=\"110\" /></div> <div class=\"col-md-3\"><img src=\"Assets/images/m2.png\" alt=\"Marca 2\" /></div> <div class=\"col-md-3\"><img src=\"Assets/images/m3.png\" alt=\"Marca 3\" /></div> <div class=\"col-md-3\"><img src=\"Assets/images/m4.png\" alt=\"Marca 4\" /></div> </div>', '', '2021-07-20 02:40:15', 'inicio', 1),
(2, 'Tienda', '<p>Contenido p&aacute;gina!</p>', '', '2021-08-06 01:21:27', 'tienda', 1),
(3, 'Carrito', '<p>Contenido p&aacute;gina!</p>', '', '2021-08-06 01:21:52', 'carrito', 1),
(4, 'Nosotros TRES', '<section class=\"bg0 p-t-75 p-b-120\"> <div class=\"container\"> <div class=\"row p-b-148\"> <div class=\"col-md-7 col-lg-8\"> <div class=\"p-t-7 p-r-85 p-r-15-lg p-r-0-md\"> <h3 class=\"mtext-111 cl2 p-b-16\">Historia</h3> <p class=\"stext-113 cl6 p-b-26\">Esto es uhna priume lsallsdlsdl sit amet, consectetur adipiscing elit. Mauris consequat consequat enim, non auctor massa ultrices non. Morbi sed odio massa. Quisque at vehicula tellus, sed tincidunt augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas varius egestas diam, eu sodales metus scelerisque congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas gravida justo eu arcu egestas convallis. Nullam eu erat bibendum, tempus ipsum eget, dictum enim. Donec non neque ut enim dapibus tincidunt vitae nec augue. Suspendisse potenti. Proin ut est diam. Donec condimentum euismod tortor, eget facilisis diam faucibus et. Morbi a tempor elit.</p> <p class=\"stext-113 cl6 p-b-26\">Donec gravida lorem elit, quis condimentum ex semper sit amet. Fusce eget ligula magna. Aliquam aliquam imperdiet sodales. Ut fringilla turpis in vehicula vehicula. Pellentesque congue ac orci ut gravida. Aliquam erat volutpat. Donec iaculis lectus a arcu facilisis, eu sodales lectus sagittis. Etiam pellentesque, magna vel dictum rutrum, neque justo eleifend elit, vel tincidunt erat arcu ut sem. Sed rutrum, turpis ut commodo efficitur, quam velit convallis ipsum, et maximus enim ligula ac ligula. PRUEBA 1</p> <p class=\"stext-113 cl6 p-b-26\">Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879</p> </div> </div> <div class=\"col-11 col-md-5 col-lg-4 m-lr-auto\"> <div class=\"how-bor1 \"> <div class=\"hov-img0\"><img src=\"https://cdn.pixabay.com/photo/2015/07/17/22/43/student-849825_1280.jpg\" alt=\"IMG\" width=\"500\" height=\"333\"></div> </div> </div> </div> <div class=\"row\"> <div class=\"order-md-2 col-md-7 col-lg-8 p-b-30\"> <div class=\"p-t-7 p-l-85 p-l-15-lg p-l-0-md\"> <h2 class=\"mtext-111 cl2 p-b-16\"><span style=\"color: #236fa1;\">Nuestra Misi&oacute;n</span></h2> <p class=\"stext-113 cl6 p-b-26\">Mauris non lacinia magna. Sed nec lobortis dolor. Vestibulum rhoncus dignissim risus, sed consectetur erat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam maximus mauris sit amet odio convallis, in pharetra magna gravida. Praesent sed nunc fermentum mi molestie tempor. Morbi vitae viverra odio. Pellentesque ac velit egestas, luctus arcu non, laoreet mauris. Sed in ipsum tempor, consequat odio in, porttitor ante. Ut mauris ligula, volutpat in sodales in, porta non odio. Pellentesque tempor urna vitae mi vestibulum, nec venenatis nulla lobortis. Proin at gravida ante. Mauris auctor purus at lacus maximus euismod. Pellentesque vulputate massa ut nisl hendrerit, eget elementum libero iaculis.</p> <div class=\"bor16 p-l-29 p-b-9 m-t-22\"> <p class=\"stext-114 cl6 p-r-40 p-b-11\">Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn\'t really do it, they just saw something. It seemed obvious to them after a while. PRUEBA DOS</p> <span class=\"stext-111 cl8\"> - Steve Job&rsquo;s </span></div> </div> </div> <div class=\"order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30\"> <div class=\"how-bor2\"> <div class=\"hov-img0\"><img src=\"https://cdn.pixabay.com/photo/2015/07/17/22/43/student-849822_1280.jpg\" alt=\"IMG\" width=\"500\" height=\"333\"></div> </div> </div> </div> </div> </section>', 'img_b51b41c3cc71af6f5f41ca6a91fca133.jpg', '2021-08-09 03:09:44', 'nosotros', 2),
(5, 'Contacto', '<div class=\"map\"><iframe style=\"border: 0;\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.685802352331!2d-90.73646108521129!3d14.559951589828378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85890e74b3771e19%3A0x68ec9eeea79fd9a7!2sEl%20Arco%20de%20Santa%20Catalina!5e0!3m2!1ses!2sgt!4v1624005005655!5m2!1ses!2sgt\" width=\"100%\" height=\"600\" allowfullscreen=\"allowfullscreen\" loading=\"lazy\"></iframe></div>', 'img_8cef719a778ce34d337d9f7a8cbd420f.jpg', '2021-08-09 03:11:08', 'contacto', 1),
(6, 'Preguntas frecuentes', '<ol> <li><strong>&iquest;Cu&aacute;l es el tiempo de entrega de los producto? </strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt! Quae doloribus deserunt qui fugit illo nobis ipsum, accusamus eius perferendis beatae culpa molestias!</li> <li><strong>&iquest;C&oacute;mo es la forma de env&iacute;o de los productos?</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur.</li> <li><strong>&iquest;Cu&aacute;l es el tiempo m&aacute;ximo para solicitar un reembolso?</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt!</li> </ol> <p>&nbsp;</p> <p>Otras preguntas</p> <ul> <li><strong>&iquest;Qu&eacute; formas de pago aceptan? </strong><span style=\"color: #666666; font-family: Arial, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">Corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt! Quae doloribus deserunt qui fugit illo nobis ipsum, accusamus eius perferendis beatae culpa molestias!</span></li> </ul>', '', '2021-08-11 01:24:19', 'preguntas-frecuentes', 1),
(7, 'Términos y Condiciones', '<p>A continuaci&oacute;n se describen los t&eacute;rmino y condiciones de la Tienda Virtual!</p> <ol> <li>Pol&iacute;tica uno</li> <li>Termino dos</li> <li>Condici&oacute;n tres</li> </ol> <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt! Quae doloribus deserunt qui fugit illo nobis ipsum, accusamus eius perferendis beatae culpa molestias!</p>', '', '2021-08-11 01:51:06', 'terminos-y-condiciones', 1),
(8, 'Sucursales', '<section class=\"py-5 text-center\"> <div class=\"container\"> <p>Visitanos y obten los mejores precios del mercado, cualquier art&iacute;culo que necestas para vivir mejor</p> <a class=\"btn btn-info\" href=\"../../cmrpos/tienda\">VER PRODUCTOS</a></div> </section> <div class=\"py-5 bg-light\"> <div class=\"container\"> <div class=\"row\"> <div class=\"col-md-4\"> <div class=\"card mb-4 box-shadow hov-img0\"><img src=\"https://abelosh.com/tienda_virtual/Assets/images/s1.jpg\" alt=\"Tienda Uno\" width=\"100%\" height=\"100%\"> <div class=\"card-body\"> <p class=\"card-text\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p> <p>Direcci&oacute;n: Antigua Gautemala <br>Tel&eacute;fono: 4654645 <br>Correo: info@abelosh.com</p> </div> </div> </div> <div class=\"col-md-4\"> <div class=\"card mb-4 box-shadow hov-img0\"><img src=\"https://abelosh.com/tienda_virtual/Assets/images/s2.jpg\" alt=\"Sucural dos\" width=\"100%\" height=\"100%\"> <div class=\"card-body\"> <p class=\"card-text\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p> <p>Direcci&oacute;n: Antigua Gautemala <br>Tel&eacute;fono: 4654645 <br>Correo: info@abelosh.com</p> </div> </div> </div> <div class=\"col-md-4\"> <div class=\"card mb-4 box-shadow hov-img0\"><img src=\"https://abelosh.com/tienda_virtual/Assets/images/s3.jpg\" alt=\"Sucural tres\" width=\"100%\" height=\"100%\"> <div class=\"card-body\"> <p class=\"card-text\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p> <p>Direcci&oacute;n: Antigua Gautemala <br>Tel&eacute;fono: 4654645 <br>Correo: info@abelosh.com</p> </div> </div> </div> </div> </div> </div>', 'img_d72cb5712933863e051dc9c7fac5e253.jpg', '2021-08-11 02:26:45', 'sucursales', 1),
(9, 'Not Found', '<h1>Error 404: P&aacute;gina no encontrada</h1> <p>No se encuentra la p&aacute;gina que ha solicitado.</p>', '', '2021-08-12 02:30:49', 'not-found', 1),
(10, 'Pqrs', '<p>AQUI PONGA LAS PQR</p>', 'img_4f32ea689c4111d7f185a7bd549e7d3a.jpg', '2024-02-11 18:33:06', 'pqrs', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pqrs`
--

CREATE TABLE `pqrs` (
  `idPqrs` bigint NOT NULL,
  `nomPqrs` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `emaPqrs` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `dirPqrs` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `msgPqrs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `frePqrs` date DEFAULT NULL,
  `fsoPqrs` date DEFAULT NULL,
  `dsoPqrs` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci,
  `latPqrs` float(15,8) DEFAULT NULL,
  `lonPqrs` float(15,8) DEFAULT NULL,
  `ndiPqrs` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estPqrs` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pqrs`
--

INSERT INTO `pqrs` (`idPqrs`, `nomPqrs`, `emaPqrs`, `dirPqrs`, `msgPqrs`, `frePqrs`, `fsoPqrs`, `dsoPqrs`, `latPqrs`, `lonPqrs`, `ndiPqrs`, `estPqrs`) VALUES
(1, 'Oswaldo', 'osvicor@ghotmail.com', 'carrera 6 calle 11, santa marta colombia', 'fgsdfgsdf', NULL, NULL, '', NULL, NULL, NULL, 1),
(12, 'Oswaldo', 'osvicor@ghotmail.com', 'carrera 11 calle 17, santa marta colombia', 'dfdssd', NULL, NULL, '', NULL, NULL, NULL, 1),
(13, 'Oswaldo', 'osvicor@ghotmail.com', 'carrera 11 calle 17a, santa marta colombia', 'dfdssd', NULL, NULL, '', NULL, NULL, NULL, 1),
(14, 'Oswaldo', 'osvicor@ghotmail.com', 'carrera 11 calle 17, santa marta, colombia', 'sadcvasdasd', NULL, NULL, '', NULL, NULL, NULL, 1),
(15, 'Oswaldo', 'osvicor@ghotmail.com', 'carrera 11 calle 17, santa marta, colombia', 'adsadsfv', NULL, NULL, '', NULL, NULL, NULL, 1),
(40, 'Osvaldo', 'osvicor@hotmail.com', 'carrera 5 15-20, santa marta colombia', 'sdfsdfsdf', NULL, NULL, '', NULL, NULL, NULL, 1),
(41, 'Osvaldo', 'osvicor@hotmail.com', 'carrera 1 calle 15 santa marta colombia', 'sdfsdfsdf', NULL, NULL, '', NULL, NULL, NULL, 1),
(42, 'Osvaldo', 'osvicor@hotmail.com', 'carrera 1 calle 15 santa marta colombia', 'sdfsdfsdf', NULL, NULL, '', NULL, NULL, NULL, 1),
(43, 'Osvaldo', 'osvicor@hotmail.com', 'carrera 11 calle 17, santa marta, colombia', 'fghfghg', NULL, NULL, '', NULL, NULL, NULL, 1),
(44, 'Osvaldo', 'osvicor@hotmail.com', 'calle 11 carrera 5', 'fghfghg', NULL, NULL, '', NULL, NULL, NULL, 1),
(45, 'Osvaldo', 'osvicor@hotmail.com', 'carrera 5 calle 14 santa marta colombia', 'gdfghdfg', NULL, NULL, '', NULL, NULL, NULL, 1),
(46, 'Osvaldo', 'osvicor@hotmail.com', 'carrera 1 calle 22 santa marta, colombia', 'gdfghdfg', '2024-02-05', NULL, '', NULL, NULL, NULL, 1),
(47, 'Osvaldo', 'osvicor@hotmail.com', 'taganga magdalena', 'dfsdsdf', '2024-02-10', '2024-02-18', 'Prueba', NULL, NULL, NULL, 2),
(48, 'Nueva Prueba', 'osvicor@hotmail.com', 'carrera 19 22-10 santa marta colombia', 'asdasdsd', '2024-02-14', '2024-02-19', NULL, 11.23633003, -74.19480896, 'Cra. 19 #22-10, Comuna 4, Santa Marta, Magdalena, Colombia', 1),
(49, 'Nueva Prueba', 'osvicor@hotmail.com', 'carrera 19 22-10 santa marta colombia', 'FFGFGTHFGGH', '2024-02-18', '2024-02-21', 'listo', 11.23633003, -74.19480896, 'Cra. 19 #22-10, Comuna 4, Santa Marta, Magdalena, Colombia', 2),
(50, 'Nueva Prueba', 'osvicor@hotmail.com', 'carrera 19 22-10 santa marta colombia', 'FFGFGTHFGGH', '2024-02-20', NULL, NULL, 11.23633003, -74.19480896, 'Cra. 19 #22-10, Comuna 4, Santa Marta, Magdalena, Colombia', 1),
(51, 'William Gomez', 'wilimdl@correo.com', 'carrera 19 calle 22 santa marta colombia', 'se apago', NULL, NULL, NULL, 11.23639870, -74.19480133, 'Cl. 22 & Cra. 19, Comuna 4, Santa Marta, Magdalena, Colombia', 1),
(52, 'William Gomez', 'wilimdl@correo.com', 'carrera 19 calle 22 santa marta colombia', 'se apago', NULL, '2024-02-24', 'Se cambio', 11.23639870, -74.19480133, 'Cl. 22 & Cra. 19, Comuna 4, Santa Marta, Magdalena, Colombia', 2),
(53, 'Elkin', 'elkin@gogg.com', 'carrera 1 calle 15 santa marta colombia', 'luminaria apagada', NULL, NULL, NULL, 11.24810600, -74.21392059, 'Cra. 1, Santa Marta, Magdalena, Colombia', 1),
(54, 'Elkin', 'elkin@gogg.com', 'carrera 1 calle 15 santa marta colombia', 'luminaria apagada', NULL, '2024-02-25', 'se cambio', 11.24810600, -74.21392059, 'Cra. 1, Santa Marta, Magdalena, Colombia', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `idRecurso` bigint NOT NULL,
  `desRecurso` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `estRecurso` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`idRecurso`, `desRecurso`, `estRecurso`) VALUES
(1, 'INVERSIONISTA', 1),
(2, 'RECURSOS PROPIOS EJECUCION', 1),
(3, 'PARTICULARES', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` bigint NOT NULL,
  `nomRol` varchar(50) NOT NULL,
  `desRol` varchar(120) NOT NULL,
  `estRol` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `nomRol`, `desRol`, `estRol`) VALUES
(1, 'Administradores', 'Administradores del Sistema', 1),
(2, 'Usuarios', 'Control del CRUD de Usuarios', 1),
(3, 'Vendedores', 'Proceso de Ventas', 0),
(4, 'prueba para eliminar3', 'eaerqer', 0),
(5, 'Clientes', 'Clientes del Sistema - Solo tienen acceso al Sistema General de Información', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subgrupos`
--

CREATE TABLE `subgrupos` (
  `idSubgrupo` bigint NOT NULL,
  `gruSubgrupo` bigint NOT NULL,
  `desSubgrupo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `creSubgrupo` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estSubgrupo` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones`
--

CREATE TABLE `suscripciones` (
  `idSuscripcion` bigint NOT NULL,
  `nomSuscripcion` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `emaSuscripcion` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `creSuscripcion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoactas`
--

CREATE TABLE `tipoactas` (
  `idTipoacta` bigint NOT NULL,
  `codTipoacta` varchar(10) NOT NULL,
  `desTipoacta` varchar(120) NOT NULL,
  `selTipoacta` int DEFAULT '0',
  `estTipoacta` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `tipoactas`
--

INSERT INTO `tipoactas` (`idTipoacta`, `codTipoacta`, `desTipoacta`, `selTipoacta`, `estTipoacta`) VALUES
(1, '01', 'INVENTARIO INICIAL', 0, 1),
(2, '02', 'ACTAS DE INVERSION', 1, 1),
(3, '03', 'RECIBO INFRAESTRUCTURA DE TERCEROS   ', 0, 1),
(4, '04', 'BAJA DE INVENTARIO       ', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tiposuso`
--

CREATE TABLE `tiposuso` (
  `idTipouso` bigint NOT NULL,
  `claTipouso` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `desTipouso` varchar(120) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish_ci NOT NULL,
  `estTipouso` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish_ci;

--
-- Volcado de datos para la tabla `tiposuso`
--

INSERT INTO `tiposuso` (`idTipouso`, `claTipouso`, `desTipouso`, `estTipouso`) VALUES
(1, 'M1', 'AUTOPISTAS Y CARRETERAS', 1),
(2, 'M2', 'VIAS DE ACCESO CONTROLADO Y VIAS RAPIDAS', 1),
(3, 'M3', 'VIAS PRINCIPALES Y EJES VIALES', 1),
(4, 'M4', 'VIAS PRIMARIAS O COLECTORAS', 1),
(5, 'M5', 'VIAS SECUNDARIAS', 1),
(6, 'P1', 'VIAS DE MUY ELEVADO PRESTIGIO URBANO', 1),
(7, 'P2', 'UTILIZACION NOCTURNA INTENSA POR PEATONES Y CICLISTAS', 1),
(10, 'P4', 'UTILIZACION NOCTURNA INTENSA POR PEATONES Y CICLISTAS. ASOCIADA A PROPIEDADES ADYACENTES', 1),
(11, 'P5', 'UTILIZACION NOCTURNA INTENSA POR PEATONES Y CICLISTAS. ASOCIADA A PROPIDADES ADYACENTES', 1),
(12, 'P6', 'UTILIZACION NOCTURNA INTENSA POR PEATONES Y CICLISTAS. ASOCIADA A PROPIDADES ADYACENTES', 1),
(13, 'P7', 'VIAS DONDE SOLO SE REQUIERE GUIA VISUAL POR LUZ DIRECTA DE LUMINARIAS', 1),
(14, 'C0', 'CANCHAS MULTIPLES RECREATIVAS', 1),
(15, 'C1', 'PLAZAS Y PLAZOLETAS', 1),
(16, 'C1.1', 'PASOS PEATONALES SUBTERRANEOS', 1),
(17, 'C2', 'PUENTES PEATONALES', 1),
(18, 'C2.1', 'ZONAS PEATONALES BAJAS Y ALEDAÑAS A PUENTES PEATONALES Y VEHICULARES', 1),
(19, 'C3', 'ANDENES, SENDEROS, PASEOS Y ALAMEDAS PEATONALES EN PARQUES', 1),
(20, 'C.2.2', 'CICLO RUTAS EN PARQUES', 1),
(21, 'C4', 'CICLO RUTAS, SENDEROS, PASEOS, ALAMEDAS Y DEMAS AREAS PEATONALES ADYACENTES A RONDAS DE RIOS Y OTROS', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` bigint NOT NULL,
  `tdoUsuario` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `docUsuario` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `nomUsuario` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `apeUsuario` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `dirUsuario` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `telUsuario` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `emaUsuario` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `pasUsuario` varchar(75) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `tokUsuario` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `rolUsuario` bigint NOT NULL,
  `tipUsuario` int NOT NULL,
  `razUsuario` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `actUsuario` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `repUsuario` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `efaUsuario` varchar(160) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `estUsuario` int NOT NULL DEFAULT '1',
  `regUsuario` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `tdoUsuario`, `docUsuario`, `nomUsuario`, `apeUsuario`, `dirUsuario`, `telUsuario`, `emaUsuario`, `pasUsuario`, `tokUsuario`, `rolUsuario`, `tipUsuario`, `razUsuario`, `actUsuario`, `repUsuario`, `efaUsuario`, `estUsuario`, `regUsuario`) VALUES
(1, '2', '73111404', 'Osvaldo Jose', 'Villalobos Cortina', 'UBR SAN LORENZO MZ J CS 34', '3023898254', 'osvicor@hotmail.com', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'c843fdc31a9e01699e60-cceb97b6236fe3cbe753-3874c2094c24925ca604-c3f50f44e0e511aae429', 1, 1, 'EMPRESA DE PRUEBA', 'HOTEL', 'PEDRO HOTEL', 'EMAFACT@EMA.COM', 1, '2022-11-18 09:28:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valorvariablesalp`
--

CREATE TABLE `valorvariablesalp` (
  `idValorvar` bigint NOT NULL,
  `varValorvar` bigint NOT NULL,
  `iniValorvar` varchar(6) NOT NULL,
  `finValorvar` varchar(6) NOT NULL,
  `tipValorvar` varchar(1) NOT NULL,
  `valValorvar` float(15,2) NOT NULL,
  `estValorvar` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `valorvariablesalp`
--

INSERT INTO `valorvariablesalp` (`idValorvar`, `varValorvar`, `iniValorvar`, `finValorvar`, `tipValorvar`, `valValorvar`, `estValorvar`) VALUES
(1, 1, '202402', '202412', 'P', 2500.00, 1),
(2, 2, '202401', '202412', 'p', 34500.00, 0),
(3, 3, '202402', '202412', 'V', 4800.00, 0),
(4, 5, '202401', '202402', 'V', 1250000.00, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `varsalp`
--

CREATE TABLE `varsalp` (
  `idVarsalp` bigint NOT NULL,
  `codVarsalp` varchar(10) NOT NULL,
  `desVarsalp` varchar(120) NOT NULL,
  `estVarsalp` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `varsalp`
--

INSERT INTO `varsalp` (`idVarsalp`, `codVarsalp`, `desVarsalp`, `estVarsalp`) VALUES
(1, '01', 'C.R.T.A.', 1),
(2, '02', 'T.I.R.', 1),
(3, '03', 'F.A.O.M.', 1),
(4, '04', 'F.A.O.M.S.', 1),
(5, '05', 'I.D.', 1),
(6, '06', 'C.A.E.E.n.', 1),
(7, '07', 'V.C.E.E.i', 1),
(8, '08', 'PRUEBA', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actas`
--
ALTER TABLE `actas`
  ADD PRIMARY KEY (`idActa`),
  ADD KEY `tipActa` (`tipActa`),
  ADD KEY `recActa` (`recActa`) USING BTREE,
  ADD KEY `iteActa` (`iteActa`);

--
-- Indices de la tabla `capitulos`
--
ALTER TABLE `capitulos`
  ADD PRIMARY KEY (`idCapitulo`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`idContacto`);

--
-- Indices de la tabla `costoconsumo`
--
ALTER TABLE `costoconsumo`
  ADD PRIMARY KEY (`idCosto`);

--
-- Indices de la tabla `detalleacta`
--
ALTER TABLE `detalleacta`
  ADD PRIMARY KEY (`idDetalle`),
  ADD KEY `actDetalle` (`actDetalle`),
  ADD KEY `eleDetalle` (`eleDetalle`);

--
-- Indices de la tabla `docuactas`
--
ALTER TABLE `docuactas`
  ADD PRIMARY KEY (`idImagen`),
  ADD KEY `actImagen` (`actImagen`);

--
-- Indices de la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`idElemento`),
  ADD KEY `gruElemento` (`gruElemento`),
  ADD KEY `oriElemento` (`recElemento`),
  ADD KEY `ubiElemento` (`usoElemento`),
  ADD KEY `iteElemento` (`iteElemento`);

--
-- Indices de la tabla `estratos`
--
ALTER TABLE `estratos`
  ADD PRIMARY KEY (`idEstrato`);

--
-- Indices de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`idFactura`),
  ADD KEY `relFactura` (`relFactura`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`idGrupo`),
  ADD KEY `capGrupo` (`capGrupo`);

--
-- Indices de la tabla `gruposalp`
--
ALTER TABLE `gruposalp`
  ADD PRIMARY KEY (`idGruposalp`),
  ADD UNIQUE KEY `codGruposalp` (`codGruposalp`),
  ADD KEY `tipGruposalp` (`tipGruposalp`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idImagen`),
  ADD KEY `idProducto` (`idElemento`);

--
-- Indices de la tabla `itemsacta`
--
ALTER TABLE `itemsacta`
  ADD PRIMARY KEY (`idItemacta`),
  ADD KEY `tipItemacta` (`tipItemacta`);

--
-- Indices de la tabla `itemsalp`
--
ALTER TABLE `itemsalp`
  ADD PRIMARY KEY (`idItem`),
  ADD KEY `gruItem` (`gruItem`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`idModulo`);

--
-- Indices de la tabla `parametros`
--
ALTER TABLE `parametros`
  ADD PRIMARY KEY (`idParam`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idPermiso`),
  ADD KEY `idRol` (`idRol`) USING BTREE,
  ADD KEY `idModulo` (`idModulo`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idpost`);

--
-- Indices de la tabla `pqrs`
--
ALTER TABLE `pqrs`
  ADD PRIMARY KEY (`idPqrs`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`idRecurso`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `subgrupos`
--
ALTER TABLE `subgrupos`
  ADD PRIMARY KEY (`idSubgrupo`),
  ADD KEY `gruSubgrupo` (`gruSubgrupo`);

--
-- Indices de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  ADD PRIMARY KEY (`idSuscripcion`);

--
-- Indices de la tabla `tipoactas`
--
ALTER TABLE `tipoactas`
  ADD PRIMARY KEY (`idTipoacta`);

--
-- Indices de la tabla `tiposuso`
--
ALTER TABLE `tiposuso`
  ADD PRIMARY KEY (`idTipouso`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `valorvariablesalp`
--
ALTER TABLE `valorvariablesalp`
  ADD PRIMARY KEY (`idValorvar`),
  ADD KEY `varValorvar` (`varValorvar`);

--
-- Indices de la tabla `varsalp`
--
ALTER TABLE `varsalp`
  ADD PRIMARY KEY (`idVarsalp`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actas`
--
ALTER TABLE `actas`
  MODIFY `idActa` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `capitulos`
--
ALTER TABLE `capitulos`
  MODIFY `idCapitulo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `idContacto` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `costoconsumo`
--
ALTER TABLE `costoconsumo`
  MODIFY `idCosto` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalleacta`
--
ALTER TABLE `detalleacta`
  MODIFY `idDetalle` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `docuactas`
--
ALTER TABLE `docuactas`
  MODIFY `idImagen` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `elementos`
--
ALTER TABLE `elementos`
  MODIFY `idElemento` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `estratos`
--
ALTER TABLE `estratos`
  MODIFY `idEstrato` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  MODIFY `idFactura` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `idGrupo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `gruposalp`
--
ALTER TABLE `gruposalp`
  MODIFY `idGruposalp` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `idImagen` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `itemsacta`
--
ALTER TABLE `itemsacta`
  MODIFY `idItemacta` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `itemsalp`
--
ALTER TABLE `itemsalp`
  MODIFY `idItem` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `idModulo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `idParam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermiso` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=464;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `idpost` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pqrs`
--
ALTER TABLE `pqrs`
  MODIFY `idPqrs` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `idRecurso` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `subgrupos`
--
ALTER TABLE `subgrupos`
  MODIFY `idSubgrupo` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  MODIFY `idSuscripcion` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipoactas`
--
ALTER TABLE `tipoactas`
  MODIFY `idTipoacta` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tiposuso`
--
ALTER TABLE `tiposuso`
  MODIFY `idTipouso` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `valorvariablesalp`
--
ALTER TABLE `valorvariablesalp`
  MODIFY `idValorvar` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `varsalp`
--
ALTER TABLE `varsalp`
  MODIFY `idVarsalp` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
