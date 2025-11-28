-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/11/2025 às 18:33
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `freebooks`
--
CREATE DATABASE IF NOT EXISTS `freebooks` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `freebooks`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

DROP TABLE IF EXISTS `livros`;
CREATE TABLE IF NOT EXISTS `livros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `genero` varchar(100) NOT NULL,
  `isbn` varchar(50) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `link` varchar(500) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tabela truncada antes do insert `livros`
--

TRUNCATE TABLE `livros`;
--
-- Despejando dados para a tabela `livros`
--

INSERT INTO `livros` (`id`, `titulo`, `autor`, `genero`, `isbn`, `imagem`, `link`, `data_cadastro`) VALUES
(1, 'Dom Quixote', 'Miguel de Cervantes', 'Romance', NULL, 'dom quixote.webp', 'https://exemplo.com/dom-quixote', '2025-11-28 14:52:00'),
(2, 'Dracula', 'Bram Stoker', 'Terror', '', 'dracula.jpg', 'https://drive.google.com/file/d/0Bxodj9lVZ6CuS2NBTE1ac2pvYU0/view?resourcekey=0-q4hM0yCq_HM35weypYgFMg', '2025-11-28 14:52:00'),
(3, 'Duna', 'Frank Herbert', 'fi', '', 'duna.jpg', 'https://exemplo.com/duna', '2025-11-28 14:52:00'),
(5, 'Menino do Pijama Listrado', 'John Boyne', 'Drama triste', '', 'mpj.jpg', 'https://drive.google.com/file/d/0B5lEZY-ygqeKYkUzZEpKeEFzalU/edit?pli=1&resourcekey=0-G0ePXCWb0noiAhnQdaAD4A', '2025-11-28 15:14:38'),
(6, 'O Alienista', 'Machado de Assis  ', 'Literatura Brasileira', '', 'https://www.lpm.com.br/livros/imagens/o_alienista_letras_gigantes_9786556662800_hd.jpg', 'https://drive.google.com/file/d/0B5ke1OS4ljgzYWVkZmU0ZmMtMzMyMC00MjJhLTk5MDYtNmM0ZjI4MjA2NjU1/view?resourcekey=0-bKM2y6gm6YZcaLssQdaeUw', '2025-11-28 15:41:48');

-- --------------------------------------------------------

--
-- Estrutura para tabela `suportes`
--

DROP TABLE IF EXISTS `suportes`;
CREATE TABLE IF NOT EXISTS `suportes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `pergunta` text NOT NULL,
  `data_envio` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('aberta','respondida') DEFAULT 'aberta',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tabela truncada antes do insert `suportes`
--

TRUNCATE TABLE `suportes`;
--
-- Despejando dados para a tabela `suportes`
--

INSERT INTO `suportes` (`id`, `nome`, `email`, `cpf`, `pergunta`, `data_envio`, `status`) VALUES
(1, 'Teste Final', 'teste@email.com', '123.456.789-00', 'Testando inser??o manual', '2025-11-28 17:00:16', 'aberta');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
