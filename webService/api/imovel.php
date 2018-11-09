<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "GET") 
{
    require '../service/imovel/list.php';
}
if ($method == "POST") {
    require '../service/imovel/create.php';
}
if ($method == "DELETE") {
    require '../service/imovel/delete.php';
}

?>