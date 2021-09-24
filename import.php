<?php
require_once(__DIR__ . "/vendor/autoload.php");

function fileUploadOk()
{
	if ($_FILES["csvFile"]["error"] != UPLOAD_ERR_OK) {
		return false;
	}
	if (!is_uploaded_file($_FILES["csvFile"]["tmp_name"])) {
		return false;
	}
	return true;
}

if (filter_has_var(INPUT_POST, "submit") && fileUploadOk()) {
	// should i rather read line by line to potentially save mem?
	$csvFilePath = $_FILES["csvFile"]["tmp_name"];
	$csvImporter = new \App\CsvUserImporter();
	$recordCount = $csvImporter->importCsvToDb($csvFilePath);

	$message = "CSV file with {$recordCount} random and unique records successfully created and stored in '{$outputFilePath}'.<br>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CSV Import| Import file</title>
	<link rel="stylesheet" href="https://bootswatch.com/5/flatly/bootstrap.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-dark bg-primary">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php">CSV import</a>
			</div>
		</div>
	</nav>

	<div class="container">
		<br>
		<?php if (isset($message) && strlen($message) > 0): ?>
		<div class="alert alert-success">
			<?php echo $message; ?>
		</div>
		<?php endif ?>

		<form enctype="multipart/form-data" method="post">
			<legend>Import file</legend>
			<div class="form-group">
				<div class="input-group mb-3">
					<label class="form-label mt-4" for="csvFile"></label>
					<input name="csvFile" class="form-control" type="file">
				</div>
			</div>
			<br>

			<button type="submit" name="submit" class="btn btn-primary">Submit</button>
			<a class="btn btn-secondary" href="index.php">Cancel</a>
		</form>
	</div>
</body>
</html>
