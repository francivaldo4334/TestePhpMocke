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
      $host = getenv('DB_HOST') ?: 'localhost';
      $port = getenv('DB_PORT') ?: '5432';
      $dbname = getenv('DB_NAME') ?: 'clinicdb';
      $user = getenv('DB_USER') ?: 'postgres';
      $password = getenv('DB_PASSWORD') ?: 'postgres';

      $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";

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
