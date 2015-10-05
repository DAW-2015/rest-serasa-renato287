<?php

class Connection
{
  public static $database = "daw-aluno6-cms";
  public static $address = "150.164.102.160";
  public static $user = "daw-aluno6";
  public static $password = "renato";

  public static function getConnection() {
    $connection = mysqli_connect(Connection::$address, Connection::$user, Connection::$password, Connection::$database);

    return $connection;
  }
}
