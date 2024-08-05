-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2024 at 06:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elevatronice`
--

-- --------------------------------------------------------

--
-- Table structure for table `ascensores`
--

CREATE TABLE `ascensores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `contrato` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `código` varchar(255) DEFAULT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `cliente` varchar(255) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `garantizar` varchar(255) DEFAULT NULL,
  `dirección` varchar(255) DEFAULT NULL,
  `ubigeo` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `técnico_instalador` varchar(255) DEFAULT NULL,
  `técnico_ajustador` varchar(255) DEFAULT NULL,
  `tipo_de_ascensor` varchar(255) DEFAULT NULL,
  `cantidad` varchar(255) DEFAULT NULL,
  `quarters` varchar(255) DEFAULT NULL,
  `mgratuito` varchar(255) DEFAULT NULL,
  `sincuarto` varchar(255) DEFAULT NULL,
  `concuarto` varchar(255) DEFAULT NULL,
  `npisos` varchar(255) DEFAULT NULL,
  `ncontacto` varchar(255) DEFAULT NULL,
  `teléfono` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `descripcion1` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ascensores`
--

INSERT INTO `ascensores` (`id`, `imagen`, `contrato`, `nombre`, `código`, `marca`, `cliente`, `fecha`, `garantizar`, `dirección`, `ubigeo`, `provincia`, `técnico_instalador`, `técnico_ajustador`, `tipo_de_ascensor`, `cantidad`, `quarters`, `mgratuito`, `sincuarto`, `concuarto`, `npisos`, `ncontacto`, `teléfono`, `correo`, `descripcion1`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, '', 'asdad', 'tyty', 'asdasd', '10', 'tyty', '2024-07-04', 'asdasd', 'vedroad gurukul 4564', 'dasdas', 'huanuco', 'isha12', 'tyty', 'hello', 'cantidad_2', 'mgratuito,concuarto,mgratuito,concuarto,mgratuito,concuarto,mgratuito,concuarto', NULL, NULL, NULL, 'asdas', 'hello', '9875512112', 'sdasd@gmail.com', '[op[', '2024-07-03 23:40:49', '2024-07-05 04:22:52', NULL),
(3, '', 'asdad', 'tyty', 'asdasd', '4', 'tyty', '2024-07-04', 'asdasd', 'vedroad gurukul 4564', 'dasdas', 'huanuco', 'isha12', 'tyty', 'hello', 'cantidad_2', 'mgratuito,concuarto', NULL, NULL, NULL, 'asdas', 'hello', '9875512112', 'sdasd@gmail.com', '[op[', '2024-07-05 04:08:23', '2024-07-05 04:22:30', NULL),
(4, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-11 22:35:09', '2024-07-11 22:35:18', '2024-07-11 22:35:18'),
(5, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-11 22:35:10', '2024-07-11 22:35:15', '2024-07-11 22:35:15'),
(6, '', NULL, '546546', '6456', '3', 'tyty', NULL, NULL, '6456', '6456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6456', '45654', NULL, NULL, NULL, '2024-07-11 22:35:41', '2024-07-11 22:50:48', '2024-07-11 22:50:48'),
(7, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-07-11 22:44:33', '2024-07-11 22:50:41', '2024-07-11 22:50:41'),
(8, '', NULL, '445', NULL, NULL, 'tyty', NULL, NULL, '645654', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6456', '64566456', NULL, '56456', '2024-07-11 22:51:20', '2024-07-11 22:51:36', '2024-07-11 22:51:36'),
(9, '', '897897', '7567', NULL, NULL, 'tyty', NULL, NULL, '7567657', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '657567', '756756', NULL, '7567567', '2024-07-11 22:52:30', '2024-07-11 22:58:01', '2024-07-11 22:58:01'),
(10, '', NULL, '7567', NULL, NULL, 'tyty', NULL, NULL, '756756', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '75676', NULL, NULL, '756756', '2024-07-11 23:04:19', '2024-07-31 05:33:19', '2024-07-31 05:33:19'),
(11, '', NULL, '45654', NULL, NULL, 'tyty', NULL, NULL, '645654', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '645645', '645654', 'sdasd@gmail.com', '645645', '2024-07-11 23:05:03', '2024-07-31 05:33:15', '2024-07-31 05:33:15'),
(12, '', 'asdad', 'iyu', NULL, '10', 'tyty', '2024-07-04', 'asdasd', '789789', 'dasdas', NULL, 'isha12', NULL, 'hello', 'cantidad_2', 'mgratuito,concuarto', NULL, NULL, NULL, 'asdas', 'iuyiuy', '9875512112', NULL, 'iuyi', '2024-07-11 23:05:25', '2024-07-16 00:04:02', '2024-07-16 00:04:02'),
(13, '', 'asdad', 'isha12', '77713', '2', 'tyty', '2024-07-31', 'dasd', 'vedroad gurukul 4564 fdfsd', 'hgfhgf', 'arequipa', 'tyty', 'tyty', 'hello', 'cantidad_1', 'mgratuito', NULL, NULL, NULL, '7', 'nbnbmbmbb', '987654321', 'sdasd@gmail.com', 'uyuty', '2024-07-30 22:47:01', '2024-07-31 06:14:41', '2024-07-31 06:14:41'),
(14, '', 'asdad', 'tyty', 'asdasd', '3', 'tyty', '2024-07-31', 'jghj', 'vedroad gurukul 4564 fdfsd', 'jhj', 'arequipa', 'tyty', 'isha12', 'hello', 'cantidad_2', 'mgratuito', NULL, NULL, NULL, '7', 'dasdas', '98755121', 'sdasd@gmail.com', 'wqwq', '2024-07-31 04:22:44', '2024-07-31 04:22:44', NULL),
(15, '', 'sdffds', 'sdfsd', 'fsd', '2', 'hgfhfg', '2024-07-31', 'gfdg', 'gdfg', 'gdfg', 'arequipa', 'tyty', 'isha12', 'xvzvzx', 'cantidad_3', 'mgratuito', NULL, NULL, NULL, '8', 'dasdas', '67567887878', 'abc@gmail.com', 'yty', '2024-07-31 04:31:03', '2024-07-31 04:31:03', NULL),
(16, '', 'asdad', 'tyty', NULL, '2', 'tyty', '2024-08-06', '123133', 'vedroad gurukul 4564', 'dasdas', 'callao', 'isha12', 'tyty', 'xvzvzx', 'cantidad_2', 'mgratuito', NULL, NULL, NULL, '7', 'hello', '123454', 'fdf@gmail.com', 'kljkl', '2024-07-31 06:15:29', '2024-07-31 06:15:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asignar_repuestos`
--

