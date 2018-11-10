--Aqui deverá ser inserido script de criação do banco
-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 04-Nov-2018 às 15:43
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `Anunciar`
--

CREATE TABLE `Anunciar` (
  `cpf_cliente_proprietario` char(14) NOT NULL DEFAULT '',
  `id_imovel` int(11) NOT NULL DEFAULT '0',
  `status` varchar(15) NOT NULL,
  `data_anuncio` date NOT NULL,
  `valor_sugerido` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `SolicitacaoApi` (
  `id` int(11) NOT NULL,
  `nome` varchar(256) NOT NULL ,
  `email` varchar(256) NOT NULL,
  `telefoneResidencial` varchar(256) NOT NULL,
  `telefoneCelular` varchar(256) NOT NULL,
  `proposta` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Apartamento`
--

CREATE TABLE `Apartamento` (
  `id_imovel_apartamento` int(11) NOT NULL,
  `porteiro` tinyint(1) DEFAULT NULL,
  `nro_andar` int(11) DEFAULT NULL,
  `valor_condominio` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `ApiCep` (
  `cep` varchar(8) NOT NULL,
  `estado` varchar(256) DEFAULT NULL,
  `cidade` varchar(256) DEFAULT NULL,
  `bairro` varchar(256) DEFAULT NULL,
  `rua` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`cep`)
);  

-- INSERT INTO ApiCep(cep,estado,cidade,bairro,rua) values('29020903','Espírito Santo', 'Vitória', 'Centro','Avenida Jurema Barroso 35');
-- INSERT INTO ApiCep(cep,estado,cidade,bairro,rua) values('87502270','Paraná', ' Umuarama', 'Jardim Aratimbó','Rua José Dias Lopes');
-- INSERT INTO ApiCep(cep,estado,cidade,bairro,rua) values('31510240','Minas Gerais', 'Belo Horizonte', 'Candelária','Rua Professora Afonsina Machado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `Cadastrar_Clientes`
--

CREATE TABLE `Cadastrar_Clientes` (
  `cpf_clientes` char(14) NOT NULL,
  `cpf_corretor` char(14) NOT NULL,
  `data_cadastro` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Cargo`
--

CREATE TABLE `Cargo` (
  `id_cargo` int(11) NOT NULL,
  `salario_base` double NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `Cargo`
--

INSERT INTO `Cargo` (`id_cargo`, `salario_base`) VALUES
(11627, 2500);


INSERT INTO `Funcionario` (`id_cargo`, `cpf_funcionario`, `data_ing`, `senha`, `usuario`) VALUES
(11627, '1', '2018-08-06', '123', 'caliton@mail.com');
-- --------------------------------------------------------

--
-- Estrutura da tabela `Clientes`
--

CREATE TABLE `Clientes` (
  `cpf_clientes` char(14) NOT NULL,
  `genero` varchar(10) NOT NULL,
  `profissao` varchar(25) NOT NULL,
  `estado_civil` varchar(10) NOT NULL,
  `email` varchar(256) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Cliente_Proprietario`
--

CREATE TABLE `Cliente_Proprietario` (
  `cpf_cliente_proprietario` char(14) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Cliente_Usuario`
--

CREATE TABLE `Cliente_Usuario` (
  `cpf_cliente_usuario` char(14) NOT NULL,
  `cpf_fiador` char(14) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Corretor`
--

CREATE TABLE `Corretor` (
  `cpf_corretor` char(14) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Forma_Pagamento`
--

CREATE TABLE `Forma_Pagamento` (
  `cpf_gerente` char(14) NOT NULL,
  `cpf_corretor` char(14) DEFAULT NULL,
  `id_FP` int(11) NOT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  `data_cadastro` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Fotos_Imovel`
--

CREATE TABLE `Fotos_Imovel` (
  `id_imovel` int(11) NOT NULL,
  `fotos` varchar(256) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Funcionario`
--

CREATE TABLE `Funcionario` (
  `id_cargo` int(11) NOT NULL,
  `cpf_funcionario` char(14) NOT NULL,
  `data_ing` date NOT NULL,
  `senha` varchar(128) NOT NULL,
  `usuario` varchar(256) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `celular` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `Funcionario`
--

INSERT INTO `Funcionario` (`id_cargo`, `cpf_funcionario`, `data_ing`, `senha`, `usuario`) VALUES
(11627, '57408670610', '2018-08-06', 'maguga1997', 'matheus@matheus.com');


INSERT INTO `Funcionario` (`id_cargo`, `cpf_funcionario`, `data_ing`, `senha`, `usuario`) VALUES
(11627, '1', '2018-08-06', '123', 'caliton@mail.com');
-- --------------------------------------------------------

--
-- Estrutura da tabela `Gerente`
--

CREATE TABLE `Gerente` (
  `cpf_gerente` char(14) NOT NULL,
  `cnpj` char(18) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Imovel`
--

CREATE TABLE `Imovel` (
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
  `id_imovel` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Indicacoes`
--

CREATE TABLE `Indicacoes` (
  `cpf_cliente_usuario` char(14) NOT NULL,
  `indicacao` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Pessoa`
--

CREATE TABLE `Pessoa` (
  `cpf` char(14) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Realizar`
--

CREATE TABLE `Realizar` (
  `cpf_corretor` char(14) NOT NULL DEFAULT '',
  `comissao` double DEFAULT NULL,
  `id_FP` int(11) DEFAULT NULL,
  `id_transacao` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Residencia`
--

CREATE TABLE `Residencia` (
  `id_imovel_residencia` int(11) NOT NULL,
  `descricao` varchar(1024) DEFAULT NULL,
  `tem_armario` tinyint(1) DEFAULT NULL,
  `nro_vaga_garagem` int(11) DEFAULT NULL,
  `qtd_sala_jantar` int(11) DEFAULT NULL,
  `qtd_sala_estar` int(11) DEFAULT NULL,
  `qtd_suit` int(11) DEFAULT NULL,
  `qtd_quartos` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Sala_Comercial`
--

CREATE TABLE `Sala_Comercial` (
  `qtd_banheiro` int(11) DEFAULT NULL,
  `qtd_comodos` int(11) DEFAULT NULL,
  `id_imovel_sala_comercial` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Telefones_Pessoa`
--

CREATE TABLE `Telefones_Pessoa` (
  `cpf_pessoa` char(14) NOT NULL,
  `telefones` varchar(13) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Terreno`
--

CREATE TABLE `Terreno` (
  `id_imovel_terreno` int(11) NOT NULL,
  `largura` float DEFAULT NULL,
  `comprimento` float DEFAULT NULL,
  `possui_AD` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `Transacao`
--

CREATE TABLE `Transacao` (
  `comissao` double DEFAULT NULL,
  `id_transacao` int(11) NOT NULL,
  `data_transacao` date NOT NULL,
  `nro_contrato` int(11) NOT NULL,
  `valor_real` double NOT NULL,
  `id_imovel` int(11) NOT NULL,
  `cpf_cliente_usuario` char(14) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Anunciar`
--
ALTER TABLE `Anunciar`
  ADD PRIMARY KEY (`id_imovel`,`cpf_cliente_proprietario`),
  ADD KEY `cpf_cliente_proprietario` (`cpf_cliente_proprietario`);

--
-- Indexes for table `Apartamento`
--
ALTER TABLE `Apartamento`
  ADD PRIMARY KEY (`id_imovel_apartamento`);

--
-- Indexes for table `Cadastrar_Clientes`
--
ALTER TABLE `Cadastrar_Clientes`
  ADD PRIMARY KEY (`cpf_clientes`),
  ADD KEY `cpf_corretor` (`cpf_corretor`);

--
-- Indexes for table `Cargo`
--
ALTER TABLE `Cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indexes for table `Clientes`
--
ALTER TABLE `Clientes`
  ADD PRIMARY KEY (`cpf_clientes`);

--
-- Indexes for table `Cliente_Proprietario`
--
ALTER TABLE `Cliente_Proprietario`
  ADD PRIMARY KEY (`cpf_cliente_proprietario`);

--
-- Indexes for table `Cliente_Usuario`
--
ALTER TABLE `Cliente_Usuario`
  ADD PRIMARY KEY (`cpf_cliente_usuario`),
  ADD KEY `cpf_fiador` (`cpf_fiador`);

--
-- Indexes for table `Corretor`
--
ALTER TABLE `Corretor`
  ADD PRIMARY KEY (`cpf_corretor`);

--
-- Indexes for table `Forma_Pagamento`
--
ALTER TABLE `Forma_Pagamento`
  ADD PRIMARY KEY (`id_FP`),
  ADD UNIQUE KEY `cpf_corretor` (`cpf_corretor`),
  ADD KEY `cpf_gerente` (`cpf_gerente`);

--
-- Indexes for table `Fotos_Imovel`
--
ALTER TABLE `Fotos_Imovel`
  ADD PRIMARY KEY (`id_imovel`,`fotos`);

--
-- Indexes for table `Funcionario`
--
ALTER TABLE `Funcionario`
  ADD PRIMARY KEY (`cpf_funcionario`),
  ADD KEY `id_cargo` (`id_cargo`);

--
-- Indexes for table `Gerente`
--
ALTER TABLE `Gerente`
  ADD PRIMARY KEY (`cpf_gerente`),
  ADD UNIQUE KEY `cnpj` (`cnpj`);

--
-- Indexes for table `Imovel`
--
ALTER TABLE `Imovel`
  ADD PRIMARY KEY (`id_imovel`),
  ADD KEY `cpf_cliente_usuario` (`cpf_cliente_usuario`);

--
-- Indexes for table `Indicacoes`
--
ALTER TABLE `Indicacoes`
  ADD PRIMARY KEY (`cpf_cliente_usuario`,`indicacao`);

--
-- Indexes for table `Pessoa`
--
ALTER TABLE `Pessoa`
  ADD PRIMARY KEY (`cpf`);

--
-- Indexes for table `Realizar`
--
ALTER TABLE `Realizar`
  ADD PRIMARY KEY (`cpf_corretor`,`id_transacao`),
  ADD KEY `id_transacao` (`id_transacao`);

--
-- Indexes for table `Residencia`
--
ALTER TABLE `Residencia`
  ADD PRIMARY KEY (`id_imovel_residencia`);

--
-- Indexes for table `Sala_Comercial`
--
ALTER TABLE `Sala_Comercial`
  ADD PRIMARY KEY (`id_imovel_sala_comercial`);

--
-- Indexes for table `Telefones_Pessoa`
--
ALTER TABLE `Telefones_Pessoa`
  ADD PRIMARY KEY (`cpf_pessoa`,`telefones`);

--
-- Indexes for table `Terreno`
--
ALTER TABLE `Terreno`
  ADD PRIMARY KEY (`id_imovel_terreno`);

--
-- Indexes for table `Transacao`
--
ALTER TABLE `Transacao`
  ADD PRIMARY KEY (`id_imovel`,`cpf_cliente_usuario`,`nro_contrato`),
  ADD UNIQUE KEY `id_transacao` (`id_transacao`),
  ADD KEY `cpf_cliente_usuario` (`cpf_cliente_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
