<?php

use PHPUnit\Framework\TestCase;
use Clinic\Services\PatientService;
use Clinic\Repository\PatientRepository;
use Clinic\Entities\Patient;

class PatientServiceTest extends TestCase
{

  public function testGetPatientInfoReturnsExpectedData(): void
  {
    // $mockRepository = $this->createMock(PatientRepository::class);

    // $mockRepository->method("findByEmail")
    //   ->with("joao@clinic.com")
    //   ->willReturn(new Patient(1, "João da Silva", "joao@clinic.com"));
    $mockRepository = new PatientRepository();
    $service = new PatientService($mockRepository);
    $service->createPatient(new Patient(1, "João da Silva", "joao@clinic.com"));
    $result = $service->getPatientInfo("joao@clinic.com");

    $this->assertEquals([
      "id" => 1,
      "name" => "João da Silva",
      "email" => "joao@clinic.com",
    ], $result);
  }

  public function testThrowsExceptionWhenPatientNotFound(): void
  {
    $mockRepository = $this->createMock(PatientRepository::class);
    $mockRepository->method("findByEmail")->willReturn(null);

    $service = new PatientService($mockRepository);
    $this->expectException(InvalidArgumentException::class);
    $service->getPatientInfo('naoexiste@clinic.com');
  }
}
