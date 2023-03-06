-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 06-Mar-2023 às 12:26
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `desafio_al2021023`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `Artigo`
--

CREATE TABLE `Artigo` (
  `ID` int(50) NOT NULL,
  `IdDono` int(50) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Valor` int(50) NOT NULL,
  `Descrição` varchar(255) NOT NULL,
  `Img` varchar(255) NOT NULL,
  `AltImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `Artigo`
--

INSERT INTO `Artigo` (`ID`, `IdDono`, `Nome`, `Valor`, `Descrição`, `Img`, `AltImg`) VALUES
(6, 1, 'Saxo', 0, 'Já é velho', '/www/PHP_Projeto/img/6403a1d9a3d21-saxo.png', 'SAXO'),
(7, 1, 'Gtr', 0, 'Carro', '/www/PHP_Projeto/img/6405059101444-gtr.png', 'gtr'),
(8, 2, 'Renault Clio', 120000, 'ads', '/www/PHP_Projeto/img/6405b8c974ac5-kona.png', 'ads');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Destaque`
--

CREATE TABLE `Destaque` (
  `Id` int(50) NOT NULL,
  `Destaque` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `Destaque`
--

INSERT INTO `Destaque` (`Id`, `Destaque`) VALUES
(2, 7),
(3, 6),
(7, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `Galeria`
--

CREATE TABLE `Galeria` (
  `IdArtigo` int(11) NOT NULL,
  `Img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Mensagens`
--

CREATE TABLE `Mensagens` (
  `Id` int(12) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Assunto` varchar(255) NOT NULL,
  `Mensagem` varchar(255) NOT NULL,
  `Data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `Mensagens`
--

INSERT INTO `Mensagens` (`Id`, `Nome`, `Email`, `Assunto`, `Mensagem`, `Data`) VALUES
(1, 'asd', 'asd@asd', 'asd', 'asd', '2023-03-06 01:33:03'),
(2, 'asdasd', 'asd@asd', 'asd', 'asd', '2023-03-06 08:54:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Tipo`
--

CREATE TABLE `Tipo` (
  `Nivel` int(3) NOT NULL,
  `Nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `Tipo`
--

INSERT INTO `Tipo` (`Nivel`, `Nome`) VALUES
(1, 'Normal'),
(2, 'Admin'),
(3, 'Dono');

-- --------------------------------------------------------

--
-- Estrutura da tabela `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Nivel` int(3) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `User`
--

INSERT INTO `User` (`id`, `username`, `password`, `email`, `create_at`, `Nivel`) VALUES
(1, 'Tiago', '$2y$10$y7UnIF8uLr6iskkaIil2QuwtJUOoRTl.CZqjaXQFnT1lhBHBtMqnu', 'ggtiago0santos@gmail.com', '2023-03-01 23:26:37', 3),
(2, 'teste', '$2y$10$KkKb94/sRhaeR8kImtrC4..hp110nWp0vXDXSLcSFRUZ7NN6YaME6', 'as@gmail.com', '2023-03-02 23:16:39', 2),
(3, 'romulosilva', '$2y$10$DXfIwcyoFAJOnAx20aV.Zu8bDyFbuNnGmndnCW0/BiifoFsox0Qi6', 'al2021022@epcc.pt', '2023-03-03 10:26:28', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `Artigo`
--
ALTER TABLE `Artigo`
  ADD PRIMARY KEY (`ID`);

--
-- Índices para tabela `Destaque`
--
ALTER TABLE `Destaque`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `Galeria`
--
ALTER TABLE `Galeria`
  ADD PRIMARY KEY (`IdArtigo`);

--
-- Índices para tabela `Mensagens`
--
ALTER TABLE `Mensagens`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Artigo`
--
ALTER TABLE `Artigo`
  MODIFY `ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `Destaque`
--
ALTER TABLE `Destaque`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `Mensagens`
--
ALTER TABLE `Mensagens`
  MODIFY `Id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `User`
--
ALTER TABLE `User`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
