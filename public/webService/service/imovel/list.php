<?php

require_once (dirname(__FILE__) . "/../../model/imovel.php");
require_once (dirname(__FILE__) . "/../../model/cliente.php");
require_once (dirname(__FILE__) . "/../../model/endereco.php");
require_once (dirname(__FILE__) . "/../../dao/imovel.php");
require_once (dirname(__FILE__) . "/../../helper/filter.php");
require_once (dirname(__FILE__) . "/../../model/search.php");


if(isset($_GET['tipoAnuncio'])){
    
    $_GET = filterArray($_GET);
    $tipoAnuncio = $_GET['tipoAnuncio'];
    $cidade = $_GET['cidade'];
    $bairro = $_GET['bairro'];
    $valorMin = $_GET['valorMin'];
    $valorMax = $_GET['valorMax'];
    $descricao = $_GET['descricao'];

    if(!isset($_GET['valorMin']) || $valorMin == "")$valorMin=PHP_INT_MIN;
    if(!isset($_GET['valorMax']) || $valorMax == "")$valorMax=PHP_INT_MAX;


    $search = new Search();
    $search->tipoAnuncio=$tipoAnuncio;
    $search->cidade=$cidade;
    $search->bairro=$bairro;
    $search->valorMin=$valorMin;
    $search->valorMax=$valorMax;
    $search->descricao=$descricao;
    echo json_encode(searchImovel($search));
    
}else {
  echo json_encode(imovelList());
}



?>