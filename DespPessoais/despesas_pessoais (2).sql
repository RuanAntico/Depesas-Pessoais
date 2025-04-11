-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/04/2025 às 01:28
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `despesas_pessoais`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadlogin`
--

CREATE TABLE `cadlogin` (
  `codUsuario` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `cpf` int(11) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `data_nasc` date DEFAULT NULL,
  `telefone` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadlogin`
--

INSERT INTO `cadlogin` (`codUsuario`, `nome`, `cpf`, `email`, `data_nasc`, `telefone`) VALUES
(7, 'Vinicius', 123456, 'vinicius509.vs@1', '2002-04-28', '4005697'),
(8, 'Ruan', 654321, 'ruan@1', '2005-02-01', '4568400'),
(9, 'Vitor', 234567, 'vitor@1', '2005-10-17', '5689710'),
(10, 'João', 765432, 'joao@1', '1997-06-10', '500540');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `codCategoria` int(11) NOT NULL,
  `nome` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`codCategoria`, `nome`) VALUES
(19, 'agua'),
(20, 'luz'),
(21, 'agua');

-- --------------------------------------------------------

--
-- Estrutura para tabela `descricaodespesas`
--

CREATE TABLE `descricaodespesas` (
  `codDescDesp` int(11) NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT NULL,
  `data_pag` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `descricaodespesas`
--

INSERT INTO `descricaodespesas` (`codDescDesp`, `nome`, `valor`, `data_pag`) VALUES
(21, 'Conta de agua do SAAE', 75.00, '2025-04-18'),
(22, 'Conta de luz', 200.00, '2025-04-19'),
(23, 'Conta de agua do SAAE', 280.00, '2025-04-08');

-- --------------------------------------------------------

--
-- Estrutura para tabela `despesas`
--

CREATE TABLE `despesas` (
  `codUsuario` int(11) DEFAULT NULL,
  `codCategoria` int(11) DEFAULT NULL,
  `codDescDesp` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `despesas`
--

INSERT INTO `despesas` (`codUsuario`, `codCategoria`, `codDescDesp`) VALUES
(7, 19, 21),
(7, 20, 22),
(7, 21, 23);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamento`
--

CREATE TABLE `pagamento` (
  `codPagamento` int(11) NOT NULL,
  `codUsuario` int(11) NOT NULL,
  `data_pagamento` date NOT NULL,
  `valor_total` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamento`
--

INSERT INTO `pagamento` (`codPagamento`, `codUsuario`, `data_pagamento`, `valor_total`) VALUES
(13, 7, '2025-04-10', 275.00),
(14, 7, '2025-04-10', 275.00);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pagamento_despesa`
--

CREATE TABLE `pagamento_despesa` (
  `codPagamento` int(11) NOT NULL,
  `codDescDesp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pagamento_despesa`
--

INSERT INTO `pagamento_despesa` (`codPagamento`, `codDescDesp`) VALUES
(13, 21),
(13, 22),
(14, 21),
(14, 22);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `login` int(11) NOT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `codUsuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`login`, `senha`, `codUsuario`) VALUES
(123456, '123', 7),
(234567, '123', 9),
(654321, '123', 8),
(765432, '123', 10);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadlogin`
--
ALTER TABLE `cadlogin`
  ADD PRIMARY KEY (`codUsuario`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`codCategoria`);

--
-- Índices de tabela `descricaodespesas`
--
ALTER TABLE `descricaodespesas`
  ADD PRIMARY KEY (`codDescDesp`);

--
-- Índices de tabela `despesas`
--
ALTER TABLE `despesas`
  ADD KEY `FK_DescDesp` (`codDescDesp`),
  ADD KEY `FK_Categoria` (`codCategoria`),
  ADD KEY `FK_UsuarioDesp` (`codUsuario`);

--
-- Índices de tabela `pagamento`
--
ALTER TABLE `pagamento`
  ADD PRIMARY KEY (`codPagamento`),
  ADD KEY `codUsuario` (`codUsuario`);

--
-- Índices de tabela `pagamento_despesa`
--
ALTER TABLE `pagamento_despesa`
  ADD PRIMARY KEY (`codPagamento`,`codDescDesp`),
  ADD KEY `codDescDesp` (`codDescDesp`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`login`),
  ADD UNIQUE KEY `codUsuario` (`codUsuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadlogin`
--
ALTER TABLE `cadlogin`
  MODIFY `codUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `codCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `descricaodespesas`
--
ALTER TABLE `descricaodespesas`
  MODIFY `codDescDesp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `pagamento`
--
ALTER TABLE `pagamento`
  MODIFY `codPagamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `despesas`
--
ALTER TABLE `despesas`
  ADD CONSTRAINT `FK_Categoria` FOREIGN KEY (`codCategoria`) REFERENCES `categoria` (`codCategoria`),
  ADD CONSTRAINT `FK_DescDesp` FOREIGN KEY (`codDescDesp`) REFERENCES `descricaodespesas` (`codDescDesp`),
  ADD CONSTRAINT `FK_UsuarioDesp` FOREIGN KEY (`codUsuario`) REFERENCES `cadlogin` (`codUsuario`);

--
-- Restrições para tabelas `pagamento`
--
ALTER TABLE `pagamento`
  ADD CONSTRAINT `pagamento_ibfk_1` FOREIGN KEY (`codUsuario`) REFERENCES `cadlogin` (`codUsuario`);

--
-- Restrições para tabelas `pagamento_despesa`
--
ALTER TABLE `pagamento_despesa`
  ADD CONSTRAINT `pagamento_despesa_ibfk_1` FOREIGN KEY (`codPagamento`) REFERENCES `pagamento` (`codPagamento`),
  ADD CONSTRAINT `pagamento_despesa_ibfk_2` FOREIGN KEY (`codDescDesp`) REFERENCES `descricaodespesas` (`codDescDesp`);

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_USUARIO` FOREIGN KEY (`codUsuario`) REFERENCES `cadlogin` (`codUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
