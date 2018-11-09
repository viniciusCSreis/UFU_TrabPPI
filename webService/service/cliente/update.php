<?php
require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
    return;
}

require (dirname(__FILE__) . "/../../helper/filter.php");
require (dirname(__FILE__) . "/../../dao/cliente.php");
require (dirname(__FILE__) . "/../../model/cliente.php");
require (dirname(__FILE__) . "/../../model/endereco.php");

$_PUT = null;
parse_str(file_get_contents('php://input'),$_PUT);//pega os dados enviados e armazena em $_PUT


$_PUT = filterArray($_PUT);//filtra todos os dados enviados pelo method POST

$nome = $_PUT["nome"];
if(!isset($nome) || $nome == ""){
    http_response_code(400);
    return;
}
$cpf = $_PUT["cpf"];
if(!isset($cpf) || $cpf == ""){
    http_response_code(400);
    return;
}
$cep = $_PUT["cep"];
if(!isset($cep) || $cep == ""){
    http_response_code(400);
    return;
}
$cidade = $_PUT["cidade"];
if(!isset($cidade) || $cidade == ""){
    http_response_code(400);
    return;
}
$estado = $_PUT["uf"];
if(!isset($estado) || $estado == ""){
    http_response_code(400);
    return;
}
$rua = $_PUT["rua"];
if(!isset($rua) || $rua == ""){
    http_response_code(400);
    return;
}
$numero = $_PUT["numero"];
if(!isset($numero)|| $numero == ""){
    http_response_code(400);
    return;
}
$bairro = $_PUT["bairro"];
if(!isset($bairro)|| $bairro == ""){
    http_response_code(400);
    return;
}
$profissao = $_PUT["profissao"];
if(!isset($profissao)|| $profissao == ""){
    http_response_code(400);
    return;
}
$email = $_PUT["email"];
if(!isset($email)|| $email == ""){
    http_response_code(400);
    return;
}
$genero = $_PUT["genero"];
if(!isset($genero)|| $genero == ""){
    http_response_code(400);
    return;
}
$estadoCivil = $_PUT["estadoCivil"];
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



if(clienteUpdate($cliente)){
    http_response_code(200);
    echo json_encode($cliente);
}else{
    http_response_code(500);
}



?>