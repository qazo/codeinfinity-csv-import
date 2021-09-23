<?php
namespace App;

class UniqueNameResult
{
	private string $name;
	private string $surname;
	private string $initials;

	public function __construct(string $name, string $surname, string $initials)
	{
		$this->name = $name;
		$this->surname = $surname;
		$this->initials = $initials;
	}

	public function getName(): string
	{
		return $this->name;
	}
	public function getSurname(): string
	{
		return $this->surname;
	}
	public function getInitials(): string
	{
		return $this->initials;
	}
}
?>
