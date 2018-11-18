USE `ejtechmo_trabalho_ppi`;
INSERT INTO `ApiCep`
(
  `cep`,
  `estado`,
  `cidade`,
  `bairro`,
  `rua`
) VALUES
(
  '12345678',
  'testeEstado',
  'testeCidade',
  'testeBairro',
  'testeRua'
);



--
-- Banco de dados: `ejtechmo_trabalho_ppi`
--

--
-- Fazendo dump de dados para tabela `Clientes`
--

INSERT INTO `Clientes` (`cpf_clientes`, `genero`, `profissao`, `estado_civil`, `email`) VALUES
('425', 'masculino', 'Engenheiro', 'casado', 'carlosmgjn@techmob.com.br'),
('135', 'masculino', 'Programador', 'solteiro', 'vinicius.clemente@ufu.br'),
('022', 'masculino', 'Programador', 'viuvo', 'mkllamskldmalksd2@21km2.com');

--
-- Fazendo dump de dados para tabela `Funcionario`
--

INSERT INTO `Funcionario` (`id_cargo`, `cpf_funcionario`, `data_ing`, `senha`, `usuario`, `telefone`, `celular`) VALUES
(1, '2', '2008-07-04', '5d68217d0c3ddfc029f1f8f2e61a80a8256342f27893ff0fe55da861e75325d6f7c805a26cae587f01aee7980700e8f06422c233a0e2a8e9bf26aad0c39e00c6', 'teste@ufu.br', '1', '1'),
(1, '12345678910', '2018-11-29', 'a1102957491b9ce5441e111f7725f2fd0201bc32465e2536e5182d1c5e3f6b0965355c09f2c8b9111ab6d18a73b75f0f3a06e788bd2a6dff4ddc7c4da6ada603', 'admin@ufu.br', '34 3255 3255', '12345678910');

--
-- Fazendo dump de dados para tabela `Pessoa`
--

INSERT INTO `Pessoa` (`cpf`, `nome`, `endereco`) VALUES
('135', 'vinicius clemente de sousa reis', '{\"cep\":\"12345678\",\"cidade\":\"uberl\\u00e2ndia\",\"estado\":\"MG\",\"rua\":\"Rua Gafanhoto\",\"numero\":\"103\",\"bairro\":\"testeBairro\"}'),
('425', 'Carlos', '{\"cep\":\"12345678\",\"cidade\":\"testeCidade\",\"estado\":\"testeEstado\",\"rua\":\"testeRua\",\"numero\":\"101\",\"bairro\":\"testeBairro\"}'),
('022', 'Matheus', '{\"cep\":\"12345678\",\"cidade\":\"testeCidade\",\"estado\":\"testeEstado\",\"rua\":\"testeRua\",\"numero\":\"105\",\"bairro\":\"testeBairro\"}'),
('12345678910', 'admin', '{\"cep\":\"12345678\",\"cidade\":\"testeCidade\",\"estado\":\"testeEstado\",\"rua\":\"testeRua\",\"numero\":\"99\",\"bairro\":\"testeBairro\"}');