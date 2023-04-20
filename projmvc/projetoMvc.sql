-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 21-Abr-2023 às 01:28
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
-- Banco de dados: `projeto_mvc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `associacoes`
--

CREATE TABLE `associacoes` (
  `assoc_id` int(11) NOT NULL,
  `assoc_nome` varchar(80) NOT NULL,
  `assoc_morada` varchar(100) NOT NULL,
  `assoc_numContribuinte` varchar(9) NOT NULL,
  `assoc_quotas_preco` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `associacoes`
--

INSERT INTO `associacoes` (`assoc_id`, `assoc_nome`, `assoc_morada`, `assoc_numContribuinte`, `assoc_quotas_preco`) VALUES
(4, 'teste', 'tres', '12', 123);

-- --------------------------------------------------------

--
-- Estrutura da tabela `assoc_socios`
--

CREATE TABLE `assoc_socios` (
  `assoc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `dono` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `assoc_socios`
--

INSERT INTO `assoc_socios` (`assoc_id`, `user_id`, `dono`) VALUES
(4, 2, 1),
(4, 3, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `evento_id` int(11) NOT NULL,
  `evento_titulo` varchar(100) NOT NULL,
  `evento_descricao` varchar(255) NOT NULL,
  `evento_data` varchar(25) NOT NULL,
  `evento_horas` varchar(25) NOT NULL,
  `evento_unique_id` varchar(255) NOT NULL,
  `assoc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`evento_id`, `evento_titulo`, `evento_descricao`, `evento_data`, `evento_horas`, `evento_unique_id`, `assoc_id`) VALUES
(1, 'UM', 'asa', '29-04-2023', '22:31', '41a8185a600fe4fe85063759349f549d', 2),
(2, 'asd', 'asd', '27-04-2023', '21:07', '20fea27196ab6304b051bef482af76ab', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

CREATE TABLE `imagens` (
  `image_id` int(11) NOT NULL,
  `image_title` varchar(80) NOT NULL,
  `image_src` varchar(200) NOT NULL,
  `assoc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `imagens`
--

INSERT INTO `imagens` (`image_id`, `image_title`, `image_src`, `assoc_id`) VALUES
(1, 'ijmg', '7db6a2e8d8439ab6996b4c06003fe668jpeg_534172994.jpeg', 2),
(2, 'asd', '263e6533268b65130be069bdb38b0a39jpeg_908015788.jpeg', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricoes`
--

CREATE TABLE `inscricoes` (
  `user_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `inscricoes`
--

INSERT INTO `inscricoes` (`user_id`, `evento_id`) VALUES
(3, 2);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `listar_assoc_dono`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `listar_assoc_dono` (
`assoc_id` int(11)
,`assoc_nome` varchar(80)
,`assoc_morada` varchar(100)
,`assoc_numContribuinte` varchar(9)
,`assoc_quotas_preco` float
,`user_id` int(11)
,`user` varchar(80)
,`user_password` varchar(255)
,`user_name` varchar(80)
,`user_email` varchar(120)
,`user_session_id` varchar(255)
,`user_permissions` longtext
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `listar_assoc_socios`
-- (Veja abaixo para a view atual)
--
CREATE TABLE `listar_assoc_socios` (
`assoc_id` int(11)
,`assoc_nome` varchar(80)
,`assoc_morada` varchar(100)
,`assoc_numContribuinte` varchar(9)
,`assoc_quotas_preco` float
,`user_id` int(11)
,`user` varchar(80)
,`user_password` varchar(255)
,`user_name` varchar(80)
,`user_email` varchar(120)
,`user_session_id` varchar(255)
,`user_permissions` longtext
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticias`
--

CREATE TABLE `noticias` (
  `noticia_id` int(11) NOT NULL,
  `noticia_titulo` varchar(100) NOT NULL,
  `noticia_descricao` varchar(255) NOT NULL,
  `noticia_image` varchar(200) NOT NULL,
  `assoc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `noticias`
--

INSERT INTO `noticias` (`noticia_id`, `noticia_titulo`, `noticia_descricao`, `noticia_image`, `assoc_id`) VALUES
(1, 'teste', 'teste', 'e86a1ff18e423ff20d5f59e3bb4a5c29jpeg_400206571.jpeg', 2),
(3, 'asd12', 'asd12', '93f480cfb2fbc2948ebd798bcdcd26f5jpeg_1286188865.jpeg', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `quotas`
--

CREATE TABLE `quotas` (
  `quotas_id` int(11) NOT NULL,
  `quotas_data_comeco` datetime NOT NULL,
  `quotas_data_termino` datetime DEFAULT NULL,
  `quotas_preco` float NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `socios`
--

CREATE TABLE `socios` (
  `user_id` int(11) NOT NULL,
  `user` varchar(80) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_name` varchar(80) NOT NULL,
  `user_email` varchar(120) NOT NULL,
  `user_session_id` varchar(255) NOT NULL,
  `user_permissions` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `socios`
--

INSERT INTO `socios` (`user_id`, `user`, `user_password`, `user_name`, `user_email`, `user_session_id`, `user_permissions`) VALUES
(1, 'Admin', '$2a$08$2AEpHUaS75jId/VlX3bNnew.P58HbqXTa.7ioiDgM2kAd0R469yBy', 'Admin', 'admin@gmail.com', '57l3c70n2jbi2ps813pduq7ndq', 'a:5:{i:0;s:13:\"user-register\";i:1;s:18:\"adm-gerir-noticias\";i:2;s:21:\"adm-gerir-associacoes\";i:3;s:17:\"adm-gerir-galeria\";i:4;s:5:\"admin\";}'),
(2, 'Tiago', '$2a$08$Ias.8ug9Tei36/hmPHt.TeOdSocTxq1p3jsto9luNL7vrkCTULbC6', 'Tiago', 'Tiago@ghmail.com', 'r50e1vrpqh1p01mllmu8jp7htk', 'a:4:{i:0;s:13:\"gerir-eventos\";i:1;s:14:\"gerir-noticias\";i:2;s:17:\"gerir-associacoes\";i:3;s:13:\"gerir-galeria\";}'),
(3, 'Teste12', '$2a$08$g0/qsqedHERixLbxGbpE8e0Iv6tPWiwFgKZxPuLS3tgAOcwWaH1IK', 'Teste12', 'Tes@gmas', 'i1d7h4lgdo3cu6soq29gp8kc87', 'a:3:{i:0;s:14:\"ver-associacao\";i:1;s:11:\"ver-eventos\";i:2;s:10:\"ver-quotas\";}');

-- --------------------------------------------------------

--
-- Estrutura para vista `listar_assoc_dono`
--
DROP TABLE IF EXISTS `listar_assoc_dono`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_assoc_dono`  AS SELECT `associacoes`.`assoc_id` AS `assoc_id`, `associacoes`.`assoc_nome` AS `assoc_nome`, `associacoes`.`assoc_morada` AS `assoc_morada`, `associacoes`.`assoc_numContribuinte` AS `assoc_numContribuinte`, `associacoes`.`assoc_quotas_preco` AS `assoc_quotas_preco`, `socios`.`user_id` AS `user_id`, `socios`.`user` AS `user`, `socios`.`user_password` AS `user_password`, `socios`.`user_name` AS `user_name`, `socios`.`user_email` AS `user_email`, `socios`.`user_session_id` AS `user_session_id`, `socios`.`user_permissions` AS `user_permissions` FROM ((`assoc_socios` join `socios` on(`assoc_socios`.`user_id` = `socios`.`user_id`)) join `associacoes` on(`assoc_socios`.`assoc_id` = `associacoes`.`assoc_id`)) WHERE `assoc_socios`.`dono` = 11  ;

-- --------------------------------------------------------

--
-- Estrutura para vista `listar_assoc_socios`
--
DROP TABLE IF EXISTS `listar_assoc_socios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listar_assoc_socios`  AS SELECT `associacoes`.`assoc_id` AS `assoc_id`, `associacoes`.`assoc_nome` AS `assoc_nome`, `associacoes`.`assoc_morada` AS `assoc_morada`, `associacoes`.`assoc_numContribuinte` AS `assoc_numContribuinte`, `associacoes`.`assoc_quotas_preco` AS `assoc_quotas_preco`, `socios`.`user_id` AS `user_id`, `socios`.`user` AS `user`, `socios`.`user_password` AS `user_password`, `socios`.`user_name` AS `user_name`, `socios`.`user_email` AS `user_email`, `socios`.`user_session_id` AS `user_session_id`, `socios`.`user_permissions` AS `user_permissions` FROM ((`assoc_socios` join `socios` on(`assoc_socios`.`user_id` = `socios`.`user_id`)) join `associacoes` on(`assoc_socios`.`assoc_id` = `associacoes`.`assoc_id`)) WHERE `assoc_socios`.`dono` = 00  ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `associacoes`
--
ALTER TABLE `associacoes`
  ADD PRIMARY KEY (`assoc_id`),
  ADD UNIQUE KEY `assoc_nome` (`assoc_nome`),
  ADD UNIQUE KEY `assoc_numContribuinte` (`assoc_numContribuinte`);

--
-- Índices para tabela `assoc_socios`
--
ALTER TABLE `assoc_socios`
  ADD PRIMARY KEY (`assoc_id`,`user_id`,`dono`);

--
-- Índices para tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`evento_id`),
  ADD UNIQUE KEY `evento_unique_id` (`evento_unique_id`);

--
-- Índices para tabela `imagens`
--
ALTER TABLE `imagens`
  ADD PRIMARY KEY (`image_id`);

--
-- Índices para tabela `inscricoes`
--
ALTER TABLE `inscricoes`
  ADD PRIMARY KEY (`user_id`,`evento_id`);

--
-- Índices para tabela `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`noticia_id`);

--
-- Índices para tabela `quotas`
--
ALTER TABLE `quotas`
  ADD PRIMARY KEY (`quotas_id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Índices para tabela `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user` (`user`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `associacoes`
--
ALTER TABLE `associacoes`
  MODIFY `assoc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `evento_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `imagens`
--
ALTER TABLE `imagens`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `noticias`
--
ALTER TABLE `noticias`
  MODIFY `noticia_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `quotas`
--
ALTER TABLE `quotas`
  MODIFY `quotas_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `socios`
--
ALTER TABLE `socios`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
