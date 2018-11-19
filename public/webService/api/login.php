<?php
  error_reporting(E_ERROR | E_PARSE);
  require('../helper/filter.php');
  require_once('../helper/conexao.php');
  session_start();

  $email = filtraEntrada($_POST["email"]);
  $password = filtraEntrada( $_POST["password"]);

  // --- me ----

  function loginFuncionario($email, $senha, $mysqli)
  {

    $SQL = "
      SELECT  usuario, senha  
      FROM Funcionario
      WHERE usuario = ?
      LIMIT 1
    ";
    
    $stmt = $mysqli->prepare($SQL);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();


    
    // Resgata o resultado nas variáveis
    $stmt->bind_result($nomeUsuario,$senhaHash);
    $stmt->fetch();

    if ($stmt->num_rows == 1)
    {   /*password_verify($senha, $senhaHash)*/
      if(hash('sha512',$senha) == $senhaHash)
      {
        // Senha correta
              
        // Armazena dados úteis para confirmação de login
        // em outros scripts PHP
       
        $_SESSION['nomeUsuario'] = $nomeUsuario;
       // $_SESSION['loginString'] = hash('sha512', $senhaHash . $_SERVER['HTTP_USER_AGENT']);
        
        // Sucesso no login
        return true;
      }
      else
      {
        // Senha incorreta
        return false;
      }
    }
    else
    {
      // Usuário não existe
      return false;
    }
  }

  try
  {
      $mysqli = createConn();
      if(loginFuncionario( $email, $password, $mysqli))
      {   
                 
          $_SESSION["login_authorized"] = true;
          echo "Login realizado com sucesso!";
                  
          
      }
      else
      {
         
          http_response_code(403);
          echo "Login não realizado";
          
      }

    

  }catch(Exception $e)
  {
      $msgErro = $e->getMessage();

      if ($msgErro == "")
      {
        echo "Sem erro no script!";
          
      }    
      else
      echo "Login não realizado: $msgErro";
  }
  
 
?>