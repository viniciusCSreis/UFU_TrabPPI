<?php
header('Access-Control-Allow-Origin: *');
$method = $_SERVER["REQUEST_METHOD"];
    if ($method == "POST") {
    require '../service/funcionario/create.php';
}
if ($method == "GET") {
    require '../service/funcionario/list.php';
}
if ($method == "DELETE") {
    require '../service/funcionario/delete.php';
}
if ($method == "PUT") {
    require '../service/funcionario/update.php';
}
