-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 25/03/2025 às 20:17
-- Versão do servidor: 8.0.41
-- Versão do PHP: 8.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `commanda_digital`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cardapio`
--

CREATE TABLE `cardapio` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text,
  `preco` decimal(10,2) NOT NULL,
  `preco_promocional` decimal(10,2) DEFAULT NULL,
  `disponivel` tinyint(1) DEFAULT '1',
  `categoria` enum('Bebidas','Aperitivos','Pratos Principais','Sobremesas','Saladas','Lanches','Entradas','Porções','Massas','Pizzas','Sopas') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `serve_pessoas` int DEFAULT '1',
  `vegano` tinyint(1) DEFAULT '0',
  `cozinha` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `cardapio`
--

INSERT INTO `cardapio` (`id`, `nome`, `descricao`, `preco`, `preco_promocional`, `disponivel`, `categoria`, `criado_em`, `atualizado_em`, `serve_pessoas`, `vegano`, `cozinha`) VALUES
(1, 'Coca-Cola', 'Refrigerante gelado de cola', 5.00, NULL, 1, 'Bebidas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 0),
(2, 'Suco de Laranja', 'Suco natural de laranja', 7.50, 6.50, 1, 'Bebidas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 1, 1),
(3, 'Caipirinha', 'Cachaça, limão, açúcar e gelo', 12.00, NULL, 1, 'Bebidas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 1),
(4, 'Batata Frita', 'Porção de batatas fritas crocantes', 15.00, 12.00, 1, 'Aperitivos', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 2, 1, 1),
(5, 'Tábua de Frios', 'Diversos queijos, salames e azeitonas', 45.00, NULL, 1, 'Aperitivos', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 3, 0, 1),
(6, 'Feijoada', 'Feijoada completa com arroz, farofa e couve', 30.00, NULL, 1, 'Pratos Principais', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 2, 0, 1),
(7, 'Moqueca de Palmito', 'Moqueca vegana deliciosa com arroz branco', 28.00, 25.00, 1, 'Pratos Principais', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 2, 1, 1),
(8, 'Pudim de Leite', 'Pudim de leite condensado cremoso', 10.00, NULL, 1, 'Sobremesas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 1),
(9, 'Frutas da Estação', 'Seleção de frutas frescas', 12.00, NULL, 1, 'Sobremesas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 1, 1),
(10, 'Churrasco Misto', 'Picanha, linguiça, frango e acompanhamentos', 80.00, NULL, 1, 'Pratos Principais', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 3, 0, 1),
(11, 'Salmão Grelhado', 'Salmão grelhado com legumes assados', 60.00, NULL, 1, 'Pratos Principais', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 2, 0, 1),
(12, 'Espaguete à Bolonhesa', 'Massa com molho de carne e queijo parmesão', 32.00, NULL, 1, 'Massas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 1),
(13, 'Pizza Margherita', 'Molho de tomate, mussarela e manjericão', 45.00, NULL, 1, 'Pizzas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 2, 0, 1),
(14, 'Hambúrguer Artesanal', 'Pão brioche, blend de carne, queijo cheddar', 28.00, 25.00, 1, 'Lanches', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 1),
(15, 'Ceviche de Tilápia', 'Tilápia marinada no limão com cebola roxa', 35.00, NULL, 1, 'Aperitivos', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 2, 0, 1),
(16, 'Salada Caesar', 'Alface romana, croutons, frango e molho Caesar', 25.00, NULL, 1, 'Saladas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 1),
(17, 'Sopa de Abóbora', 'Creme de abóbora com gengibre', 20.00, NULL, 1, 'Sopas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 1, 1),
(18, 'Torta de Limão', 'Torta doce com creme de limão e merengue', 15.00, NULL, 1, 'Sobremesas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 1),
(19, 'Milkshake de Chocolate', 'Sorvete batido com calda de chocolate', 18.00, NULL, 1, 'Bebidas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 1),
(20, 'Pastel de Carne', 'Pastel frito recheado com carne temperada', 10.00, NULL, 1, 'Aperitivos', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 1),
(21, 'Água Mineral', 'Água mineral sem gás', 4.00, NULL, 1, 'Bebidas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 1, 0),
(22, 'Água de Coco', 'Água de coco natural', 7.00, NULL, 1, 'Bebidas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 1, 0),
(23, 'Cerveja Pilsen', 'Cerveja gelada de estilo pilsen', 10.00, NULL, 1, 'Bebidas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 0),
(24, 'Whisky 12 Anos', 'Dose de whisky 12 anos envelhecido', 25.00, NULL, 1, 'Bebidas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 0),
(25, 'Porção de Calabresa', 'Calabresa acebolada com farofa', 22.00, NULL, 1, 'Aperitivos', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 2, 0, 1),
(26, 'Pão de Alho', 'Pão de alho assado na brasa', 12.00, NULL, 1, 'Aperitivos', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 2, 0, 1),
(27, 'X-Bacon', 'Pão, hambúrguer, queijo, bacon e molho especial', 30.00, NULL, 1, 'Lanches', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 1),
(28, 'Sanduíche Natural', 'Pão integral, frango desfiado, cenoura e maionese', 18.00, NULL, 1, 'Lanches', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 0, 1),
(29, 'Suco de Morango', 'Suco natural de morango', 8.00, NULL, 1, 'Bebidas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 1, 1),
(30, 'Suco de Maracujá', 'Suco natural de maracujá', 8.00, NULL, 1, 'Bebidas', '2025-03-25 08:57:34', '2025-03-25 08:57:34', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `comanda`
--

CREATE TABLE `comanda` (
  `id` int NOT NULL,
  `mesa_id` int NOT NULL,
  `aberta` tinyint(1) DEFAULT '1',
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total` decimal(10,2) DEFAULT '0.00',
  `pago` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `comanda`
