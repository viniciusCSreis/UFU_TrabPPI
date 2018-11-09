<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST") {
require '../service/cliente/create.php';
}
if ($method == "GET") {
    require '../service/cliente/list.php';
}
if ($method == "DELETE") {
    require '../service/cliente/delete.php';
}
if ($method == "PUT") {
    require '../service/cliente/update.php';
}

?>