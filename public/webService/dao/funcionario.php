<?php
require (dirname(__FILE__) . '/../helper/conexao.php');

function funcionarioSave($funcionario)
{
    $conn = createConn();
    if ($conn == null) {
        return;
    }

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare("INSERT INTO Pessoa(cpf, nome, endereco) VALUES (?, ?, ?)");
        $EnderecoJson = json_encode($funcionario->Endereco);
        $stmt->bind_param("sss", $funcionario->cpf, $funcionario->nome, $EnderecoJson);
        if (! $stmt->execute()) {
            throw new RuntimeException($stmt->error);
        }

        $funcionario->senha = hash('sha512',$funcionario->senha);
        $stmt = $conn->prepare("INSERT INTO Funcionario(id_cargo, cpf_funcionario, data_ing, senha, usuario, telefone, celular)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $funcionario->cargo, $funcionario->cpf, $funcionario->dataInicio, $funcionario->senha, $funcionario->usuario, $funcionario->telefone, $funcionario->celular);

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

function funcionarioList()
{
    require (dirname(__FILE__) . '/../model/funcionario.php');
    $conn = createConn();
    if ($conn == null) {
        return;
    }

    try {

        $funcionarios = array();
        $stmt = $conn->prepare(" SELECT *
                from
                    Pessoa,
                    Funcionario
                where
                    Pessoa.cpf = Funcionario.cpf_funcionario;
        ");

        $stmt->execute();
        $stmt->store_result();

        $usuario = null;
        $senha = null;
        $nome = null;
        $cpf = null;
        $data = null;
        $cpf_funcionario = null;
        $cargo = null;
        $telefone = null;
        $celular = null;

        $stmt->bind_result($cpf, $nome, $EnderecoJson, $cargo, $cpf_funcionario, $data, $senha, $usuario, $telefone, $celular);

        while ($stmt->fetch()) {

            $endereco = new Endereco();
            $EnderecoJson = json_decode($EnderecoJson);
            $endereco->bairro = $EnderecoJson->bairro;
            $endereco->cep = $EnderecoJson->cep;
            $endereco->cidade = $EnderecoJson->cidade;
            $endereco->estado = $EnderecoJson->estado;
            $endereco->numero = $EnderecoJson->numero;
            $endereco->rua = $EnderecoJson->rua;

            $funcionario = new Funcionario();
            $funcionario->usuario = $usuario;
            $funcionario->senha = $senha;
            $funcionario->dataInicio = "2018-12-12";
            $funcionario->cpf = $cpf;
            $funcionario->nome = $nome;
            $funcionario->cargo = $cargo;
            $funcionario->telefone = $telefone;
            $funcionario->celular = $celular;
            $funcionario->Endereco = $endereco;

            $funcionarios[] = $funcionario;
        }

        return $funcionarios;

    } catch (Exception $e) {
        echo $e;
        return null;
    }
}

function funcionarioDelete($cpf)
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

        $smtp = $conn->prepare("DELETE FROM Funcionario WHERE cpf_funcionario = ?");
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

function funcionarioUpdate($funcionario){
    $conn = createConn();
    if ($conn == null) {
        return;
    }

    try {
        $conn->begin_transaction();

        $stmt = $conn->prepare("UPDATE Pessoa set cpf = ? , nome = ? , endereco = ? where cpf = ?");
        $EnderecoJson = json_encode($funcionario->Endereco);

        $stmt->bind_param("ssss", $funcionario->cpf, $funcionario->nome, $EnderecoJson, $funcionario->cpf);
        if (! $stmt->execute()) {
            throw new RuntimeException($stmt->error);
        }

        $stmt = $conn->prepare("UPDATE Funcionario set id_cargo = ? , cpf_funcionario = ? , data_ing = ? , senha = ? , usuario = ?
            where cpf_funcionario = ?");
        $stmt->bind_param("issss", $funcionario->cargo, $funcionario->cpf, $funcionario->dataInicio, $funcionario->senha, $funcionario->usuario);

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
