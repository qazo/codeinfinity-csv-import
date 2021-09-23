<?php
namespace App;

class UniqueNameGenerator
{
	private array $names = [
		"Michael",
		"Christopher",
		"Jessica",
		"Matthew",
		"Ashley",
		"Jennifer",
		"Joshua",
		"Amanda",
		"Daniel",
		"David",
		"James",
		"Robert",
		"John",
		"Joseph",
		"Andrew",
		"Ryan",
		"Brandon",
		"Jason",
		"Justin",
		"Sarah",
	];

	private array $surnaames = [
		"Smith",
		"Johnson",
		"Williams",
		"Jones",
		"Brown",
		"Davis",
		"Miller",
		"Wilson",
		"Moore",
		"Taylor",
		"Anderson",
		"Thomas",
		"Jackson",
		"White",
		"Harris",
		"Martin",
		"Thompson",
		"Garcia",
		"Martinez",
		"Robinson",
	];

	private array $createdNames = [];

	public function getNextUniqueName(): \App\UniqueNameResult
	{
		$uniqueNames = [];
		$surname = $this->surnames[array_rand($this->surnames)];

		// make sure that new is unique by adding more first names
		// since 20 names and 20 surnames only yields up to 400 variations
		// if we use single names
		$nameStr = "";
		$initials = "";
		do {
			$newName = $this->names[array_rand($this->names)];
			$initials .= $newName[0];
			$uniqueNames[] = $newName;
			$nameStr = implode(" ", $uniqueNames);
			$fullname = "{$nameStr} {$surname}";
		}
		while (isset($createdNames[$fullname]));

		$createdNames[$fullname] = true;

		return new \App\UniqueNameResult($nameStr, $surname, $initials);
	}

	public function reset()
	{
		$createdNames = [];
	}
}
?>
