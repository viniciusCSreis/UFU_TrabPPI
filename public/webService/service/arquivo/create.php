<?php
require (dirname(__FILE__) . "/../../helper/login.php");
if (! loginAuthorized()) {
    return;
}

if (isset($_FILES['fileUpload']) && $_FILES['fileUpload'] != '') {
    $ext = strtolower(substr($_FILES['fileUpload']['name'], - 4)); // Pegando extensão do arquivo
    $randonInt = random_int(0, 1000000);
    $new_name = $randonInt.'_'.date("Y.m.d-H.i.s") . $ext; // Definindo um novo nome para o arquivo
    $dir = '/uploads/'; // Diretório para uploads
    move_uploaded_file($_FILES['fileUpload']['tmp_name'], dirname(__FILE__) .$dir . $new_name); // Fazer upload do arquivo
    http_response_code(201);
    echo $_SERVER["SERVER_NAME"]."/webService/service/arquivo" .$dir . $new_name;
    
}else{
    http_response_code(400);
}
?>