<?php
namespace App;

class RandomDateOfBirthGenerator
{
	private int $minDateTs = 0;
	private int $maxDateTs = 0;
	private const DATE_FORMAT = "d/m/Y";

	private static function getMinDateTimestamp(): int
	{
		$currentDate = new \DateTime("today");
		$currentDate->sub(new \DateInterval("P50Y"));
		return $currentDate->getTimestamp();
	}

	private static function getMaxDateTimestamp(): int
	{
		$currentDate = new \DateTime("today");
		$currentDate->sub(new \DateInterval("P18Y"));
		return $currentDate->getTimestamp();
	}

	public function __construct()
	{
		$this->minDateTs = self::getMinDateTimestamp();
		$this->maxDateTs = self::getMaxDateTimestamp();
	}

	public function getRandomDateOfBirth(): \DateTime
	{
		$timestamp = rand($this->minDateTs, $this->maxDateTs);
		$date = new \DateTime();
		$date->setTimestamp($timestamp);
		return $date;
	}
}
?>
