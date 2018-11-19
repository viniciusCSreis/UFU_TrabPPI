-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 01-Nov-2018 às 17:18
-- Versão do servidor: 5.6.41-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ejtechmo_trabalho_ppi`
--
CREATE DATABASE IF NOT EXISTS `ejtechmo_trabalho_ppi` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ejtechmo_trabalho_ppi`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Anunciar`
--

CREATE TABLE IF NOT EXISTS `Anunciar` (
  `cpf_cliente_proprietario` char(14) NOT NULL DEFAULT '',
  `id_imovel` int(11) NOT NULL DEFAULT '0',
  `status` varchar(15) NOT NULL,
  `data_anuncio` date NOT NULL,
  `valor_sugerido` double NOT NULL,
  PRIMARY KEY (`id_imovel`,`cpf_cliente_proprietario`),
  KEY `cpf_cliente_proprietario` (`cpf_cliente_proprietario`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE IF NOT EXISTS `SolicitacaoApi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(256) NOT NULL ,
  `email` varchar(256) NOT NULL,
  `telefoneResidencial` varchar(256) NOT NULL,
  `telefoneCelular` varchar(256) NOT NULL,
  `proposta` varchar(1024) NOT NULL,
  `id_imovel` int(11) NOT NULL,
  `data` date NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `id_imovel` FOREIGN KEY (`id_imovel`) REFERENCES `Imovel` (`id_imovel`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Apartamento`
--

CREATE TABLE IF NOT EXISTS `Apartamento` (
  `id_imovel_apartamento` int(11) NOT NULL,
  `porteiro` tinyint(1) DEFAULT NULL,
  `nro_andar` int(11) DEFAULT NULL,
  `valor_condominio` double DEFAULT NULL,
  PRIMARY KEY (`id_imovel_apartamento`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;


CREATE TABLE IF NOT EXISTS `ApiCep` (
  `cep` varchar(8) NOT NULL,
  `estado` varchar(256) DEFAULT NULL,
  `cidade` varchar(256) DEFAULT NULL,
  `bairro` varchar(256) DEFAULT NULL,
  `rua` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`cep`)
)ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;;

-- INSERT INTO ApiCep(cep,estado,cidade,bairro,rua) values('29020903','Espírito Santo', 'Vitória', 'Centro','Avenida Jurema Barroso 35');
-- INSERT INTO ApiCep(cep,estado,cidade,bairro,rua) values('87502270','Paraná', ' Umuarama', 'Jardim Aratimbó','Rua José Dias Lopes');
-- INSERT INTO ApiCep(cep,estado,cidade,bairro,rua) values('31510240','Minas Gerais', 'Belo Horizonte', 'Candelária','Rua Professora Afonsina Machado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Cadastrar_Clientes`
--

CREATE TABLE IF NOT EXISTS `Cadastrar_Clientes` (
  `cpf_clientes` char(14) NOT NULL,
  `cpf_corretor` char(14) NOT NULL,
  `data_cadastro` date DEFAULT NULL,
  PRIMARY KEY (`cpf_clientes`),
  KEY `cpf_corretor` (`cpf_corretor`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Cargo`
--

CREATE TABLE IF NOT EXISTS `Cargo` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `salario_base` double NOT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Clientes`
--

CREATE TABLE IF NOT EXISTS `Clientes` (
  `cpf_clientes` char(14) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `profissao` varchar(25) NOT NULL,
  `estado_civil` varchar(10) NOT NULL,
  `email` varchar(256) NOT NULL,
  PRIMARY KEY (`cpf_clientes`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Cliente_Proprietario`
--

CREATE TABLE IF NOT EXISTS `Cliente_Proprietario` (
  `cpf_cliente_proprietario` char(14) NOT NULL,
  PRIMARY KEY (`cpf_cliente_proprietario`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Cliente_Usuario`
--

CREATE TABLE IF NOT EXISTS `Cliente_Usuario` (
  `cpf_cliente_usuario` char(14) NOT NULL,
  `cpf_fiador` char(14) NOT NULL,
  PRIMARY KEY (`cpf_cliente_usuario`),
  KEY `cpf_fiador` (`cpf_fiador`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Corretor`
--

CREATE TABLE IF NOT EXISTS `Corretor` (
  `cpf_corretor` char(14) NOT NULL,
  PRIMARY KEY (`cpf_corretor`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Forma_Pagamento`
--

CREATE TABLE IF NOT EXISTS `Forma_Pagamento` (
  `cpf_gerente` char(14) NOT NULL,
  `cpf_corretor` char(14) DEFAULT NULL,
  `id_FP` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(200) DEFAULT NULL,
  `data_cadastro` date NOT NULL,
  PRIMARY KEY (`id_FP`),
  UNIQUE KEY `cpf_corretor` (`cpf_corretor`),
  KEY `cpf_gerente` (`cpf_gerente`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Fotos_Imovel`
--

CREATE TABLE IF NOT EXISTS `Fotos_Imovel` (
  `id_imovel` int(11) NOT NULL,
  `fotos` varchar(256) NOT NULL ,
  `id` int(11) UNIQUE NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_imovel`,`id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Funcionario`
--

CREATE TABLE IF NOT EXISTS `Funcionario` (
  `id_cargo` int(11) NOT NULL,
  `cpf_funcionario` char(14) NOT NULL,
  `data_ing` date NOT NULL,
  `senha` varchar(128) NOT NULL,
  `usuario` varchar(256) NOT NULL, 
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL,
  PRIMARY KEY (`cpf_funcionario`),
  KEY `id_cargo` (`id_cargo`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Gerente`
--

CREATE TABLE IF NOT EXISTS `Gerente` (
  `cpf_gerente` char(14) NOT NULL,
  `cnpj` char(18) NOT NULL,
  PRIMARY KEY (`cpf_gerente`),
  UNIQUE KEY `cnpj` (`cnpj`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Imovel`
--

CREATE TABLE IF NOT EXISTS `Imovel` (
  `cpf_cliente_usuario` char(14) NOT NULL,
  `numero` int(11) NOT NULL,
	`cep` varchar(9) NOT NULL,
	`estado` varchar(256) NOT NULL,
  `rua` varchar(256) NOT NULL,
  `cidade` varchar(256) NOT NULL,
  `bairro` varchar(256) NOT NULL,
  `disponibilidade` tinyint(1) DEFAULT NULL,
  `data_construcao` date DEFAULT NULL,
  `area` float DEFAULT NULL,
  `id_imovel` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_imovel`),
  KEY `cpf_cliente_usuario` (`cpf_cliente_usuario`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Indicacoes`
--

CREATE TABLE IF NOT EXISTS `Indicacoes` (
  `cpf_cliente_usuario` char(14) NOT NULL,
  `indicacao` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cpf_cliente_usuario`,`indicacao`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Pessoa`
--

CREATE TABLE IF NOT EXISTS `Pessoa` (
  `cpf` char(14) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`cpf`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Realizar`
--

CREATE TABLE IF NOT EXISTS `Realizar` (
  `cpf_corretor` char(14) NOT NULL DEFAULT '',
  `comissao` double DEFAULT NULL,
  `id_FP` int(11) DEFAULT NULL,
  `id_transacao` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cpf_corretor`,`id_transacao`),
  KEY `id_transacao` (`id_transacao`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Residencia`
--

CREATE TABLE IF NOT EXISTS `Residencia` (
  `id_imovel_residencia` int(11) NOT NULL,
  `descricao` varchar(1024) DEFAULT NULL,
  `tem_armario` tinyint(1) DEFAULT NULL,
  `nro_vaga_garagem` int(11) DEFAULT NULL,
  `qtd_sala_jantar` int(11) DEFAULT NULL,
  `qtd_sala_estar` int(11) DEFAULT NULL,
  `qtd_suit` int(11) DEFAULT NULL,
  `qtd_quartos` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_imovel_residencia`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Sala_Comercial`
--

CREATE TABLE IF NOT EXISTS `Sala_Comercial` (
  `qtd_banheiro` int(11) DEFAULT NULL,
  `qtd_comodos` int(11) DEFAULT NULL,
  `id_imovel_sala_comercial` int(11) NOT NULL,
  PRIMARY KEY (`id_imovel_sala_comercial`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Telefones_Pessoa`
--

CREATE TABLE IF NOT EXISTS `Telefones_Pessoa` (
  `cpf_pessoa` char(14) NOT NULL,
  `telefones` varchar(13) NOT NULL,
  PRIMARY KEY (`cpf_pessoa`,`telefones`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Terreno`
--

CREATE TABLE IF NOT EXISTS `Terreno` (
  `id_imovel_terreno` int(11) NOT NULL,
  `largura` float DEFAULT NULL,
  `comprimento` float DEFAULT NULL,
  `possui_AD` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_imovel_terreno`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Transacao`
--

CREATE TABLE IF NOT EXISTS `Transacao` (
  `comissao` double DEFAULT NULL,
  `id_transacao` int(11) NOT NULL,
  `data_transacao` date NOT NULL,
  `nro_contrato` int(11) NOT NULL,
  `valor_real` double NOT NULL,
  `id_imovel` int(11) NOT NULL,
  `cpf_cliente_usuario` char(14) NOT NULL DEFAULT '',
  PRIMARY KEY (`id_imovel`,`cpf_cliente_usuario`,`nro_contrato`),
  UNIQUE KEY `id_transacao` (`id_transacao`),
  KEY `cpf_cliente_usuario` (`cpf_cliente_usuario`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


