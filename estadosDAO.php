<?php



class EstadosDAO {

    public static function getEstadosByNome($nome) {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM estados WHERE nome='$nome'";
        $result = mysqli_query($connection, $sql);
        $estados = mysqli_fetch_object($result);

        return $estados;
    }

    public static function getAll() {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM estados";

        // recupera todos os clientes
        $result = mysqli_query($connection, $sql);
        $estados = array();
        while ($estado = mysqli_fetch_object($result)) {
            if ($estado != null) {
                $estados[] = $estado;
            }
        }
        return $estados;
    }

    public static function updateEstados($estado, $id) {
        $connection = Connection::getConnection();
        $sql = "UPDATE estados SET nome='$estado->nome' WHERE id=$id";
        $result = mysqli_query($connection, $sql);

        $estadoAtualizado = EstadosDAO::getEstadosByNome($estado->nome);
        return $estadoAtualizado;
    }

    public static function deleteEstado($id) {
        $connection = Connection::getConnection();
        $sql = "DELETE FROM estados WHERE id=$id";
        $result = mysqli_query($connection, $sql);

        if ($result === FALSE) {
            return false;
        } else {
            return true;
        }
    }

    public static function addEstado($estado) {
        $connection = Connection::getConnection();
        $sql = "INSERT INTO estados (nome) VALUES ('$estado->nome')";
        $result = mysqli_query($connection, $sql);

        $novoEstado = EstadosDAO::getEstadosByNome($estado->nome);
        return $novoEstado;
    }

}
