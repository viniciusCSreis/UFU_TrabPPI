<?php

  

  function loginAuthorized()
  {
    session_start();
    $loginAuthorized = isset($_SESSION["login_authorized"]) ? isset($_SESSION["login_authorized"]) : false;
    if(!$loginAuthorized)
    {
      http_response_code(403);
    }
    return $loginAuthorized;
  }

?>