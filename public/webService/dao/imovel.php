<?php
require_once (dirname(__FILE__) . '/../helper/conexao.php');
require_once (dirname(__FILE__) . "/../model/imovel.php");
require_once (dirname(__FILE__) . "/../model/cliente.php");
require_once (dirname(__FILE__) . "/../model/endereco.php");


function insertIntoImovel($conn,$imovel,$id){
    $sql = "INSERT INTO Imovel (
            cpf_cliente_usuario,
            numero,
            cep,
            estado,
            rua,
            cidade,
            bairro,
            disponibilidade,
            data_construcao,
            area,
            id_imovel
        )VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param(
        "sisssssissi",
        $imovel->Cliente->cpf,
        $imovel->Endereco->numero,
        $imovel->Endereco->cep,
        $imovel->Endereco->estado,
        $imovel->Endereco->rua,
        $imovel->Endereco->cidade,
        $imovel->Endereco->bairro,
        $imovel->disponibilidade,
        $imovel->dataConstrucao,
        $imovel->area,
        $id
        );
    if (!$stmt->execute()) {
        throw new RuntimeException($stmt->error);
    }
}
function insertIntoResidencia($conn,$imovel,$id){
    $sql = "INSERT INTO Residencia
            (
                id_imovel_residencia,
                descricao,
                tem_armario,
                nro_vaga_garagem,
                qtd_sala_jantar,
                qtd_sala_estar,
                qtd_suit,
                qtd_quartos
            ) VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
    
    if(!$stmt = $conn->prepare($sql)){
        throw new RuntimeException($conn->error);
    }
    if(!$stmt->bind_param(
        "isiiiiii",
        $id,
        $imovel->descricao,
        $imovel->armarioEmbutido,
        $imovel->qtdVagasGaragem,
        $imovel->qtdSalaJantar,
        $imovel->qtdSalaEstar,
        $imovel->qtdSuites,
        $imovel->qtdQuartos
        )){
            throw new RuntimeException($stmt->error);
    }
    if (!$stmt->execute()) {
        throw new RuntimeException($stmt->error);
    }
}
function insertIntoApartamento($conn,$imovel,$id){
    $sql = "INSERT INTO Apartamento
            (
                id_imovel_apartamento,
                porteiro,
                nro_andar,
                valor_condominio
            )VALUES(?, ?, ?, ?)";
    
    
    if(!$stmt = $conn->prepare($sql)){
        echo $conn->error;
        throw new RuntimeException($conn->error);
    }
    if(!$stmt->bind_param(
        "iiid",
        $id,
        $imovel->porteiro24h,
        $imovel->andar,
        $imovel->valorCondominio
        )){
            throw new RuntimeException($stmt->error);
    }
    if (!$stmt->execute()) {
        throw new RuntimeException($stmt->error);
    }
}
function insertIntoAnunciar($conn,$imovel,$id){
    $date = date('Y-m-d');
    $sql = "INSERT INTO Anunciar
            (
                cpf_cliente_proprietario,
                id_imovel,
                status,
                data_anuncio,
                valor_sugerido
            )VALUES(?, ?, ?, ?, ?)";
    
    
    if(!$stmt = $conn->prepare($sql)){
        echo $conn->error;
        throw new RuntimeException($conn->error);
    }
    if(!$stmt->bind_param(
        "sissd",
        $imovel->Cliente->cpf,
        $id,
        $imovel->tipoAnuncio,
        $date,        
        $imovel->valorImovel
        )){
            throw new RuntimeException($stmt->error);
    }
    if (!$stmt->execute()) {
        throw new RuntimeException($stmt->error);
    }
}
function insertIntoFotos_Imovel($conn,$fotos,$id){
    $sql = "INSERT INTO Fotos_Imovel
            (
                id_imovel,
                fotos
            )VALUES(?, ?)";
    
    if(!$stmt = $conn->prepare($sql)){
        echo $conn->error;
        throw new RuntimeException($conn->error);
    }
    for($i=0; $i< sizeof($fotos) ; $i++)
    {
        if(!$stmt->bind_param("is",$id,$fotos[$i])){
            throw new RuntimeException($stmt->error);
        }
        if (!$stmt->execute()) {
            throw new RuntimeException($stmt->error);
        }
        
    }
    
}
function imovelSave($imovel)
{
    $conn = createConn();
    if ($conn == null) {
        return;
    }
    $id = random_int(1, 32767);
    
    try {
        
        $conn->begin_transaction();
        
        insertIntoImovel($conn, $imovel, $id);
        insertIntoResidencia($conn, $imovel, $id);
        insertIntoAnunciar($conn,$imovel,$id);
        insertIntoFotos_Imovel($conn,$imovel->fotos,$id);
        if ($imovel->tipoImovel == "Apartamento") {
            insertIntoApartamento($conn, $imovel, $id);            
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
function listApartamentos($conn){
    
    $imoveis = Array();
    
    $stmt = $conn->prepare("
        SELECT
			Anunciar.status,
            Anunciar.data_anuncio,
            Anunciar.valor_sugerido,
            Pessoa.cpf,
            Pessoa.nome,
            Pessoa.endereco,
            Clientes.genero,
            Clientes.profissao,
            Clientes.estado_civil,
            Clientes.email,
            Imovel.numero,
            Imovel.cep,
            Imovel.estado,
            Imovel.rua,
            Imovel.cidade,
            Imovel.bairro,
            Imovel.disponibilidade,
            Imovel.data_construcao,
            Imovel.area,
            Imovel.id_imovel,
            Residencia.descricao,
            Residencia.tem_armario,
            Residencia.nro_vaga_garagem,
            Residencia.qtd_sala_jantar,
            Residencia.qtd_sala_estar,
            Residencia.qtd_suit,
            Residencia.qtd_quartos,
            Apartamento.porteiro,
            Apartamento.nro_andar,
            Apartamento.valor_condominio
        FROM
            Imovel,
            Residencia,
            Apartamento,
            Clientes,
            Pessoa,
            Anunciar
        WHERE
            Imovel.id_imovel = Residencia.id_imovel_residencia
            AND Residencia.id_imovel_residencia = Apartamento.id_imovel_apartamento
            AND Imovel.cpf_cliente_usuario = Clientes.cpf_clientes
            AND Imovel.cpf_cliente_usuario = Pessoa.cpf
            AND Anunciar.id_imovel =Imovel.id_imovel;
        
        
 ");
    
    $stmt->execute();
    $stmt->store_result();
    
    $tipoAnuncio = null;
    $dataAnuncio = null;
    $valorImovel = null;
    $cpf=null;
    $nome=null;
    $EnderecoJson=null;
    $genero=null;
    $profissao=null;
    $estadoCivil=null;
    $email=null;
    $numero=null;
    $cep=null;
    $estado=null;
    $rua=null;
    $cidade=null;
    $bairro=null;
    $disponibilidade=null;
    $data_construcao=null;
    $area=null;
    $id=null;
    $descricao=null;
    $armarioEmbutido=null;
    $qtdVagasGaragem=null;
    $qtdSalaJantar=null;
    $qtdSalaEstar=null;
    $qtdSuites=null;
    $qtdQuartos=null;
    $porteiro24h=null;
    $andar=null;
    $valorCondominio=null;
    
    if($stmt->bind_result(
        $tipoAnuncio,
        $dataAnuncio,
        $valorImovel,
        $cpf,
        $nome,
        $EnderecoJson,
        $genero,
        $profissao,
        $estadoCivil,
        $email,
        $numero,
        $cep,
        $estado,
        $rua,
        $cidade,
        $bairro,
        $disponibilidade,
        $data_construcao,
        $area,
        $id,
        $descricao,
        $armarioEmbutido,
        $qtdVagasGaragem,
        $qtdSalaJantar,
        $qtdSalaEstar,
        $qtdSuites,
        $qtdQuartos,
        $porteiro24h,
        $andar,
        $valorCondominio
        
        ));
    while ($stmt->fetch()) {
        
        $endereco = new Endereco();
        $EnderecoJson = json_decode($EnderecoJson);
        $endereco->bairro = $EnderecoJson->bairro;
        $endereco->cep = $EnderecoJson->cep;
        $endereco->cidade = $EnderecoJson->cidade;
        $endereco->estado = $EnderecoJson->estado;
        $endereco->numero = $EnderecoJson->numero;
        $endereco->rua = $EnderecoJson->rua;
        
        $cliente = new Cliente();
        $cliente->cpf = $cpf;
        $cliente->email = $email;
        $cliente->Endereco = $endereco;
        $cliente->estadoCivil = $estadoCivil;
        $cliente->genero = $genero;
        $cliente->nome = $nome;
        $cliente->profissao = $profissao;
        
        
        $endereco = new Endereco();
        $endereco->cep = $cep;
        $endereco->cidade = $cidade;
        $endereco->estado = $estado;
        $endereco->rua = $rua;
        $endereco->numero = $numero;
        $endereco->bairro = $bairro;
        
        
        $imovel = new Imovel();
        $imovel->id = $id;
        $imovel->area = $area;
        $imovel->armarioEmbutido = $armarioEmbutido;
        $imovel->Cliente = $cliente;
        $imovel->dataConstrucao = $data_construcao;
        $imovel->descricao = $descricao;
        $imovel->Endereco = $endereco;
        $imovel->fotos = [];
        $imovel->qtdQuartos = $qtdQuartos;
        $imovel->qtdSalaEstar = $qtdSalaEstar;
        $imovel->qtdSalaJantar = $qtdSalaJantar;
        $imovel->qtdSuites = $qtdSuites;
        $imovel->qtdVagasGaragem = $qtdVagasGaragem;
        $imovel->tipoAnuncio = $tipoAnuncio;
        $imovel->tipoImovel = "Apartamento";
        $imovel->valorImovel = $valorImovel;
        $imovel->disponibilidade=$disponibilidade;
        $imovel->valorCondominio = $valorCondominio;
        $imovel->andar= $andar;
        $imovel->porteiro24h = $porteiro24h;
        $imovel->dataAnuncio = $dataAnuncio;
        
        $imoveis[] = $imovel;
    }
   
    return $imoveis;
    
}

function listCasas($conn){
    
    $imoveis = Array();
    
    $stmt = $conn->prepare("
        SELECT 
            Anunciar.status,
            Anunciar.data_anuncio,
            Anunciar.valor_sugerido,
            Pessoa.cpf,
            Pessoa.nome,
            Pessoa.endereco,
            Clientes.genero,
            Clientes.profissao,
            Clientes.estado_civil,
            Clientes.email,
            Imovel.numero,
            Imovel.cep,
            Imovel.estado,
            Imovel.rua,
            Imovel.cidade,
            Imovel.bairro,
            Imovel.disponibilidade,
            Imovel.data_construcao,
            Imovel.area,
            Imovel.id_imovel,
            Residencia.descricao,
            Residencia.tem_armario,
            Residencia.nro_vaga_garagem,
            Residencia.qtd_sala_jantar,
            Residencia.qtd_sala_estar,
            Residencia.qtd_suit,
            Residencia.qtd_quartos
        FROM
            Imovel,
            Residencia,
            Clientes,
            Pessoa,
            Anunciar
        WHERE
            Imovel.id_imovel = Residencia.id_imovel_residencia
                AND Residencia.id_imovel_residencia NOT IN (
                    SELECT 
                        id_imovel_apartamento
                    FROM
                        Apartamento
                )
                AND Imovel.cpf_cliente_usuario = Clientes.cpf_clientes
                AND Imovel.cpf_cliente_usuario = Pessoa.cpf
                AND Anunciar.id_imovel = Imovel.id_imovel;   
");
    
    $stmt->execute();
    $stmt->store_result();
    
    $tipoAnuncio = null;
    $dataAnuncio = null;
    $valorImovel = null;
    $cpf=null;
    $nome=null;
    $EnderecoJson=null;
    $genero=null;
    $profissao=null;
    $estadoCivil=null;
    $email=null;
    $numero=null;
    $cep=null;
    $estado=null;
    $rua=null;
    $cidade=null;
    $bairro=null;
    $disponibilidade=null;
    $data_construcao=null;
    $area=null;
    $id=null;
    $descricao=null;
    $armarioEmbutido=null;
    $qtdVagasGaragem=null;
    $qtdSalaJantar=null;
    $qtdSalaEstar=null;
    $qtdSuites=null;
    $qtdQuartos=null;
    $porteiro24h=null;
    $andar=null;
    $valorCondominio=null;
    
    if($stmt->bind_result(
        $tipoAnuncio,
        $dataAnuncio,
        $valorImovel,
        $cpf,
        $nome,
        $EnderecoJson,
        $genero,
        $profissao,
        $estadoCivil,
        $email,
        $numero,
        $cep,
        $estado,
        $rua,
        $cidade,
        $bairro,
        $disponibilidade,
        $data_construcao,
        $area,
        $id,
        $descricao,
        $armarioEmbutido,
        $qtdVagasGaragem,
        $qtdSalaJantar,
        $qtdSalaEstar,
        $qtdSuites,
        $qtdQuartos        
        ));
    while ($stmt->fetch()) {
        
        $endereco = new Endereco();
        $EnderecoJson = json_decode($EnderecoJson);
        $endereco->bairro = $EnderecoJson->bairro;
        $endereco->cep = $EnderecoJson->cep;
        $endereco->cidade = $EnderecoJson->cidade;
        $endereco->estado = $EnderecoJson->estado;
        $endereco->numero = $EnderecoJson->numero;
        $endereco->rua = $EnderecoJson->rua;
        
        $cliente = new Cliente();
        $cliente->cpf = $cpf;
        $cliente->email = $email;
        $cliente->Endereco = $endereco;
        $cliente->estadoCivil = $estadoCivil;
        $cliente->genero = $genero;
        $cliente->nome = $nome;
        $cliente->profissao = $profissao;
        
        
        $endereco = new Endereco();
        $endereco->cep = $cep;
        $endereco->cidade = $cidade;
        $endereco->estado = $estado;
        $endereco->rua = $rua;
        $endereco->numero = $numero;
        $endereco->bairro = $bairro;
        
        
        $imovel = new Imovel();
        $imovel->id = $id;
        $imovel->area = $area;
        $imovel->armarioEmbutido = $armarioEmbutido;
        $imovel->Cliente = $cliente;
        $imovel->dataConstrucao = $data_construcao;
        $imovel->descricao = $descricao;
        $imovel->Endereco = $endereco;
        $imovel->fotos = [];
        $imovel->qtdQuartos = $qtdQuartos;
        $imovel->qtdSalaEstar = $qtdSalaEstar;
        $imovel->qtdSalaJantar = $qtdSalaJantar;
        $imovel->qtdSuites = $qtdSuites;
        $imovel->qtdVagasGaragem = $qtdVagasGaragem;
        $imovel->tipoAnuncio = $tipoAnuncio;
        $imovel->tipoImovel = "Casa";
        $imovel->valorImovel = $valorImovel;
        $imovel->disponibilidade=$disponibilidade;
        $imovel->valorCondominio = $valorCondominio;
        $imovel->andar= $andar;
        $imovel->porteiro24h = $porteiro24h;
        $imovel->dataAnuncio = $dataAnuncio;
        
        $imoveis[] = $imovel;
    }
    
    return $imoveis;
    
}
function loadFotos($conn,$imoveis){
    for($a = 0 ; $a<sizeof($imoveis) ; $a++)
    {
        $sql = "SELECT fotos from Fotos_Imovel where id_imovel = ?";
        if(!$stmt = $conn->prepare($sql)){
            echo $conn->error;
            throw new RuntimeException($conn->error);
        }
        $id = $imoveis[$a]->id;
        if(!$stmt->bind_param("i",$id)){
            throw new RuntimeException($stmt->error);
        }
        if (!$stmt->execute()) {
            throw new RuntimeException($stmt->error);
        }
        
        $foto = null;
        if($stmt->bind_result($foto));
        while($stmt->fetch()){
            $imoveis[$a]->fotos[]=$foto;
        }
        
        
    }
    return $imoveis;
        
}
function imovelList()
{
    $conn = createConn();
    if ($conn == null) {
        return;
    }
    try {
        
        $imoveis = array();
        $imoveis = array_merge($imoveis, listApartamentos($conn));        
        $imoveis = array_merge($imoveis, listCasas($conn)); 
        $imoveis = loadFotos($conn, $imoveis);
        return $imoveis;
    } catch (Exception $e) {
        echo $e;
        return null;
    }finally {
        $conn->close();
    }
}

function imovelDelete($id){
    $conn = createConn();
    if ($conn == null) {
        return;
    }
    try {
        $conn->begin_transaction();
        
        $smtp = $conn->prepare("DELETE FROM Imovel WHERE id_imovel = ?");
        $smtp->bind_param('s', $id);
        $smtp->execute();
        
        $smtp = $conn->prepare("DELETE FROM Residencia WHERE id_imovel_residencia = ?");
        $smtp->bind_param('s', $id);
        $smtp->execute();
        
        $smtp = $conn->prepare("DELETE FROM Fotos_Imovel WHERE id_imovel = ?");
        $smtp->bind_param('s', $id);
        $smtp->execute();
        
        $smtp = $conn->prepare("DELETE FROM Anunciar WHERE id_imovel = ?");
        $smtp->bind_param('s', $id);
        $smtp->execute();
        
        $smtp = $conn->prepare("DELETE FROM Apartamento WHERE id_imovel_apartamento = ?");
        $smtp->bind_param('s', $id);
        $smtp->execute();
        
        
        if ($conn->commit()) {
            return TRUE;
        }
        return true;
    } catch (Exception $e) {
        echo $e;
        return false;
    }finally {
        $conn->close();
    }
}
function searchImovel($search){
    $conn = createConn();
    if ($conn == null) {
        return;
    }
    try {
        
        $imoveis = array();
        $imoveis = array_merge($imoveis, searchApartamentos($conn,$search));
        $imoveis = array_merge($imoveis, searchCasas($conn,$search));
        $imoveis = loadFotos($conn, $imoveis);
        return $imoveis;
    } catch (Exception $e) {
        echo $e;
        return null;
    }finally {
        $conn->close();
    }
}
function searchApartamentos($conn,$search){
    
    $imoveis = Array();
    
    $stmt = $conn->prepare("
        SELECT
			Anunciar.status,
            Anunciar.data_anuncio,
            Anunciar.valor_sugerido,
            Pessoa.cpf,
            Pessoa.nome,
            Pessoa.endereco,
            Clientes.genero,
            Clientes.profissao,
            Clientes.estado_civil,
            Clientes.email,
            Imovel.numero,
            Imovel.cep,
            Imovel.estado,
            Imovel.rua,
            Imovel.cidade,
            Imovel.bairro,
            Imovel.disponibilidade,
            Imovel.data_construcao,
            Imovel.area,
            Imovel.id_imovel,
            Residencia.descricao,
            Residencia.tem_armario,
            Residencia.nro_vaga_garagem,
            Residencia.qtd_sala_jantar,
            Residencia.qtd_sala_estar,
            Residencia.qtd_suit,
            Residencia.qtd_quartos,
            Apartamento.porteiro,
            Apartamento.nro_andar,
            Apartamento.valor_condominio
        FROM
            Imovel,
            Residencia,
            Apartamento,
            Clientes,
            Pessoa,
            Anunciar
        WHERE
            Imovel.id_imovel = Residencia.id_imovel_residencia
            AND Residencia.id_imovel_residencia = Apartamento.id_imovel_apartamento
            AND Imovel.cpf_cliente_usuario = Clientes.cpf_clientes
            AND Imovel.cpf_cliente_usuario = Pessoa.cpf
            AND Anunciar.id_imovel =Imovel.id_imovel
            AND Anunciar.status = ?
            AND Imovel.cidade = ?
            AND Imovel.bairro = ?
            AND Anunciar.valor_sugerido BETWEEN ? and ?
            AND Residencia.descricao like ?;
        
        
 ");
    
    $search->descricao="%".$search->descricao."%";
    
    if(!$stmt->bind_param(
        "sssdds",
        $search->tipoAnuncio,
        $search->cidade,
        $search->bairro,
        $search->valorMin,
        $search->valorMax,
        $search->descricao
        )){
            throw new RuntimeException($stmt->error);
    };
    
    
    $stmt->execute();
    $stmt->store_result();
    
    $tipoAnuncio = null;
    $dataAnuncio = null;
    $valorImovel = null;
    $cpf=null;
    $nome=null;
    $EnderecoJson=null;
    $genero=null;
    $profissao=null;
    $estadoCivil=null;
    $email=null;
    $numero=null;
    $cep=null;
    $estado=null;
    $rua=null;
    $cidade=null;
    $bairro=null;
    $disponibilidade=null;
    $data_construcao=null;
    $area=null;
    $id=null;
    $descricao=null;
    $armarioEmbutido=null;
    $qtdVagasGaragem=null;
    $qtdSalaJantar=null;
    $qtdSalaEstar=null;
    $qtdSuites=null;
    $qtdQuartos=null;
    $porteiro24h=null;
    $andar=null;
    $valorCondominio=null;
    
    if($stmt->bind_result(
        $tipoAnuncio,
        $dataAnuncio,
        $valorImovel,
        $cpf,
        $nome,
        $EnderecoJson,
        $genero,
        $profissao,
        $estadoCivil,
        $email,
        $numero,
        $cep,
        $estado,
        $rua,
        $cidade,
        $bairro,
        $disponibilidade,
        $data_construcao,
        $area,
        $id,
        $descricao,
        $armarioEmbutido,
        $qtdVagasGaragem,
        $qtdSalaJantar,
        $qtdSalaEstar,
        $qtdSuites,
        $qtdQuartos,
        $porteiro24h,
        $andar,
        $valorCondominio
        
        ));
    while ($stmt->fetch()) {
        
        $endereco = new Endereco();
        $EnderecoJson = json_decode($EnderecoJson);
        $endereco->bairro = $EnderecoJson->bairro;
        $endereco->cep = $EnderecoJson->cep;
        $endereco->cidade = $EnderecoJson->cidade;
        $endereco->estado = $EnderecoJson->estado;
        $endereco->numero = $EnderecoJson->numero;
        $endereco->rua = $EnderecoJson->rua;
        
        $cliente = new Cliente();
        $cliente->cpf = $cpf;
        $cliente->email = $email;
        $cliente->Endereco = $endereco;
        $cliente->estadoCivil = $estadoCivil;
        $cliente->genero = $genero;
        $cliente->nome = $nome;
        $cliente->profissao = $profissao;
        
        
        $endereco = new Endereco();
        $endereco->cep = $cep;
        $endereco->cidade = $cidade;
        $endereco->estado = $estado;
        $endereco->rua = $rua;
        $endereco->numero = $numero;
        $endereco->bairro = $bairro;
        
        
        $imovel = new Imovel();
        $imovel->id = $id;
        $imovel->area = $area;
        $imovel->armarioEmbutido = $armarioEmbutido;
        $imovel->Cliente = $cliente;
        $imovel->dataConstrucao = $data_construcao;
        $imovel->descricao = $descricao;
        $imovel->Endereco = $endereco;
        $imovel->fotos = [];
        $imovel->qtdQuartos = $qtdQuartos;
        $imovel->qtdSalaEstar = $qtdSalaEstar;
        $imovel->qtdSalaJantar = $qtdSalaJantar;
        $imovel->qtdSuites = $qtdSuites;
        $imovel->qtdVagasGaragem = $qtdVagasGaragem;
        $imovel->tipoAnuncio = $tipoAnuncio;
        $imovel->tipoImovel = "Apartamento";
        $imovel->valorImovel = $valorImovel;
        $imovel->disponibilidade=$disponibilidade;
        $imovel->valorCondominio = $valorCondominio;
        $imovel->andar= $andar;
        $imovel->porteiro24h = $porteiro24h;
        $imovel->dataAnuncio = $dataAnuncio;
        
        $imoveis[] = $imovel;
    }
    
    return $imoveis;
    
}
function searchCasas($conn,$search){
    $imoveis = Array();
    
    $stmt = $conn->prepare("
        SELECT
            Anunciar.status,
            Anunciar.data_anuncio,
            Anunciar.valor_sugerido,
            Pessoa.cpf,
            Pessoa.nome,
            Pessoa.endereco,
            Clientes.genero,
            Clientes.profissao,
            Clientes.estado_civil,
            Clientes.email,
            Imovel.numero,
            Imovel.cep,
            Imovel.estado,
            Imovel.rua,
            Imovel.cidade,
            Imovel.bairro,
            Imovel.disponibilidade,
            Imovel.data_construcao,
            Imovel.area,
            Imovel.id_imovel,
            Residencia.descricao,
            Residencia.tem_armario,
            Residencia.nro_vaga_garagem,
            Residencia.qtd_sala_jantar,
            Residencia.qtd_sala_estar,
            Residencia.qtd_suit,
            Residencia.qtd_quartos
        FROM
            Imovel,
            Residencia,
            Clientes,
            Pessoa,
            Anunciar
        WHERE
            Imovel.id_imovel = Residencia.id_imovel_residencia
                AND Residencia.id_imovel_residencia NOT IN (
                    SELECT
                        id_imovel_apartamento
                    FROM
                        Apartamento
                )
                AND Imovel.cpf_cliente_usuario = Clientes.cpf_clientes
                AND Imovel.cpf_cliente_usuario = Pessoa.cpf
                AND Anunciar.id_imovel = Imovel.id_imovel 
                AND Anunciar.status = ?
                AND Imovel.cidade = ?
                AND Imovel.bairro = ?
                AND Anunciar.valor_sugerido BETWEEN ? and ?
                AND Residencia.descricao like ?;
        
        
    ");
    
    $search->descricao="%".$search->descricao."%";
    
    if(!$stmt->bind_param(
        "sssdds",
        $search->tipoAnuncio,
        $search->cidade,
        $search->bairro,
        $search->valorMin,
        $search->valorMax,
        $search->descricao
        )){
            throw new RuntimeException($stmt->error);
    };

    
    $stmt->execute();
    $stmt->store_result();
    
    $tipoAnuncio = null;
    $dataAnuncio = null;
    $valorImovel = null;
    $cpf=null;
    $nome=null;
    $EnderecoJson=null;
    $genero=null;
    $profissao=null;
    $estadoCivil=null;
    $email=null;
    $numero=null;
    $cep=null;
    $estado=null;
    $rua=null;
    $cidade=null;
    $bairro=null;
    $disponibilidade=null;
    $data_construcao=null;
    $area=null;
    $id=null;
    $descricao=null;
    $armarioEmbutido=null;
    $qtdVagasGaragem=null;
    $qtdSalaJantar=null;
    $qtdSalaEstar=null;
    $qtdSuites=null;
    $qtdQuartos=null;
    $porteiro24h=null;
    $andar=null;
    $valorCondominio=null;
    
    if($stmt->bind_result(
        $tipoAnuncio,
        $dataAnuncio,
        $valorImovel,
        $cpf,
        $nome,
        $EnderecoJson,
        $genero,
        $profissao,
        $estadoCivil,
        $email,
        $numero,
        $cep,
        $estado,
        $rua,
        $cidade,
        $bairro,
        $disponibilidade,
        $data_construcao,
        $area,
        $id,
        $descricao,
        $armarioEmbutido,
        $qtdVagasGaragem,
        $qtdSalaJantar,
        $qtdSalaEstar,
        $qtdSuites,
        $qtdQuartos
        ));
    while ($stmt->fetch()) {
        
        $endereco = new Endereco();
        $EnderecoJson = json_decode($EnderecoJson);
        $endereco->bairro = $EnderecoJson->bairro;
        $endereco->cep = $EnderecoJson->cep;
        $endereco->cidade = $EnderecoJson->cidade;
        $endereco->estado = $EnderecoJson->estado;
        $endereco->numero = $EnderecoJson->numero;
        $endereco->rua = $EnderecoJson->rua;
        
        $cliente = new Cliente();
        $cliente->cpf = $cpf;
        $cliente->email = $email;
        $cliente->Endereco = $endereco;
        $cliente->estadoCivil = $estadoCivil;
        $cliente->genero = $genero;
        $cliente->nome = $nome;
        $cliente->profissao = $profissao;
        
        
        $endereco = new Endereco();
        $endereco->cep = $cep;
        $endereco->cidade = $cidade;
        $endereco->estado = $estado;
        $endereco->rua = $rua;
        $endereco->numero = $numero;
        $endereco->bairro = $bairro;
        
        
        $imovel = new Imovel();
        $imovel->id = $id;
        $imovel->area = $area;
        $imovel->armarioEmbutido = $armarioEmbutido;
        $imovel->Cliente = $cliente;
        $imovel->dataConstrucao = $data_construcao;
        $imovel->descricao = $descricao;
        $imovel->Endereco = $endereco;
        $imovel->fotos = [];
        $imovel->qtdQuartos = $qtdQuartos;
        $imovel->qtdSalaEstar = $qtdSalaEstar;
        $imovel->qtdSalaJantar = $qtdSalaJantar;
        $imovel->qtdSuites = $qtdSuites;
        $imovel->qtdVagasGaragem = $qtdVagasGaragem;
        $imovel->tipoAnuncio = $tipoAnuncio;
        $imovel->tipoImovel = "Casa";
        $imovel->valorImovel = $valorImovel;
        $imovel->disponibilidade=$disponibilidade;
        $imovel->valorCondominio = $valorCondominio;
        $imovel->andar= $andar;
        $imovel->porteiro24h = $porteiro24h;
        $imovel->dataAnuncio = $dataAnuncio;
        
        $imoveis[] = $imovel;
    }
    
    return $imoveis;
    
}

?>