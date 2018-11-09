<?php
require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
    return;
}

require_once (dirname(__FILE__) . "/../../helper/conexao.php");
require_once (dirname(__FILE__) . "/../../helper/filter.php");
require_once (dirname(__FILE__) . "/../../model/endereco.php");



$_GET = filterArray($_GET);
$conn = createConn();

$sql = 'SELECT estado, cidade, bairro, rua from ApiCep where cep = ? ';

$stmp = $conn->prepare($sql);
if(!$stmp){
    echo "error no prepare";
    return;
}
if(!$stmp->bind_param("s", $_GET['cep']));
if(!$stmp->execute()){
    echo "error no execute";
    return;
}
$estado = null;
$cidade = null;
$bairro = null;
$rua = null;

$stmp->store_result();
$stmp->bind_result($estado, $cidade, $bairro, $rua);
$stmp->fetch();

$endereco = new Endereco();
$endereco->estado = $estado;
$endereco->cidade = $cidade;
$endereco->bairro = $bairro;
$endereco->rua = $rua;



$json = json_encode($endereco);
if(!$json){
    echo "erro no json";
    return ;
}
echo $json;

?>