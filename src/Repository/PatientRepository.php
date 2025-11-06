<?php

namespace Clinic\Repository;

use Clinic\Entities\Patient;
use Clinic\Database\Connection;

use PDO;
use PDOException;

class PatientRepository
{
  private PDO $db;

  public function __construct()
  {
    $this->db = Connection::getInstance();
  }
  public function findByEmail(string $email): ?Patient
  {
    $stmt = $this->db->prepare("SELECT id, name, email FROM patients WHERE email = :email LIMIT 1");
    $stmt->bindValue(":email", $email);
    $stmt->execute();

    $data = $stmt->fetch();

    if (!$data) {
      return null;
    }

    return new Patient(
      id: $data['id'],
      name: $data['name'],
      email: $data['email']
    );
  }
  public function insertPatient(Patient $patient): bool
  {
    try {
      $stmt = $this->db->prepare("
        INSERT INTO patients (name, email)
        VALUES (:name, :email)
      ");

      $stmt->bindValue(':name', $patient->getName());
      $stmt->bindValue(':email', $patient->getEmail());

      return $stmt->execute();
    } catch (PDOException $e) {
      throw new \RuntimeException("Erro ao inserir paciente: " . $e->getMessage());
    }
  }
}
