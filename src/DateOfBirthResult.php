<?php
namespace App;

class DateOfBirthResult
{
	private string $dateOfBirth;
	private int $age;

	public function __construct(string $dateOfBirth, int $age)
	{
		$this->dateOfBirth = $dateOfBirth;
		$this->age = $age;
	}

	public function getDateOfBirth(): string
	{
		return $this->dateOfBirth;
	}

	public function getAge(): int
	{
		return $this->age;
	}
}
?>
