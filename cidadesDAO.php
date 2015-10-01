<?php

class CidadesDAO {

    public static function getCidadesByNome($nome) {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM cidades WHERE nome='$nome'";
        $result = mysqli_query($connection, $sql);
        $cidades = mysqli_fetch_object($result);

        $sql = "SELECT nome FROM estados WHERE id=$cidades->estados_id";
        $result = mysqli_query($connection, $sql);
        $cidades->estado = mysqli_fetch_object($result);
        return $cidades;
    }

    public static function getAll() {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM cidades";

        // recupera todos os clientes
        $result = mysqli_query($connection, $sql);
        $cidades = array();
        while ($cidade = mysqli_fetch_object($result)) {
            if ($cidade != null) {
                $cidades[] = $cidade;
            }
        }
        return $cidades;
    }

    public static function updateCidades($cidade, $id) {
        $connection = Connection::getConnection();
        $sql = "UPDATE cidades SET nome='$cidade->nome' WHERE id=$id";
        $result = mysqli_query($connection, $sql);

        $cidadeAtualizado = CidadesDAO::getCidadesByNome($cidade->nome);
        return $cidadeAtualizado;
    }

    public static function deleteCidade($id) {
        $connection = Connection::getConnection();
        $sql = "DELETE FROM cidades WHERE id=$id";
        $result = mysqli_query($connection, $sql);

        if ($result === FALSE) {
            return false;
        } else {
            return true;
        }
    }

    public static function addCidade($cidade) {
        $connection = Connection::getConnection();
        $sql = "INSERT INTO cidades (nome, estados_id) VALUES ('$cidade->nome',$cidade->estados_id)";
        $result = mysqli_query($connection, $sql);

        $novoCidade = CidadesDAO::getCidadesByNome($cidade->nome);
        return $novoCidade;
    }

}
