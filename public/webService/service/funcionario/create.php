<?php

require (dirname(__FILE__) . "/../../helper/filter.php");
require (dirname(__FILE__) . "/../../dao/funcionario.php");
require (dirname(__FILE__) . "/../../model/funcionario.php");
require (dirname(__FILE__) . "/../../model/endereco.php");

require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
    return;
}

$_POST = filterArray($_POST);

$email = $_POST["email"];
if(!isset($email) || $email == ""){
    http_response_code(400);
    return;
}

$senha = $_POST["senha"];
if(!isset($senha) || $senha == ""){
    http_response_code(400);
    return;
}

$nome = $_POST["nome"];
if(!isset($nome) || $nome == ""){
    http_response_code(400);
    return;
}

$cpf = $_POST["cpf"];
if(!isset($cpf) || $cpf == ""){
    http_response_code(400);
    return;
}

$cargo = $_POST["cargo"];
if(!isset($cargo) || $cargo == ""){
    http_response_code(400);
    return;
}

$dataInicio = $_POST["dataInicio"];
if(!isset($dataInicio) || $dataInicio == ""){
    http_response_code(400);
    return;
}

$telefone = $_POST["telefone"];
if(!isset($telefone) || $telefone == ""){
    http_response_code(400);
    return;
}

$celular = $_POST["cpf"];
if(!isset($celular) || $celular == ""){
    http_response_code(400);
    return;
}

// Endereço
$cep = $_POST["cep"];
if(!isset($cep) || $cep == ""){
    http_response_code(400);
    return;
}
$cidade = $_POST["cidade"];
if(!isset($cidade) || $cidade == ""){
    http_response_code(400);
    return;
}
$estado = $_POST["uf"];
if(!isset($estado) || $estado == ""){
    http_response_code(400);
    return;
}
$rua = $_POST["rua"];
if(!isset($rua) || $rua == ""){
    http_response_code(400);
    return;
}
$numero = $_POST["numero"];
if(!isset($numero)|| $numero == ""){
    http_response_code(400);
    return;
}
$bairro = $_POST["bairro"];
if(!isset($bairro)|| $bairro == ""){
    http_response_code(400);
    return;
}


$funcionario = new funcionario();
$endereco = new Endereco();

$funcionario->usuario = $email;
$funcionario->senha = $senha;
$funcionario->nome = $nome;
$funcionario->cpf = $cpf;
$funcionario->dataInicio = $dataInicio;
$funcionario->cargo = $cargo;
$funcionario->telefone = $telefone;
$funcionario->celular = $celular;

$endereco->cep = $cep;
$endereco->cidade = $cidade;
$endereco->estado = $estado;
$endereco->rua = $rua;
$endereco->numero = $numero;
$endereco->bairro = $bairro;

$funcionario->Endereco = $endereco;

if(funcionarioSave($funcionario)){
    http_response_code(201);
    echo json_encode($funcionario);
}else{
    http_response_code(500);
}
