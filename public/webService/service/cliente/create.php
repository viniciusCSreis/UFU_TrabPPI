<?php
require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
    return;
}



require (dirname(__FILE__) . "/../../helper/filter.php");
require (dirname(__FILE__) . "/../../dao/cliente.php");
require (dirname(__FILE__) . "/../../model/cliente.php");
require (dirname(__FILE__) . "/../../model/endereco.php");

$_POST = filterArray($_POST);//filtra todos os dados enviados pelo method POST

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
$profissao = $_POST["profissao"];
if(!isset($profissao)|| $profissao == ""){
    http_response_code(400);
    return;
}
$email = $_POST["email"];
if(!isset($email)|| $email == ""){
    http_response_code(400);
    return;
}
$genero = $_POST["genero"];
if(!isset($genero)|| $genero == ""){
    http_response_code(400);
    return;
}
$estadoCivil = $_POST["estadoCivil"];
if(!isset($estadoCivil)|| $estadoCivil == ""){
    http_response_code(400);
    return;
}

$cliente = new Cliente();
$endereco = new Endereco();

$cliente->nome = $nome;
$cliente->cpf = $cpf;
$endereco->cep = $cep;
$endereco->cidade = $cidade;
$endereco->estado = $estado;
$endereco->rua = $rua;
$endereco->numero = $numero;
$endereco->bairro = $bairro;
$cliente->Endereco = $endereco;
$cliente->profissao = $profissao;
$cliente->email = $email;
$cliente->genero = $genero;
$cliente->estadoCivil = $estadoCivil;



if(clienteSave($cliente)){
    http_response_code(201);
    echo json_encode($cliente);
}else{
    http_response_code(500);
}



?>