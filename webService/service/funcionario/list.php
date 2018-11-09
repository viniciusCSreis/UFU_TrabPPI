<?php
require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
    return;
}
require (dirname(__FILE__) . "/../../model/endereco.php");
require (dirname(__FILE__) . "/../../dao/funcionario.php");


echo json_encode(funcionarioList());

// $funcionario = new Funcionario();
// $endereco = new Endereco();
// $funcionario->cargo = "vendedor";
// $funcionario->cpf = "45645645645";
// $funcionario->dataInicio = "18/12/2018";
// $funcionario->email = "test2@test";
// $endereco->bairro = "granada2";
// $endereco->cep = "38400101";
// $endereco->cidade = "uberlândia";
// $endereco->estado = "minas gerais";
// $endereco->numero = "102";
// $endereco->rua = "rua do jõao2";
// $funcionario->Endereco = $endereco;
// $funcionario->nome = "funcionario2";
// $funcionario->telefoneCelular = "34998989999";
// $funcionario->telefoneResidencial = "34998989999";
//
// $funcionarios[] = $funcionario;
