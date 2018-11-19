<?php
// Conexao Online
define("HOST", "localhost");
define("USER", "ejtechmo_matheus");
define("PASSWORD", "b].@XoCp,AZ*");
define("DATABASE", "ejtechmo_trabalho_ppi");

//docker
define("HOST2", "192.168.70.2"); 
define("USER2", "vinicius");
define("PASSWORD2", "password"); 
define("DATABASE2", "ejtechmo_trabalho_ppi");

function createConn()
{
    $conn=null;
      
  try {
      $conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
      if ($conn->connect_error || $conn == null) {
                  
        if ($conn->connect_error) {
          $conn = new mysqli(HOST2, USER2, PASSWORD2, DATABASE2);
          if ($conn->connect_error) {
              throw new Exception('Falha na conexão com o MySQL: ' . $conn->connect_error);
          }
          }
      }
  }catch(Exception $e){
      http_response_code(500);
      $conn=null;
  }finally{
      return $conn;
  }

}

?>
