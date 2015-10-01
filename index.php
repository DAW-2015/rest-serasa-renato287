<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
require 'clienteDAO.php';
require 'estabelecimentoDAO.php';
require 'estadosDAO.php';
require 'dividaDAO.php';
require 'connection.php';

$app = new \Slim\Slim();
//$app->response()->header('Content-Type', 'application/json;charset=utf-8');

$app->get('/clientes/:cpf', function ($cpf) {
    //recupera o cliente
    $cliente = ClienteDAO::getClienteByCPF($cpf);
    echo json_encode($cliente);
});

$app->get('/clientes', function() {
    // recupera todos os clientes
    $clientes = ClienteDAO::getAll();
    echo json_encode($clientes);
});

$app->post('/clientes', function() {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // insere o cliente
    $novoCliente = json_decode($request->getBody());
    $novoCliente = ClienteDAO::addCliente($novoCliente);

    echo json_encode($novoCliente);
});

$app->put('/clientes/:id', function ($id) {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // atualiza o cliente
    $cliente = json_decode($request->getBody());
    $cliente = ClienteDAO::updateCliente($cliente, $id);

    echo json_encode($cliente);
});

$app->delete('/clientes/:id', function($id) {
    // exclui o cliente
    $isDeleted = ClienteDAO::deleteCliente($id);

    // verifica se houve problema na exclusão
    if ($isDeleted) {
        echo "{'message':'Produto excluído'}";
    } else {
        echo "{'message':'Erro ao excluir produto'}";
    }
});

//Estabelecimento
$app->get('/estabalecimentos/:nome', function ($nome) {
    //recupera o estabelecimento
    $estabelecimento = EstabelecimentoDAO::getEstabelecimentoByNome($nome);
    echo json_encode($estabelecimento);
});

$app->get('/estabelecimentos', function() {
    // recupera todos os estabelecimento
    $estabelecimentos = EstabelecimentoDAO::getAll();
    echo json_encode($estabelecimentos);
});

$app->post('/estabelecimentos', function() {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // insere o estabelecimento
    $novoEstabelecimento = json_decode($request->getBody());
    $novoEstabelecimento = EstabelecimentoDAO::addEstabelecimento($novoEstabelecimento);

    echo json_encode($novoEstabelecimento);
});

$app->put('/estabelecimentos/:id', function ($id) {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // atualiza o estabelecimento
    $estabelecimento = json_decode($request->getBody());
    $estabelecimento = EstabelecimentoDAO::updateEstabelecimento($estabelecimento, $id);

    echo json_encode($estabelecimento);
});

$app->delete('/estabelecimentos/:id', function($id) {
    // exclui o cliente
    $isDeleted = EstabelecimentoDAO::deleteEstabelecimento($id);

    // verifica se houve problema na exclusão
    if ($isDeleted) {
        echo "{'message':'Produto excluído'}";
    } else {
        echo "{'message':'Erro ao excluir produto'}";
    }
});



//Estado
$app->get('/estados/:nome', function ($nome) {
    //recupera o estabelecimento
    $estado = EstadosDAO::getEstadosByNome($nome);
    echo json_encode($estado);
});

$app->get('/estados', function() {
    // recupera todos os estabelecimento
    $estados = EstadosDAO::getAll();
    echo json_encode($estados);
});

$app->post('/estados', function() {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // insere o estabelecimento
    $novoEstado = json_decode($request->getBody());
    $novoEstado = EstadosDAO::addEstado($novoEstado);

    echo json_encode($novoEstado);
});

$app->put('/estados/:id', function ($id) {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // atualiza o estabelecimento
    $estado = json_decode($request->getBody());
    $estado = EstadosDAO::updateEstados($estado, $id);

    echo json_encode($estado);
});

$app->delete('/estados/:id', function($id) {
    // exclui o cliente
    $isDeleted = EstadosDAO::deleteEstado($id);

    // verifica se houve problema na exclusão
    if ($isDeleted) {
        echo "{'message':'Produto excluído'}";
    } else {
        echo "{'message':'Erro ao excluir produto'}";
    }
});

//Cidade
$app->get('/cidades/:nome', function ($nome) {
    //recupera o cidade
    $cidade = CidadesDAO::getCidadesByNome($nome);
    echo json_encode($cidade);
});

$app->get('/cidades', function() {
    // recupera todos os cidade
    $cidades = CidadesDAO::getAll();
    echo json_encode($cidades);
});

$app->post('/cidades', function() {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // insere o cidade
    $novoCidade = json_decode($request->getBody());
    $novoCidade = CidadesDAO::addCidade($novoCidade);

    echo json_encode($novoCidade);
});

$app->put('/cidades/:id', function ($id) {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // atualiza o cidade
    $cidade = json_decode($request->getBody());
    $cidade = CidadesDAO::updateCidades($cidade, $id);

    echo json_encode($cidade);
});

$app->delete('/cidades/:id', function($id) {
    // exclui o cidade
    $isDeleted = CidadesDAO::deleteCidade($id);

    // verifica se houve problema na exclusão
    if ($isDeleted) {
        echo "{'message':'Produto excluído'}";
    } else {
        echo "{'message':'Erro ao excluir produto'}";
    }
});

//Dividas
$app->get('/dividas/:nome', function ($nome) {
    //recupera o estabelecimento
    $divida = DividasDAO::getDividasByNome($nome);
    echo json_encode($divida);
});

$app->get('/dividas', function() {
    // recupera todos os estabelecimento
    $dividas = DividasDAO::getAll();
    echo json_encode($dividas);
});

$app->post('/dividas', function() {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // insere o estabelecimento
    $novoDivida = json_decode($request->getBody());
    $novoDivida = DividasDAO::addDivida($novoDivida);

    echo json_encode($novoDivida);
});

$app->put('/dividas/:id', function ($id) {
    // recupera o request
    $request = \Slim\Slim::getInstance()->request();

    // atualiza o estabelecimento
    $divida = json_decode($request->getBody());
    $divida = DividasDAO::updateDividas($divida, $id);

    echo json_encode($divida);
});

$app->delete('/dividas/:id', function($id) {
    // exclui o divida
    $isDeleted = DividasDAO::deleteDivida($id);

    // verifica se houve problema na exclusão
    if ($isDeleted) {
        echo "{'message':'Produto excluído'}";
    } else {
        echo "{'message':'Erro ao excluir produto'}";
    }
});
$app->run();
