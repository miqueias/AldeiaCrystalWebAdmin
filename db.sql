-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Apr 14, 2017 at 11:25 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `aldeia_crystal`
--

-- --------------------------------------------------------

--
-- Table structure for table `condominio`
--

CREATE TABLE `condominio` (
  `id_condominio` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `uf` varchar(255) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `referencia` varchar(255) NOT NULL,
  `nome_sindico` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A',
  `id_entregador` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `condominio`
--

INSERT INTO `condominio` (`id_condominio`, `nome`, `rua`, `numero`, `bairro`, `cidade`, `uf`, `cep`, `referencia`, `nome_sindico`, `telefone`, `status`, `id_entregador`) VALUES
(2, 'Ed. Clarita', 'Rua Ferreiros', '312', 'Janga', 'Paulista', 'PE', '53437-730', 'Terceira rua a esquerda', 'Miqueias Lopes', '98819-6072', 'A', 2),
(3, 'JaquetÃ¡ Silva', 'Senhor Tabosa', '123', 'Jardin AtlÃ¢ntico', 'Olinda', 'PE', '50030-010', '', 'Marcelo Oliveira', '8130104909', 'A', 2),
(4, 'JaquetÃ¡ Silva', 'Senhor Tabosa', '123', 'Janga', 'Olinda', 'PE', '50030-010', '', 'Marcelo', '8188889090', 'A', 2);

-- --------------------------------------------------------

--
-- Table structure for table `entregador`
--

CREATE TABLE `entregador` (
  `id_entregador` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entregador`
--

INSERT INTO `entregador` (`id_entregador`, `nome`, `cpf`, `foto`) VALUES
(2, 'MÃ¡rcio Souza 24', '000.000.000-01', ''),
(4, 'MiquÃ©ias Lopes', '013.789.754-56', ''),
(5, 'MiquÃ©ias Lopes', '013.789.754-56', ''),
(6, 'Manuel da Costa', '908.890.890.88', ''),
(7, 'MiquÃ©ias Lopes do Santos', '013.789.754-56', '');

-- --------------------------------------------------------

--
-- Table structure for table `noticia`
--

CREATE TABLE `noticia` (
  `id_noticia` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `noticia`
--

INSERT INTO `noticia` (`id_noticia`, `titulo`, `descricao`, `status`) VALUES
(1, 'tituloaasdasd', 'descricaoaasdasdasd', 'I'),
(2, 'teste', 'teste', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `pedido`
--

CREATE TABLE `pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_usuario_app` int(11) NOT NULL,
  `qtd_5l` int(11) NOT NULL,
  `qtd_10l` int(11) NOT NULL,
  `troco` double NOT NULL,
  `data_hora` datetime NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pedido`
--

INSERT INTO `pedido` (`id_pedido`, `id_usuario_app`, `qtd_5l`, `qtd_10l`, `troco`, `data_hora`, `status`) VALUES
(1, 1, 1, 3, 5, '2017-03-23 00:00:00', 'E'),
(2, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(3, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(4, 2, 1, 0, 0, '2017-03-23 00:00:00', 'E'),
(5, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(6, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(7, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(8, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(9, 2, 1, 0, 0, '2017-03-23 00:00:00', 'E'),
(10, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(11, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(12, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(13, 2, 1, 0, 0, '2017-03-23 00:00:00', 'E'),
(14, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(15, 2, 1, 0, 0, '2017-03-08 00:00:00', 'E'),
(16, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(17, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(18, 2, 1, 0, 0, '2017-03-01 00:00:00', 'E'),
(19, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(20, 2, 1, 0, 0, '2017-03-01 00:00:00', 'E'),
(21, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(22, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(23, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(24, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(25, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(26, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(27, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(28, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(29, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(30, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(31, 2, 1, 0, 0, '2017-03-22 00:00:00', 'P'),
(32, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(33, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(34, 2, 1, 0, 0, '2017-03-22 00:00:00', 'P'),
(35, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(36, 2, 1, 0, 0, '2017-03-22 00:00:00', 'E'),
(37, 2, 1, 0, 0, '2017-03-22 00:00:00', 'P'),
(38, 2, 0, 1, 0, '2017-03-22 00:00:00', 'E'),
(39, 2, 0, 1, 0, '2017-03-22 00:00:00', 'E'),
(40, 2, 0, 1, 0, '2017-03-22 00:00:00', 'P'),
(41, 2, 0, 1, 0, '2017-03-22 00:00:00', 'E'),
(42, 2, 0, 1, 0, '2017-03-22 00:00:00', 'E'),
(43, 2, 0, 1, 0, '2017-03-22 00:00:00', 'E'),
(44, 2, 0, 1, 0, '2017-03-22 00:00:00', 'E'),
(45, 2, 0, 1, 0, '2017-03-22 00:00:00', 'E'),
(46, 2, 0, 1, 0, '2017-03-22 00:00:00', 'E'),
(47, 2, 0, 1, 0, '2017-03-22 00:00:00', 'E'),
(48, 2, 0, 1, 0, '2017-03-22 00:00:00', 'E'),
(49, 2, 0, 1, 0, '2017-03-22 00:00:00', 'E'),
(50, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(51, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(52, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(53, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(54, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(55, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(56, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(57, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(58, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(59, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(60, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(61, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(62, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(63, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(64, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(65, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(66, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(67, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(68, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(69, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(70, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(71, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(72, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(73, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(74, 3, 2, 1, 0, '2017-03-24 00:00:00', 'P'),
(75, 4, 1, 1, 0, '2017-03-24 00:00:00', 'P'),
(76, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(77, 4, 1, 1, 0, '2017-03-24 00:00:00', 'P'),
(78, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(79, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(80, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(81, 4, 1, 1, 0, '2017-03-24 00:00:00', 'P'),
(82, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(83, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(84, 3, 2, 1, 0, '2017-03-24 00:00:00', 'P'),
(85, 4, 1, 1, 0, '2017-03-24 00:00:00', 'E'),
(86, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(87, 4, 1, 1, 0, '2017-03-24 00:00:00', 'P'),
(88, 3, 2, 1, 0, '2017-03-24 00:00:00', 'E'),
(89, 4, 1, 1, 0, '2017-03-24 00:00:00', 'P'),
(90, 1, 2, 4, 5, '2017-03-29 14:51:25', 'P'),
(91, 1, 2, 4, 5, '2017-03-29 14:54:30', 'P'),
(92, 1, 2, 4, 5, '2017-03-29 14:57:42', 'P'),
(93, 1, 2, 4, 5, '2017-03-31 12:28:27', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(11) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `preco` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `descricao` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id_tipo_usuario`, `descricao`) VALUES
(1, 'Administrador'),
(2, 'Padrão');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A',
  `id_tipo_usuario` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `usuario`, `senha`, `email`, `status`, `id_tipo_usuario`) VALUES
(1, 'Miqueias Lopes', 'admin', 'super', 'miqueias@nubohost.com.br', 'A', 1),
(2, 'Luciano', 'luciano', 'crystal', 'luciano@aldeiacrystal.com.br', 'A', 1),
(3, 'Marcelo', 'marcelo', '123456', 'marcelo@recifesites.com', 'A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `usuario_app`
--

CREATE TABLE `usuario_app` (
  `id_usuario_app` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone_fixo` varchar(255) NOT NULL,
  `telefone_celular` varchar(255) NOT NULL,
  `apt` varchar(255) NOT NULL,
  `codigo_acesso` text NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A',
  `condominio_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usuario_app`
--

INSERT INTO `usuario_app` (`id_usuario_app`, `nome`, `telefone_fixo`, `telefone_celular`, `apt`, `codigo_acesso`, `status`, `condominio_id`) VALUES
(1, 'Davi Lopes', '3010-4909', '98819-6072', '201', '1000', 'A', 2),
(2, 'Juliana Melo', '8130104909', '8130104909', '404', 'a', 'A', 2),
(3, 'Davi Lopes de Melo MiquÃ©ias Lopes', '8188196072', '8188196072', 'AP 202', '', 'A', 3),
(4, 'Marcos Julio Xavier', '8130104909', '8130104909', '908', 'ocVeR51mWL', 'A', 2),
(11, 'Mayra Lopes', '8188196072', '8188196072', '123', '2515d85d953da11decb4b64aa52b0dc6ffb83b7e543509ed13e4cba228f8ffa5', 'A', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `condominio`
--
ALTER TABLE `condominio`
  ADD PRIMARY KEY (`id_condominio`),
  ADD KEY `id_entregador` (`id_entregador`);

--
-- Indexes for table `entregador`
--
ALTER TABLE `entregador`
  ADD PRIMARY KEY (`id_entregador`);

--
-- Indexes for table `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`id_noticia`);

--
-- Indexes for table `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_usuario_app` (`id_usuario_app`),
  ADD KEY `id_usuario_app_2` (`id_usuario_app`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_tipo_usuario` (`id_tipo_usuario`);

--
-- Indexes for table `usuario_app`
--
ALTER TABLE `usuario_app`
  ADD PRIMARY KEY (`id_usuario_app`),
  ADD KEY `condominio_id` (`condominio_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `condominio`
--
ALTER TABLE `condominio`
  MODIFY `id_condominio` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `entregador`
--
ALTER TABLE `entregador`
  MODIFY `id_entregador` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `noticia`
--
ALTER TABLE `noticia`
  MODIFY `id_noticia` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuario_app`
--
ALTER TABLE `usuario_app`
  MODIFY `id_usuario_app` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `condominio`
--
ALTER TABLE `condominio`
  ADD CONSTRAINT `condominio_ibfk_1` FOREIGN KEY (`id_entregador`) REFERENCES `entregador` (`id_entregador`);

--
-- Constraints for table `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`id_usuario_app`) REFERENCES `usuario_app` (`id_usuario_app`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`id_tipo_usuario`) REFERENCES `tipo_usuario` (`id_tipo_usuario`);

--
-- Constraints for table `usuario_app`
--
ALTER TABLE `usuario_app`
  ADD CONSTRAINT `usuario_app_ibfk_1` FOREIGN KEY (`condominio_id`) REFERENCES `condominio` (`id_condominio`);
