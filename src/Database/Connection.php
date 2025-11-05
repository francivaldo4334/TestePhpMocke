<?php

namespace Clinic\Database;

use PDO;
use PDOException;

class Connection
{
  private static ?PDO $instance = null;
  public static function getInstance(): PDO
  {
    if (self::$instance === null) {
      $dsn = "pgsql:host=localhost;port=5432;dbname=clinicdb;";
      $user = "postgres";
      $password = "senha_segura";
      try {
        self::$instance = new PDO($dsn, $user, $password, [
          PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
          PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
      } catch (PDOException $e) {
        throw new \RuntimeException("Erro ao conectar ao banco: " . $e->getMessage());
      }
    }

    return self::$instance;
  }
}
