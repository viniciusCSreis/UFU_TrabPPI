<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/text');
error_reporting(E_ERROR | E_PARSE);
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST") {
    require '../service/arquivo/create.php';
}

?>