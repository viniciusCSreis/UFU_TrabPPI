<?php


require_once (dirname(__FILE__) . "/sql.php");


function saveSolicitacao($solicitacao)
{
    $date = date('Y-m-d');
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
            $date

        ];

    $solicitacao->id = save($sql,$bindParam);
    $solicitacao->data = $date;
    return $solicitacao;
}

function deleteSolicitacao($id)
{
    $sql[0] = "DELETE FROM `SolicitacaoApi` WHERE id = ?";
    $bindParam[0] =["i",$id];
    save($sql,$bindParam);
}


?>