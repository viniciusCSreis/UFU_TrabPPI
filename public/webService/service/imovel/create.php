<?php
require_once (dirname(__FILE__) . "/../../helper/filter.php");
require_once (dirname(__FILE__) . "/../../dao/cliente.php");
require_once (dirname(__FILE__) . "/../../dao/imovel.php");
require_once (dirname(__FILE__) . "/../../model/imovel.php");
require_once (dirname(__FILE__) . "/../../model/cliente.php");
require_once (dirname(__FILE__) . "/../../model/endereco.php");

require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
    return;
}

$fotos = json_decode($_POST["fotos"]);
if (!isset($fotos) ) {
    http_response_code(400);
    echo "kd fotos";
    return;
}
$_POST = filterArray($_POST); // filtra todos os dados enviados pelo method POST

$cep = $_POST["cep"];
if (! isset($cep) || $cep == "") {
    http_response_code(400);
    echo "kd cep";
    return;
}
$cidade = $_POST["cidade"];
if (! isset($cidade) || $cidade == "") {
    http_response_code(400);
    echo "kd cidade";
    return;
}
$estado = $_POST["uf"];
if (! isset($estado) || $estado == "") {
    http_response_code(400);
    echo "kd uf";
    return;
}
$rua = $_POST["rua"];
if (! isset($rua) || $rua == "") {
    http_response_code(400);
    echo "kd rua";
    return;
}
$numero = $_POST["numero"];
if (! isset($numero) || $numero == "") {
    http_response_code(400);
    echo "kd numero";
    return;
}
$bairro = $_POST["bairro"];
if (! isset($bairro) || $bairro == "") {
    http_response_code(400);
    echo "kd bairro";
    return;
}
$cpfCliente = $_POST["cpfCliente"];
if (! isset($cpfCliente) || $cpfCliente == "") {
    http_response_code(400);
    echo "kd cpfCliente";
    return;
}
$area = $_POST["area"];
if (! isset($area) || $area == "") {
    http_response_code(400);
    echo "kd area";
    return;
}
$armarioEmbutido = $_POST["armarioEmbutido"];
if (! isset($armarioEmbutido) || $armarioEmbutido == "") {
    http_response_code(400);
    echo "kd armarioEmbutido";
    return;
}
$dataConstrucao = $_POST["dataConstrucao"];
if (! isset($dataConstrucao) || $dataConstrucao == "") {
    http_response_code(400);
    echo "kd dataConstrucao";
    return;
}
$descricao = $_POST["descricao"];
if (! isset($descricao) || $descricao == "") {
    http_response_code(400);
    echo "kd descricao";
    return;
}

$qtdQuartos = $_POST["qtdQuartos"];
if (! isset($qtdQuartos) || $qtdQuartos == "") {
    http_response_code(400);
    echo "kd qtdQuartos";
    return;
}
$qtdSalaEstar = $_POST["qtdSalaEstar"];
if (! isset($qtdSalaEstar) || $qtdSalaEstar == "") {
    http_response_code(400);
    echo "kd qtdSalaEstar";
    return;
}
$qtdSalaJantar = $_POST["qtdSalaJantar"];
if (! isset($qtdSalaJantar) || $qtdSalaJantar == "") {
    http_response_code(400);
    echo "kd qtdSalaJantar";
    return;
}
$qtdSuites = $_POST["qtdSuites"];
if (! isset($qtdSuites) || $qtdSuites == "") {
    http_response_code(400);
    echo "kd qtdSuites";
    return;
}
$qtdVagasGaragem = $_POST["qtdVagasGaragem"];
if (! isset($qtdVagasGaragem) || $qtdVagasGaragem == "") {
    http_response_code(400);
    echo "kd qtdVagasGaragem";
    return;
}
$tipoAnuncio = $_POST["tipoAnuncio"];
if (! isset($tipoAnuncio) || $tipoAnuncio == "") {
    http_response_code(400);
    echo "kd tipoAnuncio";
    return;
}
$tipoImovel = $_POST["tipoImovel"];
if (! isset($tipoImovel) || $tipoImovel == "") {
    http_response_code(400);
    echo "kd tipoImovel";
    return;
}
$valorImovel = $_POST["valorImovel"];
if (! isset($valorImovel) || $valorImovel == "") {
    http_response_code(400);
    echo "kd valorImovel";
    return;
}
if ($tipoImovel == "Apartamento") {
    $porteiro24h = $_POST["porteiro24h"];
    if (! isset($porteiro24h) || $porteiro24h == "") {
        http_response_code(400);
        echo "kd porteiro24h";
        return;
    }
    $andar = $_POST["andar"];
    if (! isset($andar) || $andar == "") {
        http_response_code(400);
        echo "kd andar";
        return;
    }
    $valorCondominio = $_POST["valorCondominio"];
    if (! isset($valorCondominio) || $valorCondominio == "") {
        http_response_code(400);
        echo "kd valorCondominio";
        return;
    }
}

$clienteProprietario = null;
$clientes = clienteList();
foreach ($clientes as $cliente) {
    if ($cliente->cpf == $cpfCliente)
        $clienteProprietario = $cliente;
}
if ($clienteProprietario == null) {
    http_response_code(400);
    return;
}

$endereco = new Endereco();
$endereco->cep = $cep;
$endereco->cidade = $cidade;
$endereco->estado = $estado;
$endereco->rua = $rua;
$endereco->numero = $numero;
$endereco->bairro = $bairro;


$imovel = new Imovel();
$imovel->area = $area;
$imovel->armarioEmbutido = $armarioEmbutido;
$imovel->Cliente = $clienteProprietario;
$imovel->dataConstrucao = $dataConstrucao;
$imovel->descricao = $descricao;
$imovel->Endereco = $endereco;
$imovel->fotos = $fotos->fotos;
$imovel->qtdQuartos = $qtdQuartos;
$imovel->qtdSalaEstar = $qtdSalaEstar;
$imovel->qtdSalaJantar = $qtdSalaJantar;
$imovel->qtdSuites = $qtdSuites;
$imovel->qtdVagasGaragem = $qtdVagasGaragem;
$imovel->tipoAnuncio = $tipoAnuncio;
$imovel->tipoImovel = $tipoImovel;
$imovel->valorImovel = $valorImovel;
$imovel->disponibilidade=1;
if($tipoImovel == "Apartamento"){
    $imovel->valorCondominio = $valorCondominio;
    $imovel->andar= $andar;
    $imovel->porteiro24h = $porteiro24h;
}
header('Content-Type: application/json');
$id = imovelSave($imovel);
if( $id != 0){
    $imovel->id = $id;
    echo json_encode($imovel);
}




?>