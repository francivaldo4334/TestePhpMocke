<?php

namespace Clinic\Repository;

use Clinic\Entities\Patient;
use Clinic\Database\Connection;

use PDO;

class PatientRepository implements PatientRepositoryInterface
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
}
