<?php
require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
return;
}
require (dirname(__FILE__) . "/../../model/endereco.php");
require (dirname(__FILE__) . "/../../dao/funcionario.php");
require (dirname(__FILE__) . "/../../helper/filter.php");

$_DELETE = null;
parse_str(file_get_contents('php://input'),$_DELETE);//pega os dados enviados e armazena em $_DELETE
$_DELETE = filterArray($_DELETE);

$cpf = $_DELETE["cpf"];
if(!isset($cpf) || $cpf == ""){
    http_response_code(400);
    return ;
}

if (funcionarioDelete($cpf)) {
    http_response_code(204);
} else {
    http_response_code(500);
}
