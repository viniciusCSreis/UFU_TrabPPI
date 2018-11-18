<?php
error_reporting(E_ERROR | E_PARSE);
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "GET")
{
    require '../service/solicitacoes/list.php';
}
if ($method == "POST")
{
    require '../service/solicitacoes/create.php';
}

?>