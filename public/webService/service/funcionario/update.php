<?php
require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
    return;
}

// email
// senha
// nome
// cpf
// endereco
// telefone
// dataInicio
// cargo


require (dirname(__FILE__) . "/../../helper/filter.php");
require (dirname(__FILE__) . "/../../dao/funcionario.php");
require (dirname(__FILE__) . "/../../model/funcionario.php");
require (dirname(__FILE__) . "/../../model/endereco.php");

$_PUT = null;
parse_str(file_get_contents('php://input'),$_PUT);//pega os dados enviados e armazena em $_PUT


$_PUT = filterArray($_PUT);//filtra todos os dados enviados pelo method POST

$email = $_PUT["email"];
if(!isset($email)|| $email == ""){
    http_response_code(400);
    return;
}

$senha = $_PUT["senha"];
if(!isset($senha) || $senha == ""){
    http_response_code(400);
    return;
}

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



$funcionario = new Funcionario();
$endereco = new Endereco();

$funcionario->usuario = $email;
$funcionario->senha = $senha;
$funcionario->nome = $nome;
$funcionario->cpf = $cpf;
$funcionario->cargo = $cargo;

$endereco->cep = $cep;
$endereco->cidade = $cidade;
$endereco->estado = $estado;
$endereco->rua = $rua;
$endereco->numero = $numero;
$endereco->bairro = $bairro;

$funcionario->Endereco = $endereco;

// email
// senha
// nome
// cpf
// endereco
// telefone
// dataInicio
// cargo

if(funcionarioUpdate($funcionario)){
    http_response_code(200);
    echo json_encode($funcionario);
}else{
    http_response_code(500);
}



?>
