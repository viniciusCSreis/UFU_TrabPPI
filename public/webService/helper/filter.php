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

    function loadClass($class,$data,$ignoreArray){

        $data = filterArray($data);
        foreach (get_object_vars($class) as $key => $value)
        {
            if (in_array ( $key , $ignoreArray))
            {
                continue;
            }
            if(!isset($data[$key]) || $data[$key] == ""){
                http_response_code(400);
                exit("$key not send");
            }
            $class->$key = $data[$key];
        }
        return $class;

    }

?>