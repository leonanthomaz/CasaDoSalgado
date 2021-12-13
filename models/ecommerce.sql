-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 12-Dez-2021 às 18:26
-- Versão do servidor: 8.0.21
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecommerce`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `local` int DEFAULT NULL,
  `frete` int NOT NULL DEFAULT '0',
  `total` float NOT NULL,
  `status` varchar(10) NOT NULL,
  `orderStatus` enum('0','1','2','3','4','5') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0' COMMENT '0=Pedido realizado.\r\n1=Pedido confirmado.\r\n2=Pedido em separação.\r\n3=Pedido saiu para entrega!\r\n4=Pedido entregue.\r\n5=Pedido cancelado.',
  `cancelamento` int NOT NULL,
  `pagamento` enum('0','1','2','3') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0' COMMENT '0= Nulo, 1=Dinheiro, 2=Cartão, 3=Pix',
  `observacao` varchar(100) NOT NULL,
  `dt_pedido` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=435 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `id_usuario`, `local`, `frete`, `total`, `status`, `orderStatus`, `cancelamento`, `pagamento`, `observacao`, `dt_pedido`) VALUES
(434, 139, 19, 8, 26, '', '0', 0, '1', 'Troco para 50.', '2021-12-12 15:24:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos_itens`
--

DROP TABLE IF EXISTS `pedidos_itens`;
CREATE TABLE IF NOT EXISTS `pedidos_itens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int NOT NULL,
  `id_produto` int NOT NULL,
  `sabores` varchar(100) NOT NULL,
  `quantidade` int NOT NULL,
  `dt_pedido` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `pedidos_itens`
--

INSERT INTO `pedidos_itens` (`id`, `id_usuario`, `id_produto`, `sabores`, `quantidade`, `dt_pedido`) VALUES
(302, 139, 13, '', 1, '2021-12-12 15:24:01'),
(303, 139, 11, '', 2, '2021-12-12 15:24:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_produto` int NOT NULL,
  `produto` varchar(100) NOT NULL,
  `valor_unitario` float NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `categoria` enum('0','1','2','3','4') NOT NULL DEFAULT '0' COMMENT '0= nulo, 1=lanche, 2=bebida, 3=combo, 4=Yakisoba',
  `dt_cadastro_produto` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `produto`, `valor_unitario`, `descricao`, `imagem`, `categoria`, `dt_cadastro_produto`) VALUES
(1, 'Porção de Kibes', 6.5, 'Porção de Kibes com 10 unidades.', '../../views/public/img/1639333176.png', '1', '2021-12-12'),
(2, 'Porção de Bolinhas de queijo', 6.5, 'Porção de Bolinhas de quejo com 10 unidades.', '../../views/public/img/1639333166.png', '1', '2021-12-12'),
(3, 'Porção de Risoles de carne', 6.5, 'Porção de Risoles de carne com 10 unidades.', '../../views/public/img/1639333191.png', '1', '2021-12-12'),
(4, 'Porção de Risole de Camarão', 6.5, 'Porção de Risole de Camarão com 10 unidades.', '../../views/public/img/1639333152.png', '1', '2021-12-12'),
(5, 'Porção de Risole de Queijo com Presunto', 6.5, 'Porção de Risole de Queijo com Presunto com 10 unidades.', '../../views/public/img/1639333139.png', '1', '2021-12-12'),
(6, 'Porção de Risole de Palmito', 6.5, 'Porção de Risole de Palmito com 10 unidades', '../../views/public/img/1639333124.png', '1', '2021-12-12'),
(7, 'Porção de Risole de Calabresa', 6.5, 'Porção de Risole de Calabresa com 10 unidades', '../../views/public/img/1639333110.png', '1', '2021-12-12'),
(8, 'Porção de Camarão Empanado', 10, 'Porção com 10 camarões empanados.', '../../views/public/img/1639333095.png', '1', '2021-12-12'),
(9, 'Porção de Coxinhas com Catupiry', 6.5, 'Porção com 10 unidades de Coxinhas com Catupiry', '../../views/public/img/1639333079.png', '1', '2021-12-12'),
(10, 'Porção de Coxinhas sem Catupiry', 6.5, 'Porção com 10 unidades de Coxinhas sem Catupiry', '../../views/public/img/1639333069.png', '1', '2021-12-12'),
(11, 'Porção de Salgadinhos mistos', 6.5, 'Porção de salgadinhos com 10 sabores: coxinhas (com e sem catupiry), kibe, bolinha de queijo, enroladinho de salsicha, risoles de carne, palmito, calabresa, queijo e presunto e camarão. ', '../../views/public/img/1639333058.png', '1', '2021-12-12'),
(12, 'Tobi Guaraná', 5, 'Tobi guaraná de 2 litros.', '../../views/public/img/1639333012.png', '2', '2021-12-12'),
(13, 'Coca-Cola - Lata', 5, 'Coca-Cola - Lata', '../../views/public/img/1639332995.jpg', '2', '2021-12-12'),
(14, 'Coca-Cola - 2 Litros', 11, 'Coca-Cola - 2 Litros', '../../views/public/img/1639332982.jpg', '2', '2021-12-12'),
(15, 'Guaracamp - 200 mL', 2, 'Guaracamp - 200 mL', '../../views/public/img/1639332971.png', '2', '2021-12-12'),
(16, 'Combo de 100 salgadinhos + uma Coca-Cola 2 Litros', 75, 'Combo de 100 salgadinhos mistos + uma Coca-Cola 2 Litros. Obs: Se preferir, você pode personalizar os sabores ao finalizar seu pedido.', '../../views/public/img/1639332943.png', '3', '2021-12-12'),
(17, 'Combo de 50 salgadinhos + um Tobi de 2 litros', 36, 'Combo de 50 salgadinhos + um Tobi de 2 litros. Obs: Se preferir, você pode personalizar os sabores ao finalizar seu pedido.', '../../views/public/img/1639332927.png', '3', '2021-12-12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `adm` int DEFAULT '0',
  `cliente` varchar(50) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `telefone` varchar(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `endereco` longtext NOT NULL,
  `ponto` varchar(500) NOT NULL,
  `localidade` int NOT NULL,
  `password` varchar(255) NOT NULL,
  `recuperar_senha` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `adm`, `cliente`, `username`, `telefone`, `email`, `endereco`, `ponto`, `localidade`, `password`, `recuperar_senha`, `created_at`) VALUES
(48, 1, NULL, 'admin', '21000000000', 'admin@admin', 'Rua Admin, n 0', 'Perto do admin', 0, 'admin', NULL, '2021-10-21 01:40:22'),
(53, NULL, 'Leonan', 'Leonan', '2198090928', 'leonan.thomaz@gmail.com', 'Rua Antonio Nunes, casa 1B', 'Perto do bar do baixinho.', 1, '$2y$10$LldxXVi19S52Ex1PSkuFs.6siLvWVZytNx74RVJq3hB/AmgTyg2zO', '$2y$10$4nSRtcCXhi5sML79a8vGte92yoONDudJaBlG3okRYTuA.siFBkyIW', '2021-11-13 23:11:16'),
(139, 0, 'Teste', 'teste@teste', '21900000000', 'teste@teste.com', 'Rua teste, nº 0.', 'Próximo a rua teste.', 19, '$2y$10$ZvaeX75lVjciNoNgPIa3J.yhr/PTqUu80713C8b64qAJBAcohGLtO', NULL, '2021-12-12 15:22:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
