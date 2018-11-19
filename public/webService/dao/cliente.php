<?php
require_once (dirname(__FILE__) . '/../helper/conexao.php');

function clienteSave($cliente)
{
    $conn = createConn();
    if ($conn == null) {
        return;
    }

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare("INSERT INTO Pessoa(cpf, nome, endereco) VALUES (?, ?, ?)");
        $EnderecoJson = json_encode($cliente->Endereco);
        $stmt->bind_param("sss", $cliente->cpf, $cliente->nome, $EnderecoJson);
        if (! $stmt->execute()) {
            throw new RuntimeException($stmt->error);
        }

        $stmt = $conn->prepare("INSERT INTO Clientes(cpf_clientes, genero, profissao, estado_civil, email) 
            VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $cliente->cpf, $cliente->genero, $cliente->profissao, $cliente->estadoCivil, $cliente->email);
        if (! $stmt->execute()) {
            throw new RuntimeException("Pessoa ja tem esse Cliente");
        }

        if ($conn->commit()) {
            return TRUE;
        }
    } catch (Exception $e) {
        echo $e;
        $conn->rollback();
        return false;
    }
}

function clienteList()
{
    require_once (dirname(__FILE__) . '/../model/cliente.php');
    $conn = createConn();
    if ($conn == null) {
        return;
    }
    try {

        $clientes = array();
        $stmt = $conn->prepare(" SELECT * 
                from
                    Pessoa, 
                    Clientes 
                where 
                    Pessoa.cpf = Clientes.cpf_clientes;
            ");
        $stmt->execute();
        $stmt->store_result();
        $cpf = null;
        $nome = null;
        $cpf_clientes = null;
        $genero = null;
        $profissao = null;
        $estadoCivil = null;
        $email = null;
        $stmt->bind_result($cpf, $nome, $EnderecoJson, $cpf_clientes, $genero, $profissao, $estadoCivil, $email);
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

            $clientes[] = $cliente;
        }

        return $clientes;
    } catch (Exception $e) {
        echo $e;
        return null;
    }
}

function clienteDelete($cpf)
{
    $conn = createConn();
    if ($conn == null) {
        return;
    }
    try {

        $conn->begin_transaction();
        
        $smtp = $conn->prepare("DELETE FROM Pessoa WHERE cpf = ?");
        $smtp->bind_param('s', $cpf);
        $smtp->execute();
        
        $smtp = $conn->prepare("DELETE FROM Clientes WHERE cpf_clientes = ?");
        $smtp->bind_param('s', $cpf);
        $smtp->execute();
        
        

        if ($conn->commit()) {
            return TRUE;
        }
    } catch (Exception $e) {
        echo $e;
        $conn->rollback();
        return FALSE;
    }
}

function clienteUpdate($cliente){
    $conn = createConn();
    if ($conn == null) {
        return;
    }
    
    try {
        $conn->begin_transaction();
        
        $stmt = $conn->prepare("UPDATE Pessoa set cpf = ? , nome = ? , endereco = ? where cpf = ?");
        $EnderecoJson = json_encode($cliente->Endereco);
        $stmt->bind_param("ssss", $cliente->cpf, $cliente->nome, $EnderecoJson, $cliente->cpf);
        if (! $stmt->execute()) {
            throw new RuntimeException($stmt->error);
        }
        
        $stmt = $conn->prepare("UPDATE Clientes set cpf_clientes = ? , genero = ?, profissao = ?, estado_civil = ?, email = ?
            where cpf_clientes = ?");
        $stmt->bind_param("ssssss", $cliente->cpf, $cliente->genero, $cliente->profissao, $cliente->estadoCivil, $cliente->email, $cliente->cpf);
        if (! $stmt->execute()) {
            throw new RuntimeException($stmt->error);
        }
        
        if ($conn->commit()) {
            return TRUE;
        }

    } catch (Exception $e) {
        echo $e;
        $conn->rollback();
        return false;
    }
}
?>