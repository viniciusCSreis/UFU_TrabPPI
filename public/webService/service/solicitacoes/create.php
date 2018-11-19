<?php


require_once (dirname(__FILE__) . "/../../model/solicitacao.php");
require_once (dirname(__FILE__) . "/../../dao/solicitacao.php");
require_once (dirname(__FILE__) . "/../../helper/filter.php");



$solicitacao = new Solicitacao();
$solicitacao = loadClass($solicitacao,$_POST,["id","data"]);
$solicitacao = saveSolicitacao($solicitacao);

if($solicitacao->id != 0){
    http_response_code(201);
    echo json_encode($solicitacao);
}else{
    http_response_code(500);
    exit("error ao savar solicitação");
}





?>