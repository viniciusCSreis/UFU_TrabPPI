<?php 

require (dirname(__FILE__) ."/../helper/conexao.php");
    print_r(file_get_contents('php://input'));
    echo '<pre>';
    print_r($_GET);
    echo '<br>';
    print_r($_REQUEST);
    echo '<br>';
    print_r($_SERVER);
    echo '<br>';
    echo '</pre>';
    if(createConn() != null)
    {
        echo "ok";
    }
    else
    {
        echo "fail";
    }

    echo hash('sha512','oi');

?>