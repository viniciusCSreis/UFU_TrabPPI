<?php

require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
    return;
}

require_once (dirname(__FILE__) . "/../../model/solicitacao.php");
require_once (dirname(__FILE__) . "/../../helper/conexao.php");
require_once (dirname(__FILE__) . "/../../helper/filter.php");
require_once (dirname(__FILE__) . "/../../dao/solicitacao.php");


$_DELETE = null;
parse_str(file_get_contents('php://input'),$_DELETE);//pega os dados enviados e armazena em $_DELETE
$_DELETE = filterArray($_DELETE);

$id = $_DELETE["id"];
if(!isset($id) || $id == ""){
    http_response_code(400);
    return ;
}
deleteSolicitacao($id);
http_response_code(204);





?>