--

INSERT INTO `comanda` (`id`, `mesa_id`, `aberta`, `criado_em`, `atualizado_em`, `total`, `pago`) VALUES
(7, 6, 0, '2025-03-25 11:27:10', '2025-03-25 11:27:31', 5.00, 1),
(8, 6, 0, '2025-03-25 11:27:40', '2025-03-25 11:39:14', 7.50, 1),
(9, 10, 0, '2025-03-25 15:58:18', '2025-03-25 15:59:06', 25.00, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mesa`
--

CREATE TABLE `mesa` (
  `id` int NOT NULL,
  `numero` int NOT NULL,
  `capacidade` int NOT NULL,
  `disponivel` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `mesa`
--

INSERT INTO `mesa` (`id`, `numero`, `capacidade`, `disponivel`) VALUES
(1, 1, 4, 1),
(2, 2, 2, 1),
(3, 3, 6, 1),
(4, 4, 4, 1),
(5, 5, 8, 1),
(6, 6, 2, 1),
(7, 7, 4, 1),
(8, 8, 6, 1),
(9, 9, 4, 1),
(10, 10, 2, 1),
(11, 11, 10, 1),
(12, 12, 4, 1),
(13, 13, 2, 1),
(14, 14, 6, 1),
(15, 15, 8, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido`
--

CREATE TABLE `pedido` (
  `id` int NOT NULL,
  `comanda_id` int NOT NULL,
  `cardapio_id` int NOT NULL,
  `quantidade` int NOT NULL DEFAULT '1',
  `observacao` text,
  `cozinha` tinyint(1) NOT NULL DEFAULT '0',
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `preco` decimal(10,2) NOT NULL,
  `status` enum('Pedido','Preparando','Pronto','Entregue','Cancelado','Retornado','Aguardando Repreparo') DEFAULT 'Pedido',
  `garcom_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `pedido`
--

INSERT INTO `pedido` (`id`, `comanda_id`, `cardapio_id`, `quantidade`, `observacao`, `cozinha`, `criado_em`, `atualizado_em`, `preco`, `status`, `garcom_id`) VALUES
(13, 7, 1, 1, NULL, 0, '2025-03-25 11:27:14', '2025-03-25 11:27:17', 5.00, 'Entregue', 9),
(14, 8, 2, 1, NULL, 1, '2025-03-25 11:27:44', '2025-03-25 11:37:55', 7.50, 'Entregue', 9),
(15, 9, 4, 1, NULL, 1, '2025-03-25 15:58:22', '2025-03-25 15:58:49', 15.00, 'Entregue', 9),
(16, 9, 1, 1, NULL, 0, '2025-03-25 15:58:25', '2025-03-25 15:58:52', 5.00, 'Entregue', 9),
(17, 9, 1, 1, NULL, 0, '2025-03-25 15:58:27', '2025-03-25 15:58:54', 5.00, 'Entregue', 9);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cargo` varchar(50) NOT NULL,
  `funcao` varchar(100) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT '1',
  `criado_em` datetime DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `login`, `senha`, `nome`, `cargo`, `funcao`, `ativo`, `criado_em`, `atualizado_em`) VALUES
(1, 'jpaiva', '$2y$10$fLBo4CHn8NSnsfqYsWIVAOXeJWpIn2NBTgZ6lpgMbcBGBVoB.WSBi', 'João Paiva', 'Chef de Cozinha', 'Cozinha', 1, '2025-03-22 06:22:06', '2025-03-22 06:22:06'),
(2, 'amartins', '$2y$10$fLBo4CHn8NSnsfqYsWIVAOXeJWpIn2NBTgZ6lpgMbcBGBVoB.WSBi', 'Ana Martins', 'Garçom', 'Garçom', 1, '2025-03-22 06:22:06', '2025-03-22 06:22:06'),
(3, 'lgomes', '$2y$10$fLBo4CHn8NSnsfqYsWIVAOXeJWpIn2NBTgZ6lpgMbcBGBVoB.WSBi', 'Lucas Gomes', 'Coordenador de Restaurante', 'Cozinha', 1, '2025-03-22 06:22:06', '2025-03-22 06:22:06'),
(4, 'mpereira', '$2y$10$fLBo4CHn8NSnsfqYsWIVAOXeJWpIn2NBTgZ6lpgMbcBGBVoB.WSBi', 'Maria Pereira', 'Garçonete', 'Garçom', 1, '2025-03-22 06:22:06', '2025-03-22 06:22:06'),
(5, 'cribeiro', '$2y$10$fLBo4CHn8NSnsfqYsWIVAOXeJWpIn2NBTgZ6lpgMbcBGBVoB.WSBi', 'Carlos Ribeiro', 'Auxiliar de Cozinha', 'Cozinha', 1, '2025-03-22 06:22:06', '2025-03-22 06:22:06'),
(9, 'admin', '$2y$10$fLBo4CHn8NSnsfqYsWIVAOXeJWpIn2NBTgZ6lpgMbcBGBVoB.WSBi', 'admnistrador', 'Administrador', 'adm', 1, '2025-03-22 16:12:21', '2025-03-22 16:12:21');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cardapio`
--
ALTER TABLE `cardapio`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `comanda`
--
ALTER TABLE `comanda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mesa_id` (`mesa_id`);

--
-- Índices de tabela `mesa`
--
ALTER TABLE `mesa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`);

--
-- Índices de tabela `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comanda_id` (`comanda_id`),
  ADD KEY `cardapio_id` (`cardapio_id`),
  ADD KEY `garcom_id` (`garcom_id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cardapio`
--
ALTER TABLE `cardapio`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `comanda`
--
ALTER TABLE `comanda`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `mesa`
--
ALTER TABLE `mesa`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comanda`
--
ALTER TABLE `comanda`
  ADD CONSTRAINT `comanda_ibfk_1` FOREIGN KEY (`mesa_id`) REFERENCES `mesa` (`id`);

--
-- Restrições para tabelas `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`comanda_id`) REFERENCES `comanda` (`id`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`cardapio_id`) REFERENCES `cardapio` (`id`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`garcom_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
