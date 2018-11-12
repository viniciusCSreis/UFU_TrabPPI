<?php
// Conexao Online
// define("HOST", "localhost");
// define("USER", "ejtechmo_matheus");
// define("PASSWORD", "b].@XoCp,AZ*");
// define("DATABASE", "ejtechmo_trabalho_ppi");

//Conexao Local
define("HOST", "localhost");
define("USER", "caliton");
define("PASSWORD", "batata+banana=3");
define("DATABASE", "ejtechmo_trabalho_ppi");

// define("HOST", "localhost");
// define("USER", "vinicius");
// define("PASSWORD", "password");
// define("DATABASE", "ejtechmo_trabalho_ppi");

function createConn()
{
    $conn=null;
  try {
      $conn = new mysqli(HOST, USER, PASSWORD, DATABASE);
      if ($conn->connect_error) {
          throw new Exception('Falha na conexão com o MySQL: ' . $conn->connect_error);
      }
  }catch(Exception $e){
      echo $e;
      http_response_code(500);
      $conn=null;
  }finally{
      return $conn;
  }

}

?>
