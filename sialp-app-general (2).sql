-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 15-02-2024 a las 11:39:53
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
-- Base de datos: `sialp-app-general`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `capitulos`
--

CREATE TABLE `capitulos` (
  `idCapitulo` bigint NOT NULL,
  `nomCapitulo` varchar(20) COLLATE utf8mb4_spanish_ci NOT NULL,
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
-- Estructura de tabla para la tabla `elementos`
--

CREATE TABLE `elementos` (
  `idElemento` bigint NOT NULL,
  `gruElemento` bigint NOT NULL,
  `codElemento` varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL,
  `nomElemento` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `desElemento` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `dirElemento` varchar(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `latElemento` float(15,2) NOT NULL,
  `lonElemento` float(15,2) NOT NULL,
  `rutElemento` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `estElemento` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `elementos`
--

INSERT INTO `elementos` (`idElemento`, `gruElemento`, `codElemento`, `nomElemento`, `desElemento`, `dirElemento`, `latElemento`, `lonElemento`, `rutElemento`, `estElemento`) VALUES
(1, 2, '01002100', 'Luminaria LED 30w', '<p>Esta es una prueba de la hoja de vida</p> <ul> <li>Fecha Mayo 1 de 2024 - Se instala la luminaria</li> <li>Fecha Junio 15 de 2024 - Se cambia el sticker del poste</li> <li>Fecha Agosto 30 de 2024 - Se reemplaza la luminaria por robo</li> </ul>', 'Esta es la direccion de la luminaria', 15.25, 14.23, '01002100', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `idGrupo` bigint NOT NULL,
  `capGrupo` bigint NOT NULL,
  `desGrupo` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
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
  `codGruposalp` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `desGruposalp` varchar(150) COLLATE utf8mb4_spanish_ci NOT NULL,
  `vidGruposalp` float(6,2) NOT NULL,
  `estGruposalp` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `gruposalp`
--

INSERT INTO `gruposalp` (`idGruposalp`, `codGruposalp`, `desGruposalp`, `vidGruposalp`, `estGruposalp`) VALUES
(1, '01', 'Bombillas de Sodio', 3.50, 1),
(2, '02', 'Luminarias LED 30w', 15.00, 1);

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
(1, 1, 'pro_fc7d732eb2acba1328d11dbb2fc42739.jpg');

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
(5, 'Movimientos', '- Registro Modelo Contractual\r\n- Regristro Ejecución Real\r\n- Registro de Actas\r\n- Registro consumo y costos Energía\r\n- Registro Valores Variables\r\n- Registro Valores Variables Costos Máximos\r\n- Registro Porcentajes Tasas de Retorno', 1),
(6, 'Gestion Documental', 'Registro Documentos', 1),
(16, 'Informes', 'Informes de Cartera', 1),
(17, 'Suscriptores', 'Registro Suscriptores', 1),
(18, 'Contactos', 'Registro de Contactos', 1),
(19, 'Páginas', 'Páginas del Sitio WEB', 1);

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
(415, 1, 1, 1, 1, 1, 1),
(416, 1, 2, 1, 1, 1, 1),
(417, 1, 3, 1, 1, 1, 1),
(418, 1, 4, 1, 1, 1, 1),
(419, 1, 5, 1, 1, 1, 1),
(420, 1, 6, 1, 1, 1, 1),
(421, 1, 7, 1, 1, 1, 1),
(422, 1, 8, 1, 1, 1, 1),
(423, 1, 9, 1, 1, 1, 1),
(424, 1, 10, 1, 1, 1, 1),
(425, 1, 11, 1, 1, 1, 1),
(426, 1, 12, 1, 1, 1, 1),
(427, 1, 13, 1, 1, 1, 1),
(428, 1, 14, 1, 1, 1, 1),
(429, 1, 15, 1, 1, 1, 1),
(430, 1, 16, 1, 1, 1, 1),
(431, 1, 17, 1, 1, 1, 1),
(432, 1, 18, 1, 1, 1, 1),
(433, 1, 19, 1, 1, 1, 1),
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
(452, 5, 19, 1, 0, 0, 0);

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
(4, 'Nosotros TRES', '<section class=\"bg0 p-t-75 p-b-120\"> <div class=\"container\"> <div class=\"row p-b-148\"> <div class=\"col-md-7 col-lg-8\"> <div class=\"p-t-7 p-r-85 p-r-15-lg p-r-0-md\"> <h3 class=\"mtext-111 cl2 p-b-16\">Historia</h3> <p class=\"stext-113 cl6 p-b-26\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris consequat consequat enim, non auctor massa ultrices non. Morbi sed odio massa. Quisque at vehicula tellus, sed tincidunt augue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Maecenas varius egestas diam, eu sodales metus scelerisque congue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Maecenas gravida justo eu arcu egestas convallis. Nullam eu erat bibendum, tempus ipsum eget, dictum enim. Donec non neque ut enim dapibus tincidunt vitae nec augue. Suspendisse potenti. Proin ut est diam. Donec condimentum euismod tortor, eget facilisis diam faucibus et. Morbi a tempor elit.</p> <p class=\"stext-113 cl6 p-b-26\">Donec gravida lorem elit, quis condimentum ex semper sit amet. Fusce eget ligula magna. Aliquam aliquam imperdiet sodales. Ut fringilla turpis in vehicula vehicula. Pellentesque congue ac orci ut gravida. Aliquam erat volutpat. Donec iaculis lectus a arcu facilisis, eu sodales lectus sagittis. Etiam pellentesque, magna vel dictum rutrum, neque justo eleifend elit, vel tincidunt erat arcu ut sem. Sed rutrum, turpis ut commodo efficitur, quam velit convallis ipsum, et maximus enim ligula ac ligula. PRUEBA 1</p> <p class=\"stext-113 cl6 p-b-26\">Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879</p> </div> </div> <div class=\"col-11 col-md-5 col-lg-4 m-lr-auto\"> <div class=\"how-bor1 \"> <div class=\"hov-img0\"><img src=\"https://cdn.pixabay.com/photo/2015/07/17/22/43/student-849825_1280.jpg\" alt=\"IMG\" width=\"500\" height=\"333\"></div> </div> </div> </div> <div class=\"row\"> <div class=\"order-md-2 col-md-7 col-lg-8 p-b-30\"> <div class=\"p-t-7 p-l-85 p-l-15-lg p-l-0-md\"> <h2 class=\"mtext-111 cl2 p-b-16\"><span style=\"color: #236fa1;\">Nuestra Misi&oacute;n</span></h2> <p class=\"stext-113 cl6 p-b-26\">Mauris non lacinia magna. Sed nec lobortis dolor. Vestibulum rhoncus dignissim risus, sed consectetur erat. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam maximus mauris sit amet odio convallis, in pharetra magna gravida. Praesent sed nunc fermentum mi molestie tempor. Morbi vitae viverra odio. Pellentesque ac velit egestas, luctus arcu non, laoreet mauris. Sed in ipsum tempor, consequat odio in, porttitor ante. Ut mauris ligula, volutpat in sodales in, porta non odio. Pellentesque tempor urna vitae mi vestibulum, nec venenatis nulla lobortis. Proin at gravida ante. Mauris auctor purus at lacus maximus euismod. Pellentesque vulputate massa ut nisl hendrerit, eget elementum libero iaculis.</p> <div class=\"bor16 p-l-29 p-b-9 m-t-22\"> <p class=\"stext-114 cl6 p-r-40 p-b-11\">Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn\'t really do it, they just saw something. It seemed obvious to them after a while. PRUEBA DOS</p> <span class=\"stext-111 cl8\"> - Steve Job&rsquo;s </span></div> </div> </div> <div class=\"order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30\"> <div class=\"how-bor2\"> <div class=\"hov-img0\"><img src=\"https://cdn.pixabay.com/photo/2015/07/17/22/43/student-849822_1280.jpg\" alt=\"IMG\" width=\"500\" height=\"333\"></div> </div> </div> </div> </div> </section>', 'img_b51b41c3cc71af6f5f41ca6a91fca133.jpg', '2021-08-09 03:09:44', 'nosotros', 2),
(5, 'Contacto', '<div class=\"map\"><iframe style=\"border: 0;\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.685802352331!2d-90.73646108521129!3d14.559951589828378!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85890e74b3771e19%3A0x68ec9eeea79fd9a7!2sEl%20Arco%20de%20Santa%20Catalina!5e0!3m2!1ses!2sgt!4v1624005005655!5m2!1ses!2sgt\" width=\"100%\" height=\"600\" allowfullscreen=\"allowfullscreen\" loading=\"lazy\"></iframe></div>', 'img_a9b3dd88bcde716848c3bf4bcd50f28f.jpg', '2021-08-09 03:11:08', 'contacto', 1),
(6, 'Preguntas frecuentes', '<ol> <li><strong>&iquest;Cu&aacute;l es el tiempo de entrega de los producto? </strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt! Quae doloribus deserunt qui fugit illo nobis ipsum, accusamus eius perferendis beatae culpa molestias!</li> <li><strong>&iquest;C&oacute;mo es la forma de env&iacute;o de los productos?</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur.</li> <li><strong>&iquest;Cu&aacute;l es el tiempo m&aacute;ximo para solicitar un reembolso?</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt!</li> </ol> <p>&nbsp;</p> <p>Otras preguntas</p> <ul> <li><strong>&iquest;Qu&eacute; formas de pago aceptan? </strong><span style=\"color: #666666; font-family: Arial, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">Corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt! Quae doloribus deserunt qui fugit illo nobis ipsum, accusamus eius perferendis beatae culpa molestias!</span></li> </ul>', '', '2021-08-11 01:24:19', 'preguntas-frecuentes', 1),
(7, 'Términos y Condiciones', '<p>A continuaci&oacute;n se describen los t&eacute;rmino y condiciones de la Tienda Virtual!</p> <ol> <li>Pol&iacute;tica uno</li> <li>Termino dos</li> <li>Condici&oacute;n tres</li> </ol> <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis sunt, corrupti hic aspernatur cumque alias, ipsam omnis iure ipsum, nostrum labore obcaecati natus repellendus consequatur est nemo sapiente dolorem dicta. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Commodi, voluptas, consectetur iusto delectus quaerat ullam nesciunt! Quae doloribus deserunt qui fugit illo nobis ipsum, accusamus eius perferendis beatae culpa molestias!</p>', '', '2021-08-11 01:51:06', 'terminos-y-condiciones', 1),
(8, 'Sucursales', '<section class=\"py-5 text-center\"> <div class=\"container\"> <p>Visitanos y obten los mejores precios del mercado, cualquier art&iacute;culo que necestas para vivir mejor</p> <a class=\"btn btn-info\" href=\"../../cmrpos/tienda\">VER PRODUCTOS</a></div> </section> <div class=\"py-5 bg-light\"> <div class=\"container\"> <div class=\"row\"> <div class=\"col-md-4\"> <div class=\"card mb-4 box-shadow hov-img0\"><img src=\"https://abelosh.com/tienda_virtual/Assets/images/s1.jpg\" alt=\"Tienda Uno\" width=\"100%\" height=\"100%\"> <div class=\"card-body\"> <p class=\"card-text\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p> <p>Direcci&oacute;n: Antigua Gautemala <br>Tel&eacute;fono: 4654645 <br>Correo: info@abelosh.com</p> </div> </div> </div> <div class=\"col-md-4\"> <div class=\"card mb-4 box-shadow hov-img0\"><img src=\"https://abelosh.com/tienda_virtual/Assets/images/s2.jpg\" alt=\"Sucural dos\" width=\"100%\" height=\"100%\"> <div class=\"card-body\"> <p class=\"card-text\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p> <p>Direcci&oacute;n: Antigua Gautemala <br>Tel&eacute;fono: 4654645 <br>Correo: info@abelosh.com</p> </div> </div> </div> <div class=\"col-md-4\"> <div class=\"card mb-4 box-shadow hov-img0\"><img src=\"https://abelosh.com/tienda_virtual/Assets/images/s3.jpg\" alt=\"Sucural tres\" width=\"100%\" height=\"100%\"> <div class=\"card-body\"> <p class=\"card-text\">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quaerat necessitatibus eligendi, soluta ipsa natus, at earum qui enim, illum doloremque, accusantium autem nemo est esse nulla neque eaque repellendus amet.</p> <p>Direcci&oacute;n: Antigua Gautemala <br>Tel&eacute;fono: 4654645 <br>Correo: info@abelosh.com</p> </div> </div> </div> </div> </div> </div>', 'img_d72cb5712933863e051dc9c7fac5e253.jpg', '2021-08-11 02:26:45', 'sucursales', 1),
(9, 'Not Found', '<h1>Error 404: P&aacute;gina no encontrada</h1> <p>No se encuentra la p&aacute;gina que ha solicitado.</p>', '', '2021-08-12 02:30:49', 'not-found', 1),
(10, 'Pqrs', '<p>AQUI PONGA LAS PQR</p>', 'img_4f32ea689c4111d7f185a7bd549e7d3a.jpg', '2024-02-11 18:33:06', 'pqrs', 1);

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
  `desSubgrupo` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
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

--
-- Índices para tablas volcadas
--

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
-- Indices de la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`idElemento`),
  ADD KEY `gruElemento` (`gruElemento`);

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
  ADD UNIQUE KEY `codGruposalp` (`codGruposalp`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`idImagen`),
  ADD KEY `idProducto` (`idElemento`);

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
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `elementos`
--
ALTER TABLE `elementos`
  MODIFY `idElemento` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `idImagen` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `idModulo` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `parametros`
--
ALTER TABLE `parametros`
  MODIFY `idParam` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermiso` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=453;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `idpost` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` bigint NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` bigint NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
