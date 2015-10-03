<?php

class DividasDAO {

    public static function getDividasByIds($estabelecimentoID, $clienteID) {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM dividas WHERE estabelecimentos_id=$estabelecimentoID AND clientes_id=$clienteID";
        $result = mysqli_query($connection, $sql);
        $dividas = mysqli_fetch_object($result);

        $dividas->cliente = ClienteDAO::getClienteByID($dividas->clientes_id);
        $dividas->estabelecimentos = EstabelecimentoDAO::getEstabelecimentoByID($dividas->estabelecimentos_id);
        return $dividas;
    }

    public static function getAll() {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM dividas";

        // recupera todos os clientes
        $result = mysqli_query($connection, $sql);
        $dividas = array();
        while ($divida = mysqli_fetch_object($result)) {
            if ($divida != null) {
                $dividas[] = $divida;
            }
        }
        return $dividas;
    }

    public static function updateDividas($divida, $estabelecimentoID, $clienteID) {
        $connection = Connection::getConnection();
        $sql = "UPDATE dividas SET valor='$divida->valor' clientes_id=$divida->clientes_id estabelecimentos_id=$divida->estabelecimentos_id WHERE estabelecimentos_id = $estabelecimentoID AND clientes_id = $clienteID";
        $result = mysqli_query($connection, $sql);

        $dividaAtualizado = DividasDAO::getDividasByIds($divida->estabelecimentos_id, $divida->clientes_id);
        return $dividaAtualizado;
    }

    public static function deleteDivida($estabelecimentoID, $clienteID) {
        $connection = Connection::getConnection();
        $sql = "DELETE FROM dividas WHERE estabelecimentos_id = $estabelecimentoID AND clientes_id = $clienteID";
        $result = mysqli_query($connection, $sql);

        if ($result === FALSE) {
            return false;
        } else {
            return true;
        }
    }

    public static function addDivida($divida) {
        $connection = Connection::getConnection();
        $sql = "INSERT INTO dividas (clientes_id,estabelecimentos_id,valor) VALUES ($divida->clientes_id, $divida->estabelecimentos_id, $divida->valor)";
        $result = mysqli_query($connection, $sql);

        $novoDivida = DividasDAO::getDividasByIds($divida->estabelecimentos_id, $divida->clientes_id);
        return $novoDivida;
    }

}