<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
require 'clienteDAO.php';

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

$app->run();
