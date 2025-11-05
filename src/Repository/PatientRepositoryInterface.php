<?php
namespace Clinic\Repository;

use Clinic\Entities\Patient;

interface PatientRepositoryInterface
{
    public function findByEmail(string $email): ?Patient;
}
