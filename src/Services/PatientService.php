<?php

namespace Clinic\Services;

use Clinic\Repository\PatientRepositoryInterface;

class PatientService
{
  public function __construct(
    private PatientRepositoryInterface $repository
  ) {}

  public function getPatientInfo(string $email): array
  {
    $patient = $this->repository->findByEmail($email);
    if (!$patient) {
      throw new \InvalidArgumentException("Paciente não encontrado");
    }
    return [
      "id" => $patient->getId(),
      "name" => $patient->getName(),
      "email" => $patient->getEmail(),
    ];
  }
}
