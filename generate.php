<?php
require_once(__DIR__ . "/vendor/autoload.php");

if (filter_has_var(INPUT_POST, "submit")) {
	$recordCount = $_POST["recordCount"];
	$outputFilePath = \App\RandomCsvGenerator::generateRandomisedCsv($recordCount);

	$message = "CSV file with {$recordCount} random and unique records successfully created and stored in '{$outputFilePath}'.<br>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CSV import| Generate randomised CSV</title>
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
		<h3>Generate CSV file</h3>
		<?php if (isset($message) && strlen($message) > 0): ?>
		<div class="alert alert-success">
			<?php echo $message; ?>
		</div>
		<?php endif ?>

		<form method="post">
			<div class="form-group">
				<div class="input-group mb-3">
					<input name="recordCount" class="form-control" type="number" min="1"
						placeholder="Record count">
					<button name="submit" class="btn btn-primary" type="submit">Submit</button>
				</div>
			</div>
			<br>
			<a class="btn btn-secondary" href="index.php">Cancel</a>
		</form>
	</div>
</body>
</html>
