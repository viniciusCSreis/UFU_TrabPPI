<?php
require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
return;
}
require (dirname(__FILE__) . "/../../dao/imovel.php");
require (dirname(__FILE__) . "/../../helper/filter.php");

$_DELETE = null;
parse_str(file_get_contents('php://input'),$_DELETE);//pega os dados enviados e armazena em $_DELETE
$_DELETE = filterArray($_DELETE);

$id = $_DELETE["id"];
if(!isset($id) || $id == ""){
    http_response_code(400);
    return ;
}

if (imovelDelete($id)) {
    http_response_code(204);
} else {
    http_response_code(500);
}

?>