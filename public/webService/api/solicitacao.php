<?php
    header('Access-Control-Allow-Origin: *');
    $method = $_SERVER["REQUEST_METHOD"];

    if ($method == "GET")
    {
        require '../service/solicitacoes/list.php';
    }

?>