<?php
namespace App;

class CsvUserImporter
{
	const INSERT_USER_SQL = "insert into csv_import(name, surname, initials, age, date_of_birth) values (?, ?, ?, ?, ?);";
	const CREATE_TABLE_SQL = "create table csv_import(id integer primary key autoincrement, name text, surname text, initials text, age int, date_of_birth text);";
	const OUTPUT_FILE_DIR = __DIR__ . "/../csv-output";

	private static function getUniqueOutputFilePath()
	{
		$currDateTime = new \DateTime("now");
		$currTimeStamp = $currDateTime->getTimestamp();
		$uniqueDirPath = self::OUTPUT_FILE_DIR . "/file-out_{$currTimeStamp}";
		mkdir($uniqueDirPath, 0755, true);
		return $uniqueDirPath . "/csv-import.sqlite3";
	}

	public function importCsvToDb(string $csvFilePath, string $dbFilePath = ""): int
	{
		if (!isset($dbFilePath) || $dbFilePath == "") {
			$dbFilePath = self::getUniqueOutputFilePath();
		}

		$csvFileHandle = fopen($csvFilePath, "r");
		$line = fgetcsv($csvFileHandle); // skip first line

		$name = "";
		$surname = "";
		$initials = "";
		$age = 0;
		$dateOfBirth = "";

		$db = new \SQLite3($dbFilePath);
		$db->exec(self::CREATE_TABLE_SQL);

		$statement = $db->prepare(self::INSERT_USER_SQL);
		$statement->bindParam(1, $name);
		$statement->bindParam(2, $surname);
		$statement->bindParam(3, $initials);
		$statement->bindParam(4, $age);
		$statement->bindParam(5, $dateOfBirth);

		$recordCount = 0;
		while (($line = fgetcsv($csvFileHandle, 1000)) != false) {
			$name = $line[1];
			$surname = $line[2];
			$initials = $line[3];
			$age = $line[4];
			$dateOfBirth = $line[5];
			$statement->execute();
			$recordCount++;
		}
		fclose($csvFilePath);
		return $recordCount;
	}
}
?>
