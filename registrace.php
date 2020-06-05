<?php
include('server.php')
?>
<!DOCTYPE html>
<html>

<head>
	<title>Plán akci</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="validate.js"></script>
</head>

<body>
	<div class="header">
		<h2>Registrace</h2>
	</div>

	<form method="post" id="fg"action="registrace.php">
		<?php include('errory.php'); ?>
		<div class="input-group">
			<label>Jméno</label>
			<input type="text" name="jmeno">
		</div>
		<div class="input-group">
			<label>Přijmení</label>
			<input type="text" name="prijmeni">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email">
		</div>
		<div class="input-group">
			<label>Datum narození</label>
			<input type="date" name="datum">
		</div>
		<div class="input-group">
			<label>heslo</label>
			<input type="password" id="heslo" name="heslo">
		</div>
		<div class="input-group">
			<label>Potvrzení hesla</label>
			<input type="password" name="heslo2">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="registrovanyUzivatel">Zaregistruj se</button>
		</div>
		<p>
			Už si zaregistrován? <a href="login.php">Přihlaš se</a>
		</p>
	</form>
	<script>
		$("#fg").validate({
			rules: {
				jmeno: {
					required: true,
					minlength: 4
				},
				prijmeni: {
					required: true,
					minlength: 4
				},
				email: {
					required: true,
					email: true
				},
				datum: {
					required: true,
					date: true
				},
				heslo: {
					required: true,
					minlength: 2
				},
				heslo2: {
					required: true,
					minlength: 2,
					equalTo: "#heslo"
				}
			},
			messages: {
				jmeno: {
					required: "Nebylo vloženo jméno",
					minlength: "Minimální velikost jména musí být 4 znaky"
				},
				prijmeni: {
					required: "Nebylo vloženo příjmení",
					minlength: "Minimální velikost příjmení musí být 4 znaky"
				},
				email: {
					required: "Nebyl vložen email",
					email: "špatný email"
				},
				datum: {
					required: "Nebyl vložen datum narození",
					date: "datum narození špatně"
				},
				heslo: {
					required: "Nebylo vloženo heslo",
					minlength: "Minimální velikost hesla jsou 2 znaky"
				},
				heslo2: {
					required: "Nebylo vloženo heslo",
					minlength: "Minimální velikost hesla jsou 2 znaky",
					equalTo: "Hesla musí být stejná"
				}
			}
		});
	</script>
</body>

</html>