CREATE TABLE `asignar_repuestos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipos_de_ascensors_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nombre_del_tipo_de_ascensor` varchar(255) DEFAULT NULL,
  `reemplazo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asignar_repuestos`
--

INSERT INTO `asignar_repuestos` (`id`, `tipos_de_ascensors_id`, `nombre_del_tipo_de_ascensor`, `reemplazo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'hello', 'FGDFGGD', '2024-07-04 00:48:14', '2024-07-04 00:48:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `tipo_de_cliente` varchar(255) DEFAULT NULL,
  `ruc` varchar(255) DEFAULT NULL,
  `país` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `dirección` varchar(255) DEFAULT NULL,
  `teléfono` varchar(255) DEFAULT NULL,
  `teléfono_móvil` varchar(255) DEFAULT NULL,
  `correo_electrónico` varchar(255) DEFAULT NULL,
  `nombre_del_contacto` varchar(255) DEFAULT NULL,
  `posición` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `tipo_de_cliente`, `ruc`, `país`, `provincia`, `dirección`, `teléfono`, `teléfono_móvil`, `correo_electrónico`, `nombre_del_contacto`, `posición`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'isha12', 'cilente1', '12302121123', 'perú', 'arequipa', 'fsdfsdf', '675678878', '675678878', 'admin@gmail.com', 'jghjghjgh', 'laravel', '2024-07-01 00:56:15', '2024-07-01 00:56:34', '2024-07-01 00:56:34'),
(2, 'tyty', 'cilente1', '12302121123', 'perú', 'huanuco', 'fsdfsdf', '675678568', '567867876', 'admin@gmail.com', 'admin', 'xzczx', '2024-07-01 00:58:34', '2024-07-01 00:58:42', '2024-07-01 00:58:42'),
(3, 'isha12', 'cilente1', '12302121123', 'perú', 'huanuco', 'fsdfsdf', '675678568', '567867876', 'admin@gmail.com', 'jghjghjgh', 'xzczx', '2024-07-01 01:00:56', '2024-07-01 01:01:04', '2024-07-01 01:01:04'),
(4, 'isha12', 'cilente2', '12302121123', 'perú', 'arequipa', 'fsdfsdf', '675678878', '567867876', 'isha@gmail.com', 'jghjghjgh', 'laravel', '2024-07-01 01:04:03', '2024-07-31 06:01:00', '2024-07-31 06:01:00'),
(5, 'tyty', 'cilente1', '12345645647', 'perú', 'arequipa', 'fsdfsdf', '675678568', '567867876', 'admin@gmail.com', 'gdfgdfgdf', 'sdsdsdsds', '2024-07-04 23:45:12', '2024-07-31 06:01:00', '2024-07-31 06:01:00'),
(6, 'tyty', 'cilente3', '12302121123', 'perú', 'arequipa', 'fsdfsdf', '675678568', '675678568', 'admin@gmail.com', 'admin', 'sdsdsdsds', '2024-07-08 01:43:33', '2024-07-31 06:01:00', '2024-07-31 06:01:00'),
(7, 'trt', 'cilente2', '46546556565', 'perú', 'arequipa', 'fdgdfg', '565654665', '565465464', 'gfdfg@gmail.com', 'fsdfsd', 'fsdfsd', '2024-07-16 00:06:09', '2024-07-31 06:01:00', '2024-07-31 06:01:00'),
(8, 'hgfhfg', 'cilente1', '56564454534', 'perú', 'arequipa', 'fdgxfgfxg', '575656665', '576767676', 'hgfh@gmail.com', 'hgfhg', NULL, '2024-07-16 00:11:21', '2024-07-31 06:01:00', '2024-07-31 06:01:00'),
(9, 'tyty', 'cilente2', '12345678997', 'perú', 'arequipa', 'fsdfsdf', '675678568', '567867876', 'admin@gmail.com', 'gdfgdfgdf', 'xzczx', '2024-07-31 06:14:21', '2024-07-31 06:14:21', NULL),
(10, 'tyty', 'cilente1', '12302121124', 'perú', 'arequipa', 'fsdfsdf', '675678568', '567867876', 'admin@gmail.com', 'admin', 'laravel123', '2024-08-01 17:45:23', '2024-08-01 17:45:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contratos`
--

CREATE TABLE `contratos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ascensor` varchar(255) DEFAULT NULL,
  `fecha_de_propuesta` varchar(255) DEFAULT NULL,
  `monto_de_propuesta` varchar(255) DEFAULT NULL,
  `monto_de_contrato` varchar(255) DEFAULT NULL,
  `fecha_de_inicio` varchar(255) DEFAULT NULL,
  `fecha_de_fin` varchar(255) DEFAULT NULL,
  `renovación` varchar(255) DEFAULT NULL,
  `cada_cuantos_meses` varchar(255) DEFAULT NULL,
  `observación` varchar(255) DEFAULT NULL,
  `estado_cuenta_del_contrato` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contratos`
--

INSERT INTO `contratos` (`id`, `ascensor`, `fecha_de_propuesta`, `monto_de_propuesta`, `monto_de_contrato`, `fecha_de_inicio`, `fecha_de_fin`, `renovación`, `cada_cuantos_meses`, `observación`, `estado_cuenta_del_contrato`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'tyty', '2024-07-17', '122', '122', '2024-07-18', '2024-07-18', 'on', '45', 'erwer', 'rwer', 'activo', '2024-07-17 01:58:12', '2024-07-17 01:58:12', NULL),
(2, 'tyty', '2024-07-31', '98', '98', '2024-08-01', '2024-07-31', 'on', 'hhfghfg', 'wew', 'eqwe', 'inactivo', '2024-07-30 22:25:29', '2024-07-30 22:25:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cronogramas`
--

CREATE TABLE `cronogramas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ascensor` varchar(255) DEFAULT NULL,
  `revisar` varchar(255) DEFAULT NULL,
  `técnico` varchar(255) DEFAULT NULL,
  `mantenimiento` date DEFAULT NULL,
  `hora_de_inicio` varchar(255) DEFAULT NULL,
  `hora_de_finalización` varchar(255) DEFAULT NULL,
  `estado` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cronogramas`
--

INSERT INTO `cronogramas` (`id`, `ascensor`, `revisar`, `técnico`, `mantenimiento`, `hora_de_inicio`, `hora_de_finalización`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'tyty', 'jjljk', 'técnico_2', '2024-07-01', '10:51', '11:51', 'activo', '2024-07-07 23:51:59', '2024-07-17 01:01:23', NULL),
(2, 'tyty', 'jjljk', 'técnico_1', '2024-07-02', '10:56', '11:56', 'activo', '2024-07-07 23:56:57', '2024-07-07 23:56:57', NULL),
(3, 'tyty', 'drashttii', 'técnico_2', '2024-07-10', '11:22', '00:22', 'no_activo', '2024-07-08 00:22:38', '2024-07-08 00:22:38', NULL),
(4, 'tyty', 'drashttii', 'técnico_3', '2024-07-13', '11:38', '01:38', 'no_activo', '2024-07-08 00:38:09', '2024-07-08 00:38:09', NULL),
(5, 'tyty', 'drashttii', 'técnico_2', '2024-07-10', '11:41', '01:42', 'no_activo', '2024-07-08 00:42:29', '2024-07-08 00:42:29', NULL),
(6, 'tyty', 'yuiyui', 'técnico_2', '2024-07-26', '16:40', '17:40', 'no_activo', '2024-07-08 05:41:01', '2024-07-08 05:41:01', NULL),
(7, 'tyty', 'drashttii', 'técnico_1', '2024-07-22', '16:49', '18:49', 'no_activo', '2024-07-08 05:49:16', '2024-07-08 05:49:16', NULL),
(8, 'tyty', 'jjljk', 'técnico_1', '2024-07-18', '16:51', '18:51', 'activo', '2024-07-08 05:51:52', '2024-07-08 05:51:52', NULL),
(9, 'tyty', 'yuiyui', 'técnico_3', '2024-07-19', '16:58', '16:59', 'activo', '2024-07-08 05:58:16', '2024-07-08 05:58:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_types`
--

CREATE TABLE `customer_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo_de_client` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_pdfs`
--

CREATE TABLE `image_pdfs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `document` varchar(255) DEFAULT NULL,
  `mant_en_revisións_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mant_en_revisións`
--

CREATE TABLE `mant_en_revisións` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo_de_revisión` varchar(255) DEFAULT NULL,
  `ascensor` varchar(255) DEFAULT NULL,
  `dirección` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `supervisor` varchar(255) DEFAULT NULL,
  `técnico` varchar(255) DEFAULT NULL,
  `mes_programado` varchar(255) DEFAULT NULL,
  `fecha_de_mantenimiento` date DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fin` time DEFAULT NULL,
  `observaciónes` longtext DEFAULT NULL,
  `observaciónes_internas` longtext DEFAULT NULL,
  `solución` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mant_en_revisións`
--

INSERT INTO `mant_en_revisións` (`id`, `tipo_de_revisión`, `ascensor`, `dirección`, `provincia`, `supervisor`, `técnico`, `mes_programado`, `fecha_de_mantenimiento`, `hora_inicio`, `hora_fin`, `observaciónes`, `observaciónes_internas`, `solución`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'drashttii', 'tyty', 'vedroad gurukul 4564 fdfsd', 'huanuco', 'supervisor_2', 'técnico_2', 'mes_programado_1', '2024-05-31', '09:42:00', '09:42:00', 'yiyuiyui', 'iyuu', 'iyui', '2024-05-30 04:20:55', '2024-07-02 23:34:29', NULL),
(2, 'jjljk', 'tyty', 'Robert Robertson, 1234 NW Bobcat Lane, St. Robert, MO 65584-5678.', 'huanuco', 'supervisor_2', 'técnico_2', 'mes_programado_1', '2024-05-30', '15:48:00', '16:48:00', 'utyu', 'iuouio', 'uytu', '2024-05-30 04:48:10', '2024-07-04 23:47:20', NULL),
(3, 'drashttii', 'asdasd', 'fsdfsdf', 'arequipa', 'supervisor_2', 'técnico_1', 'mes_programado_1', '2024-07-02', '11:08:00', '01:08:00', 'fgdf', 'dfg', 'dfgdf', '2024-07-02 00:08:29', '2024-07-02 04:13:13', '2024-07-02 04:13:13'),
(4, 'isha12', 'asdasd', NULL, NULL, NULL, 'técnico_2', NULL, '2024-05-10', '10:09:00', '00:00:00', 'Ver observación', NULL, NULL, '2024-07-03 00:25:16', '2024-07-03 00:25:16', NULL),
(5, 'drashttii', 'asdasd', NULL, NULL, NULL, 'técnico_2', NULL, '2024-05-10', '10:10:00', '11:10:00', 'Ver observación', NULL, NULL, '2024-07-03 00:25:16', '2024-07-03 00:25:16', NULL),
(6, 'yuiyui', 'asdasd', NULL, NULL, NULL, 'técnico_1', NULL, '2024-05-24', '10:24:00', '11:24:00', 'Ver observación', NULL, NULL, '2024-07-03 00:25:16', '2024-07-03 00:25:16', NULL),
(7, 'jjljk', 'tyty', 'fsdfsdf', 'arequipa', 'supervisor_2', 'técnico_1', 'mes_programado_2', '2024-07-10', '00:50:00', '02:50:00', 'grt', 'ter', 'ter', '2024-07-31 05:20:47', '2024-07-31 05:20:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `marcas`
--

CREATE TABLE `marcas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marca_nombre` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `marcas`
--

INSERT INTO `marcas` (`id`, `marca_nombre`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ouio', '2024-07-05 00:37:37', '2024-07-05 00:37:37', NULL),
(2, 'dasd', '2024-07-05 00:51:36', '2024-07-05 00:51:36', NULL),
(3, 'dasd', '2024-07-05 00:51:38', '2024-07-05 00:51:38', NULL),
(4, 'bnhfghgf', '2024-07-05 00:53:18', '2024-07-05 00:53:18', NULL),
(5, 'dasdas', '2024-07-05 01:02:57', '2024-07-05 01:02:57', NULL),
(6, 'dasdas', '2024-07-05 01:02:58', '2024-07-05 01:02:58', NULL),
(7, 'dfgdfgdf', '2024-07-05 01:03:04', '2024-07-05 01:03:04', NULL),
(8, 'ertert', '2024-07-05 03:30:24', '2024-07-05 03:30:24', NULL),
(9, 'ertert', '2024-07-05 04:15:48', '2024-07-05 04:15:48', NULL),
(10, 'iyuiyu', '2024-07-05 04:20:44', '2024-07-05 04:20:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_04_22_113552_create_clientes_table', 2),
(7, '2024_04_23_091911_create_provincias_table', 3),
(8, '2024_04_23_043753_create_tipos_de_ascensors_table', 4),
(9, '2024_04_23_110551_create_ascensores_table', 5),
(10, '2024_04_23_121112_create_ascensores_table', 6),
(11, '2024_04_24_090445_create_tipos_revisión_table', 7),
(12, '2024_04_24_110426_create_cronogramas_table', 8),
(13, '2024_04_24_065934_create_repuestos_table', 9),
(14, '2024_04_29_054434_create_personals_table', 9),
(15, '2024_04_30_050019_create_usuarios_table', 10),
(16, '2024_04_30_094047_create_repuestos_table', 11),
(17, '2024_05_01_034222_create_asignar_repuestos_table', 12),
(18, '2024_04_29_055632_create_mant_en_revisións_table', 13),
(19, '2024_04_30_110633_create_contratos_table', 13),
(20, '2024_05_01_061101_create_users_table', 14),
(21, '2024_07_04_083731_create_marcas_table', 15),
(22, '2024_08_01_234705_create_customer_types_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personals`
--

CREATE TABLE `personals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `personalfoto` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `posición` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `teléfono` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personals`
--

INSERT INTO `personals` (`id`, `personalfoto`, `nombre`, `posición`, `correo`, `teléfono`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1721114741.jpg', 'isha12', 'posición_1', 'sdasd@gmail.com', '6756785686', '2024-04-29 00:37:46', '2024-07-16 01:55:41', NULL),
(2, '1714450056.jpg', 'tyty', 'posición_2', 'tyty@gmail.com', '9876543211', '2024-04-29 22:37:36', '2024-04-29 22:37:36', NULL),
(3, '1716266348.jpg', 'tyrtyt', 'posición_1', 'sdasd@gmail.com', '6756785686', '2024-05-20 23:09:08', '2024-05-20 23:09:43', '2024-05-20 23:09:43'),
(4, '1716284294.jpg', 'isha1', 'posición_1', 'isha@gmail.com', '67567856', '2024-05-21 04:07:53', '2024-07-01 01:07:31', '2024-07-01 01:07:31'),
(5, '', 'tyty', 'posición_1', 'sdasd@gmail.com', '6756785686', '2024-07-02 00:34:42', '2024-07-02 00:34:47', '2024-07-02 00:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provincias`
--

CREATE TABLE `provincias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provincias`
--

INSERT INTO `provincias` (`id`, `provincia`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'apurimac', '2024-04-23 04:08:31', '2024-05-23 06:30:43', '2024-05-23 06:30:43'),
(3, 'jjhkjh', '2024-05-20 22:42:06', '2024-05-20 22:42:10', '2024-05-20 22:42:10'),
(4, 'fsdfsdf', '2024-05-21 22:15:23', '2024-05-22 01:00:55', '2024-05-22 01:00:55'),
(5, 'ica', '2024-05-22 01:01:14', '2024-05-23 06:30:37', '2024-05-23 06:30:37'),
(6, 'ancash', '2024-05-23 01:30:43', '2024-05-23 06:23:14', '2024-05-23 06:23:14'),
(7, 'arequipa', '2024-05-23 06:31:10', '2024-07-05 06:43:07', NULL),
(8, 'ayacucho', '2024-05-23 06:31:14', '2024-05-23 22:30:06', '2024-05-23 22:30:06'),
(9, 'huancavelica', '2024-05-23 06:31:18', '2024-05-23 22:28:54', '2024-05-23 22:28:54'),
(10, 'arequipa', '2024-05-23 22:30:12', '2024-07-31 06:01:00', '2024-07-31 06:01:00'),
(11, 'huanuco', '2024-05-23 22:30:15', '2024-05-23 22:43:50', '2024-05-23 22:43:50'),
(12, 'loreto', '2024-05-23 22:44:02', '2024-05-23 22:44:05', '2024-05-23 22:44:05'),
(13, 'cajamarca', '2024-05-23 22:47:46', '2024-05-23 22:48:56', '2024-05-23 22:48:56'),
(14, 'lima', '2024-05-23 22:47:51', '2024-05-23 22:49:09', '2024-05-23 22:49:09'),
(15, 'callao', '2024-07-31 05:21:53', '2024-07-31 05:21:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `repuestos`
--

CREATE TABLE `repuestos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `foto_de_repuesto` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `precio` varchar(255) DEFAULT NULL,
  `descripción` longtext DEFAULT NULL,
  `frecuencia_de_limpieza` varchar(255) DEFAULT NULL COMMENT '(días)',
  `frecuencia_de_lubricación` varchar(255) DEFAULT NULL COMMENT '(días)',
  `frecuencia_de_ajuste` varchar(255) DEFAULT NULL COMMENT '(días)',
  `frecuencia_de_revisión` varchar(255) DEFAULT NULL COMMENT '(días)',
  `frecuencia_de_cambio` varchar(255) DEFAULT NULL COMMENT '(días)',
  `frecuencia_de_solicitud` varchar(255) DEFAULT NULL COMMENT '(días)',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `repuestos`
--

INSERT INTO `repuestos` (`id`, `foto_de_repuesto`, `nombre`, `precio`, `descripción`, `frecuencia_de_limpieza`, `frecuencia_de_lubricación`, `frecuencia_de_ajuste`, `frecuencia_de_revisión`, `frecuencia_de_cambio`, `frecuencia_de_solicitud`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1721114227.png', 'FGDFGGD', '8978', 'jhkh', '1', '0', '0', '0', '1', '0', '2024-04-30 04:57:03', '2024-07-16 06:21:32', NULL),
(2, '1719909783.jpg', 'isha12', '9887656544', 'bbgdf', '0', '1', '0', '0', '0', '0', '2024-05-22 05:26:10', '2024-07-16 06:21:13', NULL),
(4, '1722403370.jpg', 'tyty', '8978', 'sdffsd', '12', '12', '18', '24', '12', '1', '2024-07-31 05:22:50', '2024-07-31 05:22:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipos_de_ascensors`
--

CREATE TABLE `tipos_de_ascensors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_de_tipo_de_ascensor` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipos_de_ascensors`
--

INSERT INTO `tipos_de_ascensors` (`id`, `nombre_de_tipo_de_ascensor`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'hello', '2024-04-23 04:34:44', '2024-05-21 05:25:51', NULL),
(2, 'fd', '2024-04-23 05:07:17', '2024-05-29 05:42:03', '2024-05-29 05:42:03'),
(3, 'isghaaaa', '2024-04-23 05:08:25', '2024-05-29 05:38:07', '2024-05-29 05:38:07'),
(4, 'yuiyu', '2024-05-29 05:42:30', '2024-07-02 03:26:22', '2024-07-02 03:26:22'),
(5, 'iyuiyu', '2024-05-29 05:42:35', '2024-05-29 05:42:41', '2024-05-29 05:42:41'),
(6, 'xvzvzx', '2024-07-04 00:28:33', '2024-07-04 00:28:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tipos_revisión`
--

CREATE TABLE `tipos_revisión` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tipos_revisión`
--

INSERT INTO `tipos_revisión` (`id`, `nombre`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'jjljk', '2024-04-24 03:56:29', '2024-05-31 00:15:20', NULL),
(2, 'drashttii', '2024-04-24 03:58:15', '2024-05-21 00:43:24', NULL),
(3, 'jensi', '2024-04-24 03:58:16', '2024-04-24 04:03:58', '2024-04-24 04:03:58'),
(4, 'yuiyui', '2024-05-21 00:44:12', '2024-05-21 00:44:12', NULL),
(5, 'drashti', '2024-07-01 23:56:43', '2024-07-01 23:56:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL COMMENT 'fotodeusuario',
  `username` varchar(255) NOT NULL COMMENT 'nombredeusuario',
  `name` varchar(255) NOT NULL COMMENT 'nombre',
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL COMMENT 'teléfono',
  `employee` varchar(255) DEFAULT NULL COMMENT 'empleado',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL COMMENT 'contraseña',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `image`, `username`, `name`, `email`, `phone`, `employee`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1720587709.png', 'drashtipatel', 'drashti', 'drashti.kalathiyainfotech@gmail.com', '9875654745', 'isha12', '2024-05-06 03:30:51', '$2y$10$8c5ZdmDbiOVizW2Sing8Zeieifq/TdDZYx72NqHK0H0fX.ubuHaj2', 'UHDfli2xqiDIHTgPcKwPW7fscHK9j9HFsvIei0EwN6Nz60Tv3iVSFRCZJmMF', '2024-05-03 00:31:22', '2024-07-09 23:31:49', NULL),
(2, '1720158152.png', 'std1', 'Rolex', 'isha.kalathiyaiasasnfotech@gmail.com', '4546213221', 'isha12', NULL, '$2y$10$ljG4tGEe1bGebe8Xx/EwPeuQU4Zxwz1znUvDNUj2OQ/tB/408A5Qi', NULL, '2024-05-21 01:53:10', '2024-07-05 00:12:32', NULL),
(3, '1716352037.jpg', 'parent9', 'fdgfd', 'gdfgf@gmail.com', '8776756464', 'empleado_2', NULL, '$2y$10$gTY40KDShBC92QR5SVMuhejvqAe7BROAYP7tmbX/QP8aE/n.Nsq3u', NULL, '2024-05-21 22:52:42', '2024-07-01 00:22:57', '2024-07-01 00:22:57'),
(5, '1720677204.png', 'yuyt', 'uytu', 'uytuyt@gmail.com', '4546213221', 'isha12', NULL, '$2y$10$eG6wCcL0g3yF.snCao/91eqp4LFT1JsAGEhH7edTl.4mSZRbWu2cy', NULL, '2024-07-11 00:23:24', '2024-07-11 00:23:24', NULL),
(6, '', 'erter', 'terter', 'tert@gmail.com', '4546213221', NULL, NULL, '$2y$10$1V1Zj4CBTk2aPN.Oceqa8OdCesaq9u1JHFaFkorKsBjZJDNTowKPO', NULL, '2024-07-16 03:05:34', '2024-07-16 03:05:34', NULL),
(7, '', 'khjk', 'khjkjh', 'kjhz@gmail.com', '21311214', NULL, NULL, '$2y$10$y3EzSaSc/sFMiVz2iF5KtelU8YOwAtmOl1nROp.HXGt.8f7KVhU/q', NULL, '2024-07-16 03:09:39', '2024-07-16 03:09:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fotodeusuario` varchar(255) DEFAULT NULL,
  `nombredeusuario` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `teléfono` varchar(255) DEFAULT NULL,
  `empleado` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `fotodeusuario`, `nombredeusuario`, `nombre`, `correo`, `teléfono`, `empleado`, `contraseña`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1714469180.jpg', 'sdad', 'tyty', 'sdasd@gmail.com', '6756785686', 'empleado_1', '$2y$10$.xuBLViEnlw8v96qet8g/uREKDhPhcBEwBVb1G3Fl7Bs68k7kRoJ6', '2024-04-30 01:58:34', '2024-04-30 03:56:20', NULL),
(2, '1714467768.jpg', 'trt', 'trt', 'erte12@gmail.com', '6756785686', 'empleado_2', '$2y$10$I7vXtTwRe.sD2Ql.t2WOV.AY0I2r./J2QJEgMFgakeg6pHhl4hlJa', '2024-04-30 02:02:35', '2024-04-30 03:33:20', '2024-04-30 03:33:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ascensores`
--
ALTER TABLE `ascensores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `asignar_repuestos`
--
ALTER TABLE `asignar_repuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contratos`
--
ALTER TABLE `contratos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cronogramas`
--
ALTER TABLE `cronogramas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_types`
--
ALTER TABLE `customer_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `image_pdfs`
--
ALTER TABLE `image_pdfs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_pdfs_mant_en_revisións_id_foreign` (`mant_en_revisións_id`);

--
-- Indexes for table `mant_en_revisións`
--
ALTER TABLE `mant_en_revisións`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personals`
--
ALTER TABLE `personals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `repuestos`
--
ALTER TABLE `repuestos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipos_de_ascensors`
--
ALTER TABLE `tipos_de_ascensors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipos_revisión`
--
ALTER TABLE `tipos_revisión`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ascensores`
--
ALTER TABLE `ascensores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `asignar_repuestos`
--
ALTER TABLE `asignar_repuestos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cronogramas`
--
ALTER TABLE `cronogramas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer_types`
--
ALTER TABLE `customer_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_pdfs`
--
ALTER TABLE `image_pdfs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mant_en_revisións`
--
ALTER TABLE `mant_en_revisións`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `personals`
--
ALTER TABLE `personals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `repuestos`
--
ALTER TABLE `repuestos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tipos_de_ascensors`
--
ALTER TABLE `tipos_de_ascensors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tipos_revisión`
--
ALTER TABLE `tipos_revisión`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `asignar_repuestos`
--
ALTER TABLE `asignar_repuestos`
  ADD CONSTRAINT `fkey_tipo_de_id` FOREIGN KEY (`tipos_de_ascensors_id`) REFERENCES `tipos_de_ascensors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image_pdfs`
--
ALTER TABLE `image_pdfs`
  ADD CONSTRAINT `image_pdfs_mant_en_revisións_id_foreign` FOREIGN KEY (`mant_en_revisións_id`) REFERENCES `mant_en_revisións` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
