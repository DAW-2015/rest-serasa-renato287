<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TarefasDAO {

    public static function getTarefaByDescricao($descricao) {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM tarefas WHERE descricao='$descricao'";
        $result = mysqli_query($connection, $sql);
        $tarefa = mysqli_fetch_object($result);

        $tarefa->categoria = CategoriasDAO::getCategoriaById($tarefa->categorias_id);
        $tarefa->usuario = UsuariosDAO::getUsuarioById($tarefa->usuarios_id);

        return $tarefa;
    }

    public static function getAll() {
        $connection = Connection::getConnection();
        $sql = "SELECT * FROM tarefas";

        // recupera todos os clientes
        $result = mysqli_query($connection, $sql);
        $tarefas = array();
        while ($tarefa = mysqli_fetch_object($result)) {
            if ($tarefa != null) {
                $tarefa->categoria = CategoriasDAO::getCategoriaById($tarefa->categorias_id);
                $tarefa->usuario = UsuariosDAO::getUsuarioById($tarefa->usuarios_id);
                $tarefas[] = $tarefa;
            }
        }
        return $tarefas;
    }

    public static function addTarefa($tarefa) {
        $connection = Connection::getConnection();
        $sql = "INSERT INTO tarefas (descricao,categorias_id,usuarios_id) VALUES ('$tarefa->descricao', $tarefa->categorias_id, $tarefa->usuarios_id)";
        $result = mysqli_query($connection, $sql);

        $novoTarefa = TarefasDAO::getTarefaByDescricao($tarefa->descricao);
        return $novoTarefa;
    }

    public static function updateTarefa($tarefa, $id) {
        $connection = Connection::getConnection();
        $sql = "UPDATE tarefas SET descricao='$tarefa->descricao', categorias_id=$tarefa->cetgorias_id, usuarios_id=$tarefa->usuarios_id WHERE id=$id";
        $result = mysqli_query($connection, $sql);

        $tarefaAtualizado = TarefasDAO::getTarefaByDescricao($tarefa->descricao);
        return $tarefaAtualizado;
    }

    public static function deletetarefa($id) {
        $connection = Connection::getConnection();
        $sql = "DELETE FROM tarefas WHERE id=$id";
        $result = mysqli_query($connection, $sql);

        if ($result === FALSE) {
            return false;
        } else {
            return true;
        }
    }

}
