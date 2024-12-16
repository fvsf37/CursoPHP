-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-03-2023 a las 10:26:08
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Base de datos: `pruebas`
--

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `CODIGOARTICULO` varchar(4) DEFAULT NULL,
  `SECCION` varchar(12) DEFAULT NULL,
  `NOMBREARTICULO` varchar(19) DEFAULT NULL,
  `PRECIO` int(2) DEFAULT NULL,
  `FECHA` varchar(10) DEFAULT NULL,
  `IMPORTADO` varchar(9) DEFAULT NULL,
  `PAISDEORIGEN` varchar(7) DEFAULT NULL,
  `FOTO` varchar(50) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (
    `CODIGOARTICULO`,
    `SECCION`,
    `NOMBREARTICULO`,
    `PRECIO`,
    `FECHA`,
    `IMPORTADO`,
    `PAISDEORIGEN`,
    `FOTO`
  )
VALUES (
    'AR01',
    'FERRETERIA',
    'DESTORNILLADOR',
    22,
    '05/10/2022',
    'VERDADERO',
    'ESPAÑA',
    '1.jpg'
  ),
  (
    'AR02',
    'DEPORTES',
    'RAQUETA',
    23,
    '05/10/2022',
    'VERDADERO',
    'USA',
    NULL
  ),
  (
    'AR03',
    'JUGUETES',
    'BALON BALONCESTO',
    24,
    '05/10/2022',
    'FALSO',
    'JAPON',
    NULL
  ),
  (
    'AR04',
    'ROPA',
    'CAMISETA FUTBOL',
    25,
    '05/10/2022',
    'VERDADERO',
    'FRANCIA',
    NULL
  ),
  (
    'AR05',
    'ALIMENTACION',
    'NARANJAS',
    26,
    '05/10/2022',
    'VERDADERO',
    'ESPAÑA',
    NULL
  ),
  (
    'AR06',
    'FERRETERIA',
    'TORNILLO',
    27,
    '05/10/2022',
    'VERDADERO',
    'ESPAÑA',
    NULL
  ),
  (
    'AR07',
    'DEPORTES',
    'TENIS TIPO A',
    28,
    '05/10/2022',
    'VERDADERO',
    'ESPAÑA',
    NULL
  ),
  (
    'AR08',
    'JUGUETES',
    'BALON',
    29,
    '05/10/2022',
    'VERDADERO',
    'ESPAÑA',
    NULL
  ),
  (
    'AR09',
    'ROPA',
    'CAMISETA BALONCESTO',
    30,
    '05/10/2022',
    'FALSO',
    'ESPAÑA',
    NULL
  ),
  (
    'AR10',
    'ALIMENTACION',
    'FRESAS',
    31,
    '05/10/2022',
    'FALSO',
    'ESPAÑA',
    NULL
  ),
  (
    'AR11',
    'FERRETERIA',
    'CLAVOS',
    32,
    '05/10/2022',
    'VERDADERO',
    'JAPON',
    NULL
  ),
  (
    'AR12',
    'DEPORTES',
    'TENIS TIPO B',
    33,
    '05/10/2022',
    'VERDADERO',
    'JAPON',
    NULL
  ),
  (
    'AR13',
    'JUGUETES',
    'BALON FUTBOL',
    34,
    '05/10/2022',
    'VERDADERO',
    'USA',
    NULL
  ),
  (
    'AR14',
    'ROPA',
    'CAMISETA BALONCESTO',
    35,
    '05/10/2022',
    'VERDADERO',
    'USA',
    NULL
  ),
  (
    'AR15',
    'ALIMENTACION',
    'MELON',
    36,
    '05/10/2022',
    'VERDADERO',
    'FRANCIA',
    NULL
  ),
  (
    'AR16',
    'FERRETERIA',
    'SIERRA',
    37,
    '05/10/2022',
    'VERDADERO',
    'FRANCIA',
    NULL
  ),
  (
    'AR17',
    'DEPORTES',
    'TENIS',
    38,
    '05/10/2022',
    'VERDADERO',
    'JAPON',
    NULL
  ),
  (
    'AR18',
    'JUGUETES',
    'BALON FUTBOL',
    39,
    '05/10/2022',
    'FALSO',
    'USA',
    NULL
  ),
  (
    'AR19',
    'ROPA',
    'CAMISETA BALONCESTO',
    40,
    '05/10/2022',
    'VERDADERO',
    'USA',
    NULL
  ),
  (
    'AR20',
    'ALIMENTACION',
    'SANDIAS',
    41,
    '05/10/2022',
    'VERDADERO',
    'FRANCIA',
    NULL
  ),
  (
    'AR21',
    'FERRETERIA',
    'CUCHILLO',
    42,
    '05/10/2022',
    'VERDADERO',
    'ESPAÑA',
    NULL
  ),
  (
    'AR22',
    'DEPORTES',
    'TENIS TIPO C',
    43,
    '05/10/2022',
    'VERDADERO',
    'ESPAÑA',
    NULL
  ),
  (
    'AR23',
    'JUGUETES',
    'BALON FUTBOL',
    44,
    '05/10/2022',
    'VERDADERO',
    'FRANCIA',
    NULL
  ),
  (
    'AR24',
    'ROPA',
    'CAMISETA BALONCESTO',
    45,
    '05/10/2022',
    'FALSO',
    'JAPON',
    NULL
  ),
  (
    'AR25',
    'ALIMENTACION',
    'AGUA',
    46,
    '05/10/2022',
    'VERDADERO',
    'USA',
    NULL
  ),
  (
    'AR26',
    'FERRETERIA',
    'CAJAS CONEXIONES',
    47,
    '05/10/2022',
    'FALSO',
    'JAPON',
    NULL
  ),
  (
    'AR27',
    'DEPORTES  ',
    'TENIS GENERAL  ',
    2222,
    '05/10/2022',
    'VERDADERO',
    'ESPAÑA',
    NULL
  ),
  (
    'AR10',
    'CERAMICA',
    'VAJILLA',
    44,
    '10-10-2022',
    'VERDADERO',
    'ESPAÑA',
    NULL
  ),
  (
    'AR10',
    'CERAMICA',
    'VAJILLA',
    44,
    '10-10-2022',
    'VERDADERO',
    'ESPAÑA',
    NULL
  ),
  (
    'AR10',
    'CERAMICA',
    'VAJILLA',
    44,
    '10-10-2022',
    'VERDADERO',
    'ESPAÑA',
    NULL
  ),
  (
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    NULL,
    '1.jpg'
  );
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;