<?php


require_once (dirname(__FILE__) . "/sql.php");


function saveSolicitacao($solicitacao)
{
    $sql[0] = "
        INSERT INTO `SolicitacaoApi` 
        (
          `id`,
          `nome`,
          `email`,
          `telefoneResidencial`,
          `telefoneCelular`,
          `proposta`,
          `id_imovel`,
          `data`
        ) 
        VALUES 
        (
          ?, ?, ?, ?, ?, ?, ?, ?
        );
       ";
    $bindParam[0] =
        [
            "isssssss",
            null,
            $solicitacao->nome,
            $solicitacao->email,
            $solicitacao->telefoneR,
            $solicitacao->telefoneC,
            $solicitacao->proposta,
            $solicitacao->idImovel,
            $solicitacao->data
        ];

    $solicitacao->id = save($sql,$bindParam);
    return $solicitacao;
}


?>