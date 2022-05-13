-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-05-2022 a las 12:58:07
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `eduhacks`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(69, '1231'),
(67, 'Basica'),
(65, 'Crypto'),
(68, 'Esteganografia'),
(62, 'Web');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catretos`
--

CREATE TABLE `catretos` (
  `idretos` int(11) NOT NULL,
  `idcategorias` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `catretos`
--

INSERT INTO `catretos` (`idretos`, `idcategorias`) VALUES
(45, 62),
(46, 65),
(47, 65),
(48, 67),
(49, 68),
(52, 62);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `completado`
--

CREATE TABLE `completado` (
  `iduser` int(11) NOT NULL,
  `idreto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `completado`
--

INSERT INTO `completado` (`iduser`, `idreto`) VALUES
(44, 45),
(43, 49),
(43, 46),
(45, 45),
(45, 48),
(45, 49),
(47, 49),
(43, 47),
(51, 48);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `retos`
--

CREATE TABLE `retos` (
  `idreto` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `puntos` int(11) DEFAULT NULL,
  `flag` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `iduser` int(11) DEFAULT NULL,
  `nombreoriginal` varchar(25) NOT NULL,
  `path` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `retos`
--

INSERT INTO `retos` (`idreto`, `titulo`, `descripcion`, `puntos`, `flag`, `fecha`, `iduser`, `nombreoriginal`, `path`) VALUES
(45, 'Guardar contraseña', 'Tenemos tantas contraseñas que recordar, que muchas veces aceptamos que el navegador la guarde por nosotros. Esto es de mucha utilidad cuando no nos acordamos de ella, pero también puede provocar que cualquier recupere la contraseña y acceda a nuestr', 10, 'passwordhr1234', '2022-05-13', 43, 'link.txt', '\\uploadslink.txt'),
(46, 'Descifra la contraseña', 'Adivina la contraseña encriptada! Pista: Esta encriptada en SHA-1.', 10, 'macarrones', '2022-05-13', 45, 'Contraseña.txt', '\\uploadsContraseña.txt'),
(47, 'Mi contraseña está encriptada!', 'Hola, un hacker me ha encriptado la contraseña del messenger, me ayudas a desencriptar mi contraseña? Yo solo no puedo. Pista: El hacker me la ha encriptado en MD5', 10, 'imdumb', '2022-05-13', 45, 'Contraseña.txt', '\\uploadsContraseña.txt'),
(48, 'Hash', 'La contraseña para superar este reto es LearnTheHashFunction. Tendrás que calcular su hash md5 y ponerla en el formato de la plataforma, esto es: md5', 10, 'b2f2d6b27b264d83fe1abe0169b7613e', '2022-05-13', 43, '', '\\uploads'),
(49, 'Foto sospechosa', 'Diria que hay algo en esta foto. Sabrias decirme el que?', 10, 'kbonito', '2022-05-13', 44, 'imagenbonita.png', '\\uploadsimagenbonita.png'),
(52, 'Taladro', 'Ruido', 10, '123', '2022-05-13', 51, 'Pràctica 9 - OwnCloud (1)', '\\uploadsPràctica 9 - OwnC');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `username` varchar(16) NOT NULL,
  `passHash` varchar(60) NOT NULL,
  `userFirstName` varchar(120) NOT NULL,
  `userLastName` varchar(60) NOT NULL,
  `creationDate` datetime NOT NULL,
  `removeDate` datetime DEFAULT NULL,
  `lastSignIn` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `code` varchar(60) DEFAULT NULL,
  `expiryDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`iduser`, `mail`, `username`, `passHash`, `userFirstName`, `userLastName`, `creationDate`, `removeDate`, `lastSignIn`, `active`, `code`, `expiryDate`) VALUES
(43, 'ahnuarramirez@gmail.com', 'Ahnuar', '$2y$10$AlNmNZvUwmll4Iqd76z.CeV/hV823Byc0rpA5XSxz76KI4xKhgROe', 'Ahnuar', 'Ramirez', '2022-05-13 08:44:23', NULL, '2022-05-13 10:53:26', 1, '$2y$10$awE5A3S8266IabumG/79jOlKQ85Rg2252e/HLvU5MUGb4KixLwSN.', '2022-05-13 08:44:23'),
(44, 'josepmp02@gmail.com', 'josepe', '$2y$10$/wv8GP0GCkItQqH.9kaE8u1JgvY72qKEU22.PfRkz8Cyu52WyH5ji', 'Josep', 'El beta tester', '2022-05-13 09:35:22', NULL, '2022-05-13 09:25:33', 1, '$2y$10$yuI4r8WpITwtugowaVMHaeXLKri5VOHF6Qik/w1hvp5aX48iyhyCC', '2022-05-13 09:35:22'),
(45, 'manelmayoralcano7@gmail.com', 'Manel', '$2y$10$RTPARi8dJAsUSfxorcbqSuneMYTmXZdp/JhPbLW.s5frQQBN9tC0a', 'Manel', 'Mayoral', '2022-05-13 09:35:52', NULL, '2022-05-13 12:07:08', 1, '$2y$10$vg6hKh8UnitecmzVqF5POeEnA7.hllV3IA.HAPiQGrzMfFsf0iyHm', '2022-05-13 09:35:52'),
(47, 'maya.reyesg21@gmail.com', 'PiraYam', '$2y$10$ysznjgJknbklQi5u5HrkDu7dGp/PlxwZipFHmgVCkUb9QAgdsAOh2', 'Maya', 'Reyes', '2022-05-13 10:05:33', NULL, '2022-05-13 09:50:32', 1, '$2y$10$gVCD9smJjXnLZH1lMD5Uoe5ElLQFr/TXs6YdZqm/mK/8NK07cU3Fu', '2022-05-13 10:05:33'),
(50, 'jodosid340@dakcans.com', '12312', '$2y$10$I0TNaEVaOvtIXBZevNDkQecZQjJ.Mdw5w4vh4uLU6phZOKnkaJz9C', '12312', '12312', '2022-05-13 12:24:44', NULL, NULL, 1, '$2y$10$Zht2KKG3jzg/ts.AcUu1qOQFtm0kUEgMHk.7iCilvlywRHeBpMzIy', '2022-05-13 12:24:44'),
(51, 'teyeji7813@duetube.com', 'Pepe', '$2y$10$hYbuuGFnvvkWJo5HDggwaepg.1BZba9plUWJXkynkGz0RP3NyZU86', 'Pepe', 'Ramirez', '2022-05-13 12:28:35', NULL, '2022-05-13 11:59:16', 1, '$2y$10$JZ9V0HHF0Ayym.bGH9ktWOjYhjYoFRHNA..BAE6VGBJ5SqtpGaa.K', '2022-05-13 12:28:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `catretos`
--
ALTER TABLE `catretos`
  ADD KEY `idcategorias` (`idcategorias`),
  ADD KEY `idretos` (`idretos`);

--
-- Indices de la tabla `completado`
--
ALTER TABLE `completado`
  ADD KEY `iduser` (`iduser`),
  ADD KEY `idreto` (`idreto`);

--
-- Indices de la tabla `retos`
--
ALTER TABLE `retos`
  ADD PRIMARY KEY (`idreto`),
  ADD KEY `iduser` (`iduser`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de la tabla `retos`
--
ALTER TABLE `retos`
  MODIFY `idreto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `catretos`
--
ALTER TABLE `catretos`
  ADD CONSTRAINT `catretos_ibfk_1` FOREIGN KEY (`idcategorias`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `catretos_ibfk_2` FOREIGN KEY (`idretos`) REFERENCES `retos` (`idreto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `completado`
--
ALTER TABLE `completado`
  ADD CONSTRAINT `completado_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `completado_ibfk_2` FOREIGN KEY (`idreto`) REFERENCES `retos` (`idreto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `retos`
--
ALTER TABLE `retos`
  ADD CONSTRAINT `retos_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
