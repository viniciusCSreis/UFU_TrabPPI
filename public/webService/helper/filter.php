<?php

  function filterArray($arrayEnviado){
      foreach ($arrayEnviado as $key => $value) {
          $value = trim($value);
          $value = stripslashes($value);
          $value = htmlspecialchars($value);
          $arrayEnviado[$key] = $value;
      }
      return $arrayEnviado;
    }

    function filtraEntrada($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>