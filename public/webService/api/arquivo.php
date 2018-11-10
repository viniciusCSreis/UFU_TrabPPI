<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/text');
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST") {
    require '../service/arquivo/create.php';
}

?>