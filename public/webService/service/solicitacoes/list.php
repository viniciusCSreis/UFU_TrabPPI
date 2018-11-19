<?php
require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
return;
}

require_once (dirname(__FILE__) . "/../../model/solicitacao.php");
require_once (dirname(__FILE__) . "/../../helper/conexao.php");


$solicitacoes = array();

$sql = 'SELECT * FROM SolicitacaoApi';

$conn = createConn();

$resultado = $conn->query($sql);
if ($resultado->num_rows > 0)
{
 while ($row = $resultado->fetch_assoc())
 {
    $solicitacao = new Solicitacao();
    $solicitacao->id = $row['id'];
    $solicitacao->nome = $row['nome'];
    $solicitacao->email = $row['email'];
    $solicitacao->telefoneR = $row['telefoneResidencial'];
    $solicitacao->telefoneC = $row['telefoneCelular'];
    $solicitacao->proposta = $row['proposta'];
    $solicitacao->idImovel = $row['id_imovel'];
    $solicitacao->data = $row['data'];

    $solicitacoes[] = $solicitacao;
  }
  echo json_encode($solicitacoes);
}
else{
    echo "[]";
}




?>