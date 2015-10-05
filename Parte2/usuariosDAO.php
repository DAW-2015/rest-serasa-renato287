<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class UsuariosDAO {

    public static function getUsuarioByNome($nome) {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM usuarios WHERE nome='$nome'";
        $result = mysqli_query($connection, $sql);
        $usuario = mysqli_fetch_object($result);

        return $usuario;
    }

    public static function getUsuarioById($id) {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM usuarios WHERE id=$id";
        $result = mysqli_query($connection, $sql);
        $usuario = mysqli_fetch_object($result);

        return $usuario;
    }

    public static function getAll() {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM usuarios";

        // recupera todos os clientes
        $result = mysqli_query($connection, $sql);
        $usuarios = array();
        while ($usuario = mysqli_fetch_object($result)) {
            if ($usuario != null) {
                $usuarios[] = $usuario;
            }
        }
        return $usuarios;
    }

    public static function addUsuario($usuario) {
        $connection = Connection::getConnection();
        $sql = "INSERT INTO usuarios (nome,email,senha) VALUES ('$usuario->nome', '$usuario->email', '$usuario->senha')";
        $result = mysqli_query($connection, $sql);

        $novoUsuario = UsuariosDAO::getUsuarioByNome($usuario->nome);
        return $novoUsuario;
    }

    public static function updateUsuario($usuario, $id) {
        $connection = Connection::getConnection();
        $sql = "UPDATE usuarios SET nome='$usuario->nome', email='$usuario->email', senha='$usuario->senha' WHERE id=$id";
        $result = mysqli_query($connection, $sql);

        $usuarioAtualizado = UsuariosDAO::getUsuarioByNome($usuario->nome);
        return $usuarioAtualizado;
    }

    public static function deleteusuario($id) {
        $connection = Connection::getConnection();
        $sql = "DELETE FROM usuarios WHERE id=$id";
        $result = mysqli_query($connection, $sql);

        if ($result === FALSE) {
            return false;
        } else {
            return true;
        }
    }

}
