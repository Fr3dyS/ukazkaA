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
		<h2>Login</h2>
	</div>

	<form method="post" id="fg" action="login.php">
		<?php
		include('errory.php');
		?>
		<div class="input-group">
			<label>Jméno</label>
			<input type="text" name="jmeno">
		</div>
		<div class="input-group">
			<label>Heslo</label>
			<input type="password" name="heslo">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="prihlaseniUzivatel">Login</button>
			Nejsi ještě členem? <a href="registrace.php" class="btn red">Zaregistruj se!</a>
		</div>
		<p>
			<a href="registrace.php"></a>
		</p>
	</form>
	<script>
		$("#fg").validate({
			rules: {
				jmeno: {
					required: true,
					minlength: 2
				},
				heslo: {
					required: true,
					minlength: 2
				}
			},
			messages: {
				jmeno: {
					required: "nebylo vloženo jméno",
					minlength: "jméno musí být větší jak dva znaky"
				},
				heslo: {
					required: "nebylo vloženo heslo",
					minlength: "heslo musí být větší jak dva znaky"
				}
			}
		});
	</script>
</body>

</html>