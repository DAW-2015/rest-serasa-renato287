<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
require 'connection.php';
require 'categoriasDAO.php';
require 'tarefasDAO.php';
require 'usuariosDAO.php';

$app = new \Slim\Slim();
//$app->response()->header('Content-Type', 'application/json;charset=utf-8');

//Usuarios
$app->get('/usuarios/:nome', function ($nome) {
    //recupera o usuario
    $usuario = UsuariosDAO::getUsuarioByNome($nome);
    echo json_encode($usuario);
});

$app->get('/usuarios', function() {
    // recupera todos os usuarios
    $usuarios = UsuariosDAO::getAll();
    echo json_encode($usuarios);
});

$app->post('/usuarios', function() {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // insere o usuario
    $novoUsuario = json_decode($request->getBody());
    $novoUsuario = UsuariosDAO::addUsuario($novoUsuario);

    echo json_encode($novoUsuario);
});

$app->put('/usuarios/:id', function ($id) {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // atualiza o usuario
    $usuario = json_decode($request->getBody());
    $usuario = UsuariosDAO::updateUsuario($usuario, $id);

    echo json_encode($usuario);
});

$app->delete('/usuarios/:id', function($id) {
    // exclui o usuario
    $isDeleted = UsuariosDAO::deleteUsuario($id);

    // verifica se houve problema na exclusão
    if ($isDeleted) {
        echo "{'message':'Usuário excluído'}";
    } else {
        echo "{'message':'Erro ao excluir usuário'}";
    }
});

//Categorias
$app->get('/categorias/:nome', function ($nome) {
    //recupera o categoria
    $categoria = CategoriasDAO::getCategoriaByNome($nome);
    echo json_encode($categoria);
});

$app->get('/categorias', function() {
    // recupera todos os categorias
    $categorias = CategoriasDAO::getAll();
    echo json_encode($categorias);
});

$app->post('/categorias', function() {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // insere o categoria
    $novaCategoria = json_decode($request->getBody());
    $novaCategoria = CategoriasDAO::addCategoria($novaCategoria);

    echo json_encode($novaCategoria);
});

$app->put('/categorias/:id', function ($id) {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // atualiza o categoria
    $categoria = json_decode($request->getBody());
    $categoria = CategoriasDAO::updateCategoria($categoria, $id);

    echo json_encode($categoria);
});

$app->delete('/categorias/:id', function($id) {
    // exclui o categoria
    $isDeleted = CategoriasDAO::deletecategoria($id);

    // verifica se houve problema na exclusão
    if ($isDeleted) {
        echo "{'message':'Categoria excluído'}";
    } else {
        echo "{'message':'Erro ao excluir categoria'}";
    }
});

//Tarefas
$app->get('/tarefas/:descricao', function ($descricao) {
    //recupera o tarefa
    $tarefa = TarefasDAO::getTarefaByDescricao($descricao);
    echo json_encode($tarefa);
});

$app->get('/tarefas', function() {
    // recupera todos os tarefas
    $tarefas = TarefasDAO::getAll();
    echo json_encode($tarefas);
});

$app->post('/tarefas', function() {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // insere o tarefa
    $novoTarefa = json_decode($request->getBody());
    $novoTarefa = TarefasDAO::addTarefa($novoTarefa);

    echo json_encode($novoTarefa);
});

$app->put('/tarefas/:id', function ($id) {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // atualiza o tarefa
    $tarefa = json_decode($request->getBody());
    $tarefa = TarefasDAO::updateTarefa($tarefa, $id);

    echo json_encode($tarefa);
});

$app->delete('/tarefas/:id', function($id) {
    // exclui o tarefa
    $isDeleted = TarefasDAO::deleteTarefa($id);

    // verifica se houve problema na exclusão
    if ($isDeleted) {
        echo "{'message':'Tarefa excluída'}";
    } else {
        echo "{'message':'Erro ao excluir tarefa'}";
    }
});

$app->run();
?>