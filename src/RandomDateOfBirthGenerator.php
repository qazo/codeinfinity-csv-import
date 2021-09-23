<?php
namespace App;

class RandomDateOfBirthGenerator
{
	private static int $minDateTs = 0;
	private static int $maxDateTs = 0;
	private const DATE_FORMAT = "d/m/Y";

	private function getMinDateTimestamp(): int
	{
		$currentDate = new \DateTime("today");
		$currentDate->sub(new \DateInterval("P100Y"));
		return $currentDate->getTimestamp();
	}

	private function getMaxDateTimestamp(): int
	{
		$currentDate = new \DateTime("today");
		$currentDate->sub(new \DateInterval("P18Y"));
		return $currentDate->getTimestamp();
	}

	public function __construct()
	{
		$minDateTs = getMinDateTimestamp();
		$maxDateTs = getMaxDateTimestamp();
	}

	public function getRandomDateOfBirth(): \DateTime
	{
		$timestamp = rand($minDateTs, $maxDateTs);
		$date = new \DateTime();
		$date->setTimestamp($timestamp);
		return $date;
	}
}
?>
