-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Jan-2022 às 00:15
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd-projeto-final-curso`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `redetermos`
--

CREATE TABLE `redetermos` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `descricao` text NOT NULL,
  `dataInclusao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `redetermos`
--

INSERT INTO `redetermos` (`id`, `nome`, `descricao`, `dataInclusao`) VALUES
(12, 'Utopia 1980', 'Descrição de Utopia', '2022-01-17'),
(13, 'Rede de Termos teste', 'Rede de termos teste', '2022-01-17'),
(14, 'Rede de Termos teste 1', 'Rede de termos teste', '2022-01-17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `rede_termos_termo`
--

CREATE TABLE `rede_termos_termo` (
  `id` int(11) NOT NULL,
  `id_rede` int(11) NOT NULL,
  `id_termo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `rede_termos_termo`
--

INSERT INTO `rede_termos_termo` (`id`, `id_rede`, `id_termo`) VALUES
(13, 12, 7),
(14, 13, 7),
(15, 14, 7),
(16, 12, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `termo`
--

CREATE TABLE `termo` (
  `id` int(11) NOT NULL,
  `tipoTermo` varchar(20) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `nomeVariavel` varchar(80) NOT NULL,
  `conceito` text NOT NULL,
  `dataInclusao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `termo`
--

INSERT INTO `termo` (`id`, `tipoTermo`, `nome`, `nomeVariavel`, `conceito`, `dataInclusao`) VALUES
(7, 'teórico', 'Termos teste ', 'Termo teste2', 'Termo teste para inserção no BD', '2022-01-25'),
(8, 'conceito', 'Termo teste', 'Termo teste1', 'Termo teste', '2022-01-25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nomeCompleto` varchar(150) NOT NULL,
  `nomeUsuario` varchar(50) NOT NULL,
  `senha` varchar(40) NOT NULL,
  `nivelAcesso` int(1) NOT NULL,
  `email` varchar(150) NOT NULL,
  `fotoAvatar` varchar(150) NOT NULL,
  `dataInclusao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nomeCompleto`, `nomeUsuario`, `senha`, `nivelAcesso`, `email`, `fotoAvatar`, `dataInclusao`) VALUES
(1, 'Administrador', 'admin@admin', 'a1ba0d7140693d4c80041b5940815128b208b7a5', 1, 'admin@admin.org.br', 'http://localhost/2021-projeto-final-curso/image/avatares/Avatar-1.png', '2021-12-12'),
(6, 'Gustavo Ferreira de Oliveira', 'gustavoof', '2b01ee18651ff42b35cddb707c3d4e8caba6bb0a', 3, 'gustavoofdeoliveira@hotmail.com', 'http://localhost/2021-projeto-final-curso/image/avatares/Avatar-5.png', '2022-01-24');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `redetermos`
--
ALTER TABLE `redetermos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `rede_termos_termo`
--
ALTER TABLE `rede_termos_termo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `termo`
--
ALTER TABLE `termo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `redetermos`
--
ALTER TABLE `redetermos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `rede_termos_termo`
--
ALTER TABLE `rede_termos_termo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `termo`
--
ALTER TABLE `termo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
