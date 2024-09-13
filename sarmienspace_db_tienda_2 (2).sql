-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-09-2024 a las 20:31:39
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sarmienspace_db_tienda_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'botines', 'botines'),
(2, 'medias', 'medias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilios`
--

CREATE TABLE `domicilios` (
  `id_domicilio` int(11) NOT NULL,
  `codigo_postal` int(10) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `barrio` varchar(100) NOT NULL,
  `calle` varchar(100) NOT NULL,
  `numero` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `domicilios`
--

INSERT INTO `domicilios` (`id_domicilio`, `codigo_postal`, `provincia`, `localidad`, `barrio`, `calle`, `numero`) VALUES
(1, 5854, 'cordoba', 'alamfuerte', 'sol de mayo', 'alem ', 972),
(2, 5000, 'cordoba', 'cordoba', 'alberdi', 'chubut', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `domicilios_usuarios`
--

CREATE TABLE `domicilios_usuarios` (
  `id_info_usuario` int(11) NOT NULL,
  `id_domicilio` int(11) NOT NULL,
  `tipo_domicilio` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_pedidos`
--

CREATE TABLE `estados_pedidos` (
  `id_estado_pedido` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados_pedidos`
--

INSERT INTO `estados_pedidos` (`id_estado_pedido`, `nombre`, `descripcion`) VALUES
(1, 'Pendiente', 'PendientePendientePendientePendientePendientePendiente'),
(2, 'Procesando', 'ProcesandoProcesandoProcesandoProcesandoProcesandoProcesandoProcesandoProcesandoProcesandoProcesando'),
(3, 'Enviado', 'EnviadoEnviadoEnviadoEnviadoEnviadoEnviadoEnviadoEnviadoEnviadoEnviadoEnviado'),
(4, 'Entregado', 'EntregadoEntregadoEntregadoEntregado'),
(5, 'Cancelado', 'CanceladoCanceladoCanceladoCanceladoCanceladoCanceladoCanceladoCanceladoCancelado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_productos`
--

CREATE TABLE `estados_productos` (
  `id_estado_producto` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados_productos`
--

INSERT INTO `estados_productos` (`id_estado_producto`, `nombre`, `descripcion`) VALUES
(1, 'agotado', 'producto agotado'),
(2, 'disponible', 'producto con stock'),
(3, 'baja', 'el producto esta descontinuado o cancelado ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_usuarios`
--

CREATE TABLE `estados_usuarios` (
  `id_estado_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados_usuarios`
--

INSERT INTO `estados_usuarios` (`id_estado_usuario`, `nombre`, `descripcion`) VALUES
(1, 'Registrado', 'El usuario se registro a la pagina'),
(2, 'Logueado', 'El usuario se logueo por primera vez a la pagina '),
(3, 'comprador', 'El usuario ya hizo una compra en la web ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_destacados`
--

CREATE TABLE `historial_destacados` (
  `id_historial_destacado` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_variante` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_estados_pedidos`
--

CREATE TABLE `historial_estados_pedidos` (
  `id_historial_estado` int(11) NOT NULL,
  `id_pedido` int(11) DEFAULT NULL,
  `id_estado_usuario` int(11) DEFAULT NULL,
  `fecha_cambio` datetime DEFAULT NULL,
  `comentario` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_info_usuario`
--

CREATE TABLE `historial_info_usuario` (
  `id_historial_info` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `campo_cambiado` varchar(255) DEFAULT NULL,
  `valor_anterior` text DEFAULT NULL,
  `valor_nuevo` text DEFAULT NULL,
  `fecha_cambio` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_precios`
--

CREATE TABLE `historial_precios` (
  `id_historial` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_variante` int(11) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_stock`
--

CREATE TABLE `historial_stock` (
  `id_historial_stock` int(11) NOT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `id_variante` int(11) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `fecha_cambio` datetime DEFAULT NULL,
  `motivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id_imagen` int(11) NOT NULL,
  `id_variante` int(11) NOT NULL,
  `nombre` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_usuarios`
--

CREATE TABLE `info_usuarios` (
  `id_info_usuario` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_sexo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `info_usuarios`
--
DELIMITER $$
CREATE TRIGGER `trigger_historial_info_usuario` BEFORE UPDATE ON `info_usuarios` FOR EACH ROW BEGIN
    IF NEW.nombre <> OLD.nombre THEN
        INSERT INTO historial_info_usuario (id_usuario, campo_cambiado, valor_anterior, valor_nuevo, fecha_cambio)
        VALUES (OLD.id_usuario, 'nombre', OLD.nombre, NEW.nombre, NOW());
    END IF;

    IF NEW.apellido <> OLD.apellido THEN
        INSERT INTO historial_info_usuario (id_usuario, campo_cambiado, valor_anterior, valor_nuevo, fecha_cambio)
        VALUES (OLD.id_usuario, 'apellido', OLD.apellido, NEW.apellido, NOW());
    END IF;

    IF NEW.dni <> OLD.dni THEN
        INSERT INTO historial_info_usuario (id_usuario, campo_cambiado, valor_anterior, valor_nuevo, fecha_cambio)
        VALUES (OLD.id_usuario, 'dni', OLD.dni, NEW.dni, NOW());
    END IF;

    -- Puedes seguir añadiendo condiciones para otros campos si es necesario
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `total` int(20) NOT NULL,
  `fecha` date NOT NULL,
  `id_estado_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `total`, `fecha`, `id_estado_pedido`) VALUES
(1, 1, 255, '2024-09-10', 3),
(2, 2, 130, '2024-09-11', 2),
(3, 3, 27, '2024-09-12', 4),
(4, 4, 145, '2024-09-13', 1),
(5, 5, 75, '2024-09-14', 5),
(6, 6, 180, '2024-09-15', 2);

--
-- Disparadores `pedidos`
--
DELIMITER $$
CREATE TRIGGER `trigger_historial_estados_pedidos` BEFORE UPDATE ON `pedidos` FOR EACH ROW BEGIN
    IF NEW.estado_pedido <> OLD.estado_pedido THEN
        INSERT INTO historial_estados_pedidos (id_pedido, estado_pedido, fecha_cambio, comentario)
        VALUES (OLD.id_pedido, OLD.estado_pedido, NOW(), 'Estado de pedido cambiado');
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `nombre`, `descripcion`) VALUES
(1, 'admin', 'Permisos de administracion para poder editar la pagina'),
(2, 'usuario', 'Permiso default para un ususario solo puede ver y comprar ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `n_producto` varchar(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `n_producto`, `nombre`, `descripcion`, `id_categoria`) VALUES
(1, 'BOT001', 'Botines Adidas Predator', 'Botines de fútbol Adidas Predator, ideales para control del balón.', 1),
(2, 'BOT002', 'Botines Nike Mercurial', 'Botines de fútbol Nike Mercurial, para máxima velocidad.', 1),
(3, 'MED001', 'Medias Nike', 'Medias de fútbol Nike, para mayor comodidad y soporte.', 2),
(4, 'MED002', 'Medias Adidas', 'Medias de fútbol Adidas, transpirables y resistentes.', 2);

--
-- Disparadores `productos`
--
DELIMITER $$
CREATE TRIGGER `trigger_auditoria_productos` AFTER UPDATE ON `productos` FOR EACH ROW BEGIN
    INSERT INTO auditoria (id_usuario, operacion, tabla_afectada, fecha, descripcion)
    VALUES (USER(), 'UPDATE', 'productos', NOW(), CONCAT('Cambio en producto: ', OLD.nombre, ' a ', NEW.nombre));
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_pedido`
--

CREATE TABLE `productos_pedido` (
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos_pedido`
--

INSERT INTO `productos_pedido` (`id_compra`, `id_producto`, `id_pedido`, `cantidad`) VALUES
(1, 1, 1, 2),
(2, 3, 1, 1),
(3, 2, 2, 1),
(4, 4, 2, 2),
(5, 1, 3, 1),
(6, 3, 3, 2),
(7, 2, 4, 1),
(8, 4, 4, 1),
(9, 3, 5, 1),
(10, 4, 5, 2),
(11, 1, 6, 1),
(12, 2, 6, 1),
(13, 3, 6, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexos`
--

CREATE TABLE `sexos` (
  `id_sexo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sexos`
--

INSERT INTO `sexos` (`id_sexo`, `nombre`) VALUES
(1, 'masculino'),
(2, 'femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `talles`
--

CREATE TABLE `talles` (
  `id_talle` int(11) NOT NULL,
  `talle` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `talles`
--

INSERT INTO `talles` (`id_talle`, `talle`) VALUES
(1, 'XS'),
(2, 'S'),
(3, 'M'),
(4, 'L'),
(5, 'XL'),
(6, 'XXL'),
(7, 'XXXL'),
(8, '30'),
(9, '31'),
(10, '32'),
(11, '33'),
(12, '34'),
(13, '35'),
(14, '36'),
(15, '37'),
(16, '38'),
(17, '39'),
(18, '40'),
(19, '41'),
(20, '42'),
(21, '43'),
(22, '44'),
(23, '45'),
(24, '46'),
(25, '47'),
(26, '48'),
(27, '49'),
(28, '50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonios`
--

CREATE TABLE `testimonios` (
  `id_testimonio` int(11) NOT NULL,
  `usuario_testimonio` varchar(100) NOT NULL,
  `descripcion_testimonio` varchar(255) NOT NULL,
  `estrellas_testimonio` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `testimonios`
--

INSERT INTO `testimonios` (`id_testimonio`, `usuario_testimonio`, `descripcion_testimonio`, `estrellas_testimonio`) VALUES
(1, 'carlos', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut a', 1),
(2, 'maria', 'Lorem ipsum odor amet, consectetuer adipiscing elit. Ut eget metus fusce mollis commodo est condimentum ac.', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL DEFAULT 2,
  `id_estado_usuario` int(11) NOT NULL DEFAULT 1,
  `email` varchar(100) NOT NULL,
  `clave` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `id_permiso`, `id_estado_usuario`, `email`, `clave`) VALUES
(1, 1, 1, 'juani@1.com', '123456'),
(2, 2, 1, 'juan.perez@example.com', 'claveSegura123'),
(3, 2, 1, 'maria.garcia@example.com', 'miClave456'),
(4, 2, 1, 'luis.martinez@example.com', 'password789'),
(5, 2, 1, 'ana.rodriguez@example.com', 'contrasenaABC'),
(6, 2, 1, 'pedro.lopez@example.com', 'clave1234'),
(7, 2, 1, 'juanimelillo@gmail.com', '$2y$10$wOhDU0SNQViaMu5LRJIi6.sB4y2qSpvQnJXH7BIjxyKlWGK8ejMz6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variantes`
--

CREATE TABLE `variantes` (
  `id_variante` int(11) NOT NULL,
  `color` varchar(100) NOT NULL,
  `id_talle` int(11) NOT NULL,
  `precio` float(10,2) NOT NULL,
  `descuento` int(11) NOT NULL DEFAULT 0,
  `destacado` tinyint(1) NOT NULL DEFAULT 0,
  `stock` int(11) NOT NULL DEFAULT 0,
  `id_estado_producto` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `variantes`
--

INSERT INTO `variantes` (`id_variante`, `color`, `id_talle`, `precio`, `descuento`, `destacado`, `stock`, `id_estado_producto`) VALUES
(7, 'Rojo', 1, 15.99, 0, 0, 0, 1),
(8, 'Rojo', 2, 17.99, 0, 0, 0, 1),
(9, 'Rojo', 3, 19.99, 0, 0, 0, 2),
(10, 'Rojo', 4, 21.99, 0, 0, 0, 2),
(11, 'Rojo', 5, 23.99, 0, 0, 0, 3),
(12, 'Rojo', 6, 25.99, 0, 0, 0, 3),
(13, 'Rojo', 7, 27.99, 0, 0, 0, 1),
(14, 'Rojo', 1, 15.99, 0, 0, 0, 1),
(15, 'Rojo', 2, 17.99, 0, 0, 0, 1),
(16, 'Rojo', 3, 19.99, 0, 0, 0, 2),
(17, 'Rojo', 4, 21.99, 0, 0, 0, 2),
(18, 'Rojo', 5, 23.99, 0, 0, 0, 3),
(19, 'Rojo', 6, 25.99, 0, 0, 0, 3),
(20, 'Rojo', 7, 27.99, 0, 0, 0, 1),
(21, 'Azul', 8, 22.50, 0, 0, 0, 1),
(22, 'Azul', 9, 24.50, 0, 0, 0, 1),
(23, 'Azul', 10, 26.50, 0, 0, 0, 2),
(24, 'Azul', 11, 28.50, 0, 0, 0, 2),
(25, 'Azul', 12, 30.50, 0, 0, 0, 3),
(26, 'Azul', 13, 32.50, 0, 0, 0, 3),
(27, 'Azul', 14, 34.50, 0, 0, 0, 1),
(28, 'Azul', 15, 36.50, 0, 0, 0, 1),
(29, 'Azul', 16, 38.50, 0, 0, 0, 2),
(30, 'Azul', 17, 40.50, 0, 0, 0, 2),
(31, 'Azul', 18, 42.50, 0, 0, 0, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `variante_producto`
--

CREATE TABLE `variante_producto` (
  `id_variante` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `variante_producto`
--

INSERT INTO `variante_producto` (`id_variante`, `id_producto`) VALUES
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(7, 3),
(8, 3),
(9, 3),
(10, 3),
(11, 3),
(12, 3),
(13, 3),
(14, 3),
(15, 3),
(16, 3),
(17, 3),
(18, 3),
(19, 3),
(20, 3),
(21, 3),
(22, 3),
(23, 3),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(7, 4),
(8, 4),
(9, 4),
(10, 4),
(11, 4),
(12, 4),
(13, 4),
(14, 4),
(15, 4),
(16, 4),
(17, 4),
(18, 4),
(19, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(25, 4),
(26, 4),
(27, 4),
(28, 4),
(29, 4),
(30, 4),
(31, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `domicilios`
--
ALTER TABLE `domicilios`
  ADD PRIMARY KEY (`id_domicilio`);

--
-- Indices de la tabla `domicilios_usuarios`
--
ALTER TABLE `domicilios_usuarios`
  ADD KEY `FK__INFO_USUARIO` (`id_info_usuario`),
  ADD KEY `FK_DOMICILIO` (`id_domicilio`);

--
-- Indices de la tabla `estados_pedidos`
--
ALTER TABLE `estados_pedidos`
  ADD PRIMARY KEY (`id_estado_pedido`);

--
-- Indices de la tabla `estados_productos`
--
ALTER TABLE `estados_productos`
  ADD PRIMARY KEY (`id_estado_producto`);

--
-- Indices de la tabla `estados_usuarios`
--
ALTER TABLE `estados_usuarios`
  ADD PRIMARY KEY (`id_estado_usuario`);

--
-- Indices de la tabla `historial_destacados`
--
ALTER TABLE `historial_destacados`
  ADD PRIMARY KEY (`id_historial_destacado`);

--
-- Indices de la tabla `historial_estados_pedidos`
--
ALTER TABLE `historial_estados_pedidos`
  ADD PRIMARY KEY (`id_historial_estado`);

--
-- Indices de la tabla `historial_info_usuario`
--
ALTER TABLE `historial_info_usuario`
  ADD PRIMARY KEY (`id_historial_info`);

--
-- Indices de la tabla `historial_precios`
--
ALTER TABLE `historial_precios`
  ADD PRIMARY KEY (`id_historial`);

--
-- Indices de la tabla `historial_stock`
--
ALTER TABLE `historial_stock`
  ADD PRIMARY KEY (`id_historial_stock`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id_imagen`),
  ADD KEY `FK_VARIANTE` (`id_variante`);

--
-- Indices de la tabla `info_usuarios`
--
ALTER TABLE `info_usuarios`
  ADD PRIMARY KEY (`id_info_usuario`),
  ADD KEY `FK_SEXO` (`id_sexo`),
  ADD KEY `FK_USUARIO` (`id_usuario`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `FK__USUARIOS_PEDIDOS` (`id_usuario`),
  ADD KEY `FK__PEDIDO_ESTADO__END` (`id_estado_pedido`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `FK__PRODUCTOS__CATEGORIAS__END` (`id_categoria`);

--
-- Indices de la tabla `productos_pedido`
--
ALTER TABLE `productos_pedido`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `FK__PRODUCTO` (`id_producto`),
  ADD KEY `FK__PEDIDO` (`id_pedido`);

--
-- Indices de la tabla `sexos`
--
ALTER TABLE `sexos`
  ADD PRIMARY KEY (`id_sexo`);

--
-- Indices de la tabla `talles`
--
ALTER TABLE `talles`
  ADD PRIMARY KEY (`id_talle`);

--
-- Indices de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  ADD PRIMARY KEY (`id_testimonio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `FK_PERMISOS` (`id_permiso`),
  ADD KEY `FK__ESTADO_USUARIO` (`id_estado_usuario`);

--
-- Indices de la tabla `variantes`
--
ALTER TABLE `variantes`
  ADD PRIMARY KEY (`id_variante`),
  ADD KEY `FK__VARIANTE_TALLE__END` (`id_talle`),
  ADD KEY `FK__VARIANTE__ESTADO_PRODUCTO__END` (`id_estado_producto`);

--
-- Indices de la tabla `variante_producto`
--
ALTER TABLE `variante_producto`
  ADD KEY `FK__VARIANTE__END` (`id_variante`),
  ADD KEY `FK__PRODUCTO__END` (`id_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `domicilios`
--
ALTER TABLE `domicilios`
  MODIFY `id_domicilio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estados_pedidos`
--
ALTER TABLE `estados_pedidos`
  MODIFY `id_estado_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estados_productos`
--
ALTER TABLE `estados_productos`
  MODIFY `id_estado_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estados_usuarios`
--
ALTER TABLE `estados_usuarios`
  MODIFY `id_estado_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `historial_destacados`
--
ALTER TABLE `historial_destacados`
  MODIFY `id_historial_destacado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_estados_pedidos`
--
ALTER TABLE `historial_estados_pedidos`
  MODIFY `id_historial_estado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_info_usuario`
--
ALTER TABLE `historial_info_usuario`
  MODIFY `id_historial_info` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_precios`
--
ALTER TABLE `historial_precios`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_stock`
--
ALTER TABLE `historial_stock`
  MODIFY `id_historial_stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `info_usuarios`
--
ALTER TABLE `info_usuarios`
  MODIFY `id_info_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `productos_pedido`
--
ALTER TABLE `productos_pedido`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `sexos`
--
ALTER TABLE `sexos`
  MODIFY `id_sexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `talles`
--
ALTER TABLE `talles`
  MODIFY `id_talle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  MODIFY `id_testimonio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `variantes`
--
ALTER TABLE `variantes`
  MODIFY `id_variante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `domicilios_usuarios`
--
ALTER TABLE `domicilios_usuarios`
  ADD CONSTRAINT `FK_DOMICILIO` FOREIGN KEY (`id_domicilio`) REFERENCES `domicilios` (`id_domicilio`),
  ADD CONSTRAINT `FK__INFO_USUARIO` FOREIGN KEY (`id_info_usuario`) REFERENCES `info_usuarios` (`id_info_usuario`);

--
-- Filtros para la tabla `historial_destacados`
--
ALTER TABLE `historial_destacados`
  ADD CONSTRAINT `FK__HISTORIAL_DESTACADO_PRODUCTO__END` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `FK__HISTORIAL_DESTACADO_VARIANTES__END` FOREIGN KEY (`id_variante`) REFERENCES `variantes` (`id_variante`);

--
-- Filtros para la tabla `historial_estados_pedidos`
--
ALTER TABLE `historial_estados_pedidos`
  ADD CONSTRAINT `FK__HISTORIAL_ESTADO__ESTADO_USUARIO__END` FOREIGN KEY (`id_estado_usuario`) REFERENCES `estados_usuarios` (`id_estado_usuario`),
  ADD CONSTRAINT `FK__HISTORIAL_ESTADO__PEDIDOS_END` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`);

--
-- Filtros para la tabla `historial_info_usuario`
--
ALTER TABLE `historial_info_usuario`
  ADD CONSTRAINT `FK__HISTORIAL_INFO_USUARIO_USUARIO__END` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `historial_precios`
--
ALTER TABLE `historial_precios`
  ADD CONSTRAINT `FK__HISTORIAL_PRECIO_VARIANTE` FOREIGN KEY (`id_variante`) REFERENCES `variantes` (`id_variante`),
  ADD CONSTRAINT `FK__HISTORIAL_PRECIO__PRODUCTO` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `historial_stock`
--
ALTER TABLE `historial_stock`
  ADD CONSTRAINT `FK__HISTORIAL_STOCK_PRODUCTO__END` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `FK__HISTORIAL_STOCK_VARIANTE__END` FOREIGN KEY (`id_variante`) REFERENCES `variantes` (`id_variante`);

--
-- Filtros para la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD CONSTRAINT `FK_VARIANTE` FOREIGN KEY (`id_variante`) REFERENCES `variantes` (`id_variante`);

--
-- Filtros para la tabla `info_usuarios`
--
ALTER TABLE `info_usuarios`
  ADD CONSTRAINT `FK_SEXO` FOREIGN KEY (`id_sexo`) REFERENCES `sexos` (`id_sexo`),
  ADD CONSTRAINT `FK_USUARIO` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `FK__PEDIDO_ESTADO__END` FOREIGN KEY (`id_estado_pedido`) REFERENCES `estados_pedidos` (`id_estado_pedido`),
  ADD CONSTRAINT `FK__USUARIOS_PEDIDOS` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK__PRODUCTOS__CATEGORIAS__END` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `productos_pedido`
--
ALTER TABLE `productos_pedido`
  ADD CONSTRAINT `FK__PEDIDO` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `FK__PRODUCTO` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `FK_PERMISOS` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id_permiso`),
  ADD CONSTRAINT `FK__ESTADO_USUARIO` FOREIGN KEY (`id_estado_usuario`) REFERENCES `estados_usuarios` (`id_estado_usuario`);

--
-- Filtros para la tabla `variantes`
--
ALTER TABLE `variantes`
  ADD CONSTRAINT `FK__VARIANTE_TALLE__END` FOREIGN KEY (`id_talle`) REFERENCES `talles` (`id_talle`),
  ADD CONSTRAINT `FK__VARIANTE__ESTADO_PRODUCTO__END` FOREIGN KEY (`id_estado_producto`) REFERENCES `estados_productos` (`id_estado_producto`);

--
-- Filtros para la tabla `variante_producto`
--
ALTER TABLE `variante_producto`
  ADD CONSTRAINT `FK__PRODUCTO__END` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `FK__VARIANTE__END` FOREIGN KEY (`id_variante`) REFERENCES `variantes` (`id_variante`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
