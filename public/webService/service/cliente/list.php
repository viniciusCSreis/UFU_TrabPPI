<?php
require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
    return;
}
require (dirname(__FILE__) . "/../../model/endereco.php");
require (dirname(__FILE__) . "/../../dao/cliente.php");

echo json_encode(clienteList());

?>