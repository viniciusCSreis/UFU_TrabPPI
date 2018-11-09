<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "GET") {
    require '../service/cep/list.php';
}

?>