<?php

namespace Clinic\Repository;

use Clinic\Entities\Patient;


class PatientRepository
{
  public function findByEmail(string $email): ?Patient
  {
    throw new \RuntimeException("Método não implementado");
  }
}
