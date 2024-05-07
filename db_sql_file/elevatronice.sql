-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 06:24 AM
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

INSERT INTO `ascensores` (`id`, `imagen`, `contrato`, `nombre`, `código`, `marca`, `cliente`, `fecha`, `garantizar`, `dirección`, `ubigeo`, `provincia`, `técnico_instalador`, `técnico_ajustador`, `tipo_de_ascensor`, `cantidad`, `mgratuito`, `sincuarto`, `concuarto`, `npisos`, `ncontacto`, `teléfono`, `correo`, `descripcion1`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1713939118.jpg', 'asdad', 'asdasd', 'asdasd', 'sadasd', 'qwe', '2024-04-24', 'asdasd', 'dasdas', 'dasdas', 'jjhkjh', 'tecnico_1', 'tecnico_2', 'tipo_1', 'cantidad_1', NULL, NULL, NULL, 'asdas', '321457457', '57575455', 'sdasd', 'sadasds', '2024-04-23 23:21:00', '2024-04-24 04:11:49', NULL),
(2, '1713939118.jpg', 'asdads', 'dasdas', 'asdasd', 'sadasd', 'tyty', '2024-04-25', 'dasd', 'dasd', 'dasdas', 'arequipa', 'tecnico_2', 'tecnico_2', 'tipo_1', 'cantidad_2', NULL, NULL, NULL, 'dasdasd', '9876453', '67867867', '86788', 'hjghjghjghjgh', '2024-04-23 23:31:49', '2024-04-24 01:28:31', '2024-04-24 01:28:31');

-- --------------------------------------------------------

--
-- Table structure for table `asignar_repuestos`
--

CREATE TABLE `asignar_repuestos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_del_tipo_de_ascensor` varchar(255) DEFAULT NULL,
  `reemplazo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asignar_repuestos`
--

INSERT INTO `asignar_repuestos` (`id`, `nombre_del_tipo_de_ascensor`, `reemplazo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ererw', 'khhjk', '2024-04-30 23:05:23', '2024-04-30 23:05:23', NULL);

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
(1, 'qwe', 'person1', 'fdsfd', 'perú', 'lima', 'fsdfsdf', '6756785686', '567867876867', 'admin@gmail.com', '7645654645', 'fggdfgdf', '2024-04-22 23:22:16', '2024-04-22 23:22:16', NULL),
(2, 'isha12', 'person2', '12302121', 'chile', 'arequipa', 'vedroad gurukul 4564', '67567887878', '5678678768876', 'isha1@gmail.com', '764565465', 'laravel123', '2024-04-22 23:35:31', '2024-04-23 01:16:06', '2024-04-23 01:16:06'),
(3, 'tyty', 'person2', '12305', 'perú', 'arequipa', 'fsdfsdf', '6756785686', '567867876867', 'fefsdfsd@gmail.com', '7645654645', 'fggdfgdf', '2024-04-23 03:41:00', '2024-04-23 03:41:00', NULL);

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
(1, 'fdgdg', '2024-05-01', '122', '122', '2024-05-01', '2024-05-01', 'on', 'yguy', 'ytuy', 'uytu', 'utyuy', '2024-05-01 05:21:10', '2024-05-01 05:43:19', '2024-05-01 05:43:19'),
(2, 'idhdfh', '2024-05-01', '122', '122', '2024-05-02', '2024-05-10', 'on', 'hhfghfg', 'hfghfg', 'fghfg', 'hfgh', '2024-05-01 05:24:31', '2024-05-01 05:42:40', '2024-05-01 05:42:40'),
(3, 'fdgdg', '2024-05-01', '122', '122', '2024-05-02', '2024-05-09', 'on', 'hhfghfg', 'hghg', 'fghg', 'inactiva', '2024-05-01 05:28:32', '2024-05-01 05:42:29', '2024-05-01 05:42:29'),
(4, 'idhdfh', '2024-05-01', '122', '122', '2024-05-01', '2024-05-02', 'on', 'hhfghfg', 'hgh', 'fghfg', 'inactivo', '2024-05-01 05:43:41', '2024-05-01 05:43:41', NULL),
(5, 'idhdfh', '2024-05-16', '122', '122', '2024-05-16', '2024-05-16', 'on', 'hhfghfg', 'ghj', 'hgjh', 'activo', '2024-05-01 05:45:33', '2024-05-01 05:45:33', NULL),
(6, 'fdgg', '2024-05-03', '120', '120', '2024-05-03', '2024-05-03', 'on', '120', 'hjj', 'jhk', 'inactivo', '2024-05-01 05:48:34', '2024-05-01 05:48:34', NULL),
(7, 'sdfsdf', '2024-05-05', '120', '128', '2024-05-05', '2024-05-05', 'on', 'ishaaa', 'ghfg', 'fghfg', 'activo', '2024-05-01 05:49:05', '2024-05-01 06:09:42', '2024-05-01 06:09:42');

-- --------------------------------------------------------

--
-- Table structure for table `cronogramas`
--

CREATE TABLE `cronogramas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ascensor` varchar(255) DEFAULT NULL,
  `revisar` varchar(255) DEFAULT NULL,
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

INSERT INTO `cronogramas` (`id`, `ascensor`, `revisar`, `mantenimiento`, `hora_de_inicio`, `hora_de_finalización`, `estado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'asdasd', 'isha12', '2024-04-29', '10:19', '16:59', 'no_activo', '2024-04-28 23:19:45', '2024-05-06 05:58:17', NULL),
(2, 'fghfghgfhgf', 'isha12', '2024-04-27', '10:26', '00:24', 'activo', '2024-04-28 23:24:17', '2024-04-28 23:24:17', NULL);

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
-- Table structure for table `mant_en_revisións`
--

CREATE TABLE `mant_en_revisións` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tipo_de_revisión` varchar(255) DEFAULT NULL,
  `ascensor` varchar(255) DEFAULT NULL,
  `dirección` varchar(255) DEFAULT NULL,
  `provincia` varchar(255) DEFAULT NULL,
  `núm_certificado` varchar(255) DEFAULT NULL,
  `máquina` varchar(255) DEFAULT NULL,
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

INSERT INTO `mant_en_revisións` (`id`, `tipo_de_revisión`, `ascensor`, `dirección`, `provincia`, `núm_certificado`, `máquina`, `supervisor`, `técnico`, `mes_programado`, `fecha_de_mantenimiento`, `hora_inicio`, `hora_fin`, `observaciónes`, `observaciónes_internas`, `solución`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'isha12', 'asdasd', 'fsdfsdf', 'jjhkjh', '12', '12', 'supervisor_1', 'técnico_1', 'mes_programado_2', '2024-05-01', '14:27:00', '15:28:00', 'fghfg', 'fghh', 'fghg', '2024-05-01 03:28:52', '2024-05-01 03:28:52', NULL),
(2, 'isha12', 'asdasd', 'fsdfsdf', 'jjhkjh', '12', '12', 'supervisor_1', 'técnico_1', 'mes_programado_2', '2024-05-01', '14:27:00', '15:28:00', 'fghfg', 'fghh', 'fghg', '2024-05-01 03:28:52', '2024-05-01 03:28:52', NULL);

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
(20, '2024_05_01_061101_create_users_table', 14);

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
(1, '1714370866.jpg', 'isha', 'posición_1', 'sdasd', '6756785686', '2024-04-29 00:37:46', '2024-04-29 01:29:26', NULL),
(2, '1714450056.jpg', 'tyty', 'posición_2', 'tyty@gmail.com', '9876543211', '2024-04-29 22:37:36', '2024-04-29 22:37:36', NULL);

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
(1, 'jjhkjh', '2024-04-23 04:08:31', '2024-04-23 04:08:31', NULL);

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
(1, '1714475237.jpg', 'khhjk', 'fdfgdf', 'jhkh', '13', '12', '18', '24', '12', '42', '2024-04-30 04:57:03', '2024-04-30 05:37:26', NULL);

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
(1, 'xvzvzx', '2024-04-23 04:34:44', '2024-04-23 04:34:44', NULL),
(2, 'fd', '2024-04-23 05:07:17', '2024-04-23 05:07:17', NULL),
(3, 'isghaaaa', '2024-04-23 05:08:25', '2024-04-23 05:28:07', NULL);

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
(1, 'isha12', '2024-04-24 03:56:29', '2024-04-24 03:56:29', NULL),
(2, 'drashttii', '2024-04-24 03:58:15', '2024-04-24 03:58:15', NULL),
(3, 'jensi', '2024-04-24 03:58:16', '2024-04-24 04:03:58', '2024-04-24 04:03:58');

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
  `employee` varchar(255) NOT NULL COMMENT 'empleado',
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
(1, '1714716082.jpg', 'drashtipatel', 'drashti', 'drashti.kalathiyainfotech@gmail.com', '9875654745', 'empleado_1', '2024-05-06 03:30:51', '$2y$10$osifzgu1HvNQhW5xQyUJaOzBxptiFLnN9vnNZo4Y5/zGAOxi2o4ji', 'qKxPawOKWRbKM5EZwcUhkIZp8jSkiSpNoKMlssz9', '2024-05-03 00:31:22', '2024-05-06 03:39:52', NULL);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `mant_en_revisións`
--
ALTER TABLE `mant_en_revisións`
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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `asignar_repuestos`
--
ALTER TABLE `asignar_repuestos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contratos`
--
ALTER TABLE `contratos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cronogramas`
--
ALTER TABLE `cronogramas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mant_en_revisións`
--
ALTER TABLE `mant_en_revisións`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personals`
--
ALTER TABLE `personals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `repuestos`
--
ALTER TABLE `repuestos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tipos_de_ascensors`
--
ALTER TABLE `tipos_de_ascensors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tipos_revisión`
--
ALTER TABLE `tipos_revisión`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
