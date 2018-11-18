<?php

require_once (dirname(__FILE__) . "/../helper/conexao.php");

function save($sqlArray,$bindParamArray)
{
    $conn = createConn();
    if ($conn == null) {
        exit(saveErrorMensage($sqlArray,$bindParamArray,"Error Ao criar conn"));
    }

    try {
        if(!$conn->begin_transaction())
        {
            exit(saveErrorMensage($sqlArray,$bindParamArray,"Error Ao criar begin_transaction"));
        }
        for($index=0;$index<sizeof($sqlArray);$index++)
        {

            $stmt = $conn->prepare($sqlArray[$index]);
            call_user_func_array(array($stmt, "bind_param"), $bindParamArray[$index]);
            if (! $stmt->execute()) {
                exit(saveErrorMensage($sqlArray[$index],$bindParamArray[$index],"Error ao executar stmt:".$stmt->error));
            }
            $id = $stmt->insert_id;

        }

        if ($conn->commit()) {
            return $id;
        }
    } catch (Exception $e) {
        echo $e;
        $conn->rollback();
        return 0;
    }
}
function saveErrorMensage($sql,$bindParam,$error){
    $msg = "Error:$error\nsql:".json_encode($sql)."\nbingParam:".json_encode($bindParam);
    return $msg;
}


?>