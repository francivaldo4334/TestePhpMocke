<?php

namespace Clinic\Services;

use Clinic\Entities\Patient;
use Clinic\Repository\PatientRepository;

class PatientService
{
  public function __construct(
    private PatientRepository $repository
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
  public function createPatient(Patient $patient){
    return $this->repository->insertPatient($patient);
  }
}
