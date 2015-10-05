<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CategoriasDAO {

    public static function getCategoriaByNome($nome) {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM categorias WHERE nome='$nome'";
        $result = mysqli_query($connection, $sql);
        $categoria = mysqli_fetch_object($result);

        return $categoria;
    }
    
    public static function getCategoriaById($id) {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM categorias WHERE id=$id";
        $result = mysqli_query($connection, $sql);
        $categoria = mysqli_fetch_object($result);

        return $categoria;
    }
    
    public static function getAll() {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM categorias";

        // recupera todos os clientes
        $result = mysqli_query($connection, $sql);
        $categorias = array();
        while ($categoria = mysqli_fetch_object($result)) {
            if ($categoria != null) {
                $categorias[] = $categoria;
            }
        }
        return $categorias;
    }

    public static function addCategoria($categoria) {
        $connection = Connection::getConnection();
        $sql = "INSERT INTO categorias (nome,usuarios_id) VALUES ('$categoria->nome', $categoria->usuarios_id)";
        $result = mysqli_query($connection, $sql);

        $novaCategoria = CategoriasDAO::getCategoriaByNome($categoria->nome);
        return $novaCategoria;
    }

    public static function updateCategoria($categoria, $id) {
        $connection = Connection::getConnection();
        $sql = "UPDATE categorias SET nome='$categoria->nome', usuarios_id=$categoria->usuarios_id WHERE id=$id";
        $result = mysqli_query($connection, $sql);

        $categoriaAtualizada = CategoriasDAO::getCategoriaByNome($categoria->nome);
        return $categoriaAtualizada;
    }

    public static function deletecategoria($id) {
        $connection = Connection::getConnection();
        $sql = "DELETE FROM categorias WHERE id=$id";
        $result = mysqli_query($connection, $sql);

        if ($result === FALSE) {
            return false;
        } else {
            return true;
        }
    }

}
