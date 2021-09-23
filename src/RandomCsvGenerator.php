<?php
namespace App;

require_once(__DIR__ . "/../vendor/autoload.php");
class RandomCsvGenerator
{
	const DATE_FORMAT = "d/m/Y";

	// returns file path
	public static function generateRandomisedCsv(string $filepath, int $recordCount): string
	{
		$nameGenerator = new \App\UniqueNameGenerator();
		$dobGenerator = new \App\RandomDateOfBirthGenerator();
		$currentDate = new \DateTime("today");

		$fileHandle = fopen($filepath, "w");
		// add headers
		fputcsv($fileHandle, ["Id", "Name", "Surname", "Initials", "Age", "DateOfBirth"]);
		for ($i = 0; $i < $recordCount; $i++) {
			$nameResult = $nameGenerator->getNextUniqueName();
			$dateOfBirth = $dobGenerator->getRandomDateOfBirth();
			$age = $dateOfBirth->diff($currentDate)->y;
			$dateOfBirthStr = $dateOfBirth->format(self::DATE_FORMAT);

			$csvRecord = [
				$i,
				$nameResult->getName(),
				$nameResult->getSurname(),
				$nameResult->getInitials(),
				$age, $dateOfBirthStr,
			];
			fputcsv($fileHandle, $csvRecord);
		}
		fclose($fileHandle);

		return $filepath;
	}
}
?>
