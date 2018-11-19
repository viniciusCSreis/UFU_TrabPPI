<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
error_reporting(E_ERROR | E_PARSE);
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "GET") {
    require '../service/cep/list.php';
}

?>