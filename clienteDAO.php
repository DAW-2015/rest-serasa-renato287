<?php


class ClienteDAO
{

    public static function getClienteByID($id) {
    $connection = Connection::getConnection();
    $sql = "SELECT * FROM clientes WHERE id=$id";
    $result  = mysqli_query($connection, $sql);
    $cliente = mysqli_fetch_object($result);

    //recupera cidade do cliente
    $sql = "SELECT * FROM cidades WHERE id=$cliente->cidades_id";
    $result = mysqli_query($connection, $sql);
    $cliente->cidade =  mysqli_fetch_object($result);

    return $cliente;
  }
    
  public static function getClienteByCPF($cpf) {
    $connection = Connection::getConnection();
    $sql = "SELECT * FROM clientes WHERE cpf=$cpf";
    $result  = mysqli_query($connection, $sql);
    $cliente = mysqli_fetch_object($result);

    //recupera cidade do cliente
    $sql = "SELECT * FROM cidades WHERE id=$cliente->cidades_id";
    $result = mysqli_query($connection, $sql);
    $cliente->cidade =  mysqli_fetch_object($result);

    return $cliente;
  }


  public static function getAll()
  {
    $connection = Connection::getConnection();
    $sql = "SELECT * FROM clientes";

    // recupera todos os clientes
    $result  = mysqli_query($connection, $sql);
    $clientes = array();
    while ($cliente = mysqli_fetch_object($result)) {
      if ($cliente != null) {
        $clientes[] = $cliente;
      }
    }
    return $clientes;
  }


  public static function updateCliente($cliente, $id) {
    $connection = Connection::getConnection();
    $sql = "UPDATE clientes SET cpf=$cliente->cpf, nome='$cliente->nome', cidades_id=$cliente->cidades_id WHERE id=$id";
    $result  = mysqli_query($connection, $sql);

    $clienteAtualizado = ClienteDAO::getClienteByCPF($cliente->cpf);
    return $clienteAtualizado;
  }


  public static function deleteCliente($id) {
    $connection = Connection::getConnection();
    $sql = "DELETE FROM clientes WHERE id=$id";
    $result  = mysqli_query($connection, $sql);

    if ($result === FALSE) {
      return false;
    } else {
      return true;
    }
  }


  public static function addCliente($cliente) {
    $connection = Connection::getConnection();
    $sql = "INSERT INTO clientes (cpf, nome, cidades_id) VALUES ($cliente->cpf, '$cliente->nome', $cliente->cidades_id)";
    $result  = mysqli_query($connection, $sql);

    $novoCliente = ClienteDAO::getClienteByCPF($cliente->cpf);
    return $novoCliente;
  }
}
