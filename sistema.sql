-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-02-2022 a las 14:18:53
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `IdCategoria` int(11) NOT NULL,
  `CategoriaNombre` varchar(200) NOT NULL,
  `CategoriaDescripcion` varchar(500) DEFAULT NULL,
  `CategoriaInsertUsu` int(11) NOT NULL,
  `CategoriaInsertFec` datetime NOT NULL,
  `CategoriaUpdateUsu` int(11) DEFAULT NULL,
  `CategoriaUpdateFec` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`IdCategoria`, `CategoriaNombre`, `CategoriaDescripcion`, `CategoriaInsertUsu`, `CategoriaInsertFec`, `CategoriaUpdateUsu`, `CategoriaUpdateFec`) VALUES
(3, 'Salado', 'Produccion salada: panes, tortillas, semoladas, etc', 1, '2022-02-14 12:58:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `IdEmpleado` int(11) NOT NULL,
  `IdRol` int(11) NOT NULL,
  `EmpleadoNombre` varchar(200) NOT NULL,
  `EmpleadoApellido` varchar(200) NOT NULL,
  `EmpleadoDNI` varchar(9) NOT NULL,
  `EmpleadoFecNac` date DEFAULT NULL,
  `EmpleadoTel` varchar(20) DEFAULT NULL,
  `EmpleadoMail` varchar(100) DEFAULT NULL,
  `EmpleadoDomicilio` varchar(300) DEFAULT NULL,
  `EmpleadoEstado` char(3) NOT NULL DEFAULT 'HAB',
  `EmpleadoInsertUsu` int(11) NOT NULL,
  `EmpleadoInsertFec` datetime NOT NULL,
  `EmpleadoUpdateUsu` int(11) DEFAULT NULL,
  `EmpleadoUpdateFec` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`IdEmpleado`, `IdRol`, `EmpleadoNombre`, `EmpleadoApellido`, `EmpleadoDNI`, `EmpleadoFecNac`, `EmpleadoTel`, `EmpleadoMail`, `EmpleadoDomicilio`, `EmpleadoEstado`, `EmpleadoInsertUsu`, `EmpleadoInsertFec`, `EmpleadoUpdateUsu`, `EmpleadoUpdateFec`) VALUES
(2, 6, 'Juan Pedro', 'Rodriguez', '26548451', '2000-04-25', '3815465894', 'juanp@gmail.com', 'Padre Rorque Correa 3000', 'HAB', 1, '2022-02-15 14:28:53', 1, '2022-02-16 00:51:26'),
(3, 2, 'Carlos', 'Gonzales', '32584689', '1997-04-08', '381846598', 'carlosg@gmail.com', 'Viamonte 2000', 'HAB', 1, '2022-02-15 14:29:44', 1, '2022-02-16 00:56:41'),
(5, 1, 'Maximiliano', 'Rivadeneira Bordón', '41384334', '1998-06-30', '3816173059', 'rivadenneira@gmail.com', 'Padre Roque Correa 2227', 'HAB', 1, '2022-02-16 00:27:42', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `IdProducto` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `IdSubCategoria` int(11) NOT NULL,
  `ProductoNombre` varchar(200) NOT NULL,
  `ProductoPrecio` varchar(200) NOT NULL,
  `ProductoInsertUsu` int(11) NOT NULL,
  `ProductoInsertFec` datetime NOT NULL,
  `ProductoUpdateUsu` int(11) DEFAULT NULL,
  `ProductoUpdateFec` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `IdRol` int(11) NOT NULL,
  `Rol` varchar(200) NOT NULL,
  `RolInsertUsu` int(11) NOT NULL,
  `RolInsertFec` datetime NOT NULL,
  `RolUpdateUsu` int(11) DEFAULT NULL,
  `RolUpdateFec` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`IdRol`, `Rol`, `RolInsertUsu`, `RolInsertFec`, `RolUpdateUsu`, `RolUpdateFec`) VALUES
(1, 'Administrador', 1, '2022-02-12 00:00:00', NULL, NULL),
(2, 'Usuario', 1, '2022-02-12 00:00:00', NULL, NULL),
(5, 'Cajero/a', 1, '2022-02-16 00:00:00', NULL, NULL),
(6, 'Repositor', 1, '2022-02-16 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `IdUsuario` int(11) NOT NULL,
  `IdRol` int(11) NOT NULL,
  `UsuarioNombre` varchar(200) NOT NULL,
  `UsuarioApellido` varchar(200) NOT NULL,
  `UsuarioUser` varchar(200) NOT NULL,
  `UsuarioClave` varchar(200) NOT NULL,
  `UsuarioInsertUsu` int(11) NOT NULL,
  `UsuarioInsertFec` datetime NOT NULL,
  `UsuarioUpdateUsu` int(11) DEFAULT NULL,
  `UsuarioUpdateFec` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`IdUsuario`, `IdRol`, `UsuarioNombre`, `UsuarioApellido`, `UsuarioUser`, `UsuarioClave`, `UsuarioInsertUsu`, `UsuarioInsertFec`, `UsuarioUpdateUsu`, `UsuarioUpdateFec`) VALUES
(1, 1, 'Maximiliano', 'Rivadeneira Bordón', 'Maxi', '$2y$12$lvcotZKdh/WVO2JG/Dq2NOZNpZtiUxmbDbmOOLn7g56QCGTgTRhlm', 1, '2022-02-12 22:25:15', 1, '2022-02-12 23:01:51');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`IdEmpleado`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`IdProducto`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`IdUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `IdEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `IdProducto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `IdRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
