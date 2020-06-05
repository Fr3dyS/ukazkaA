<?php
session_start();
if (!isset($_SESSION['jmeno'])) {
	$_SESSION['msg'] = "Musíš být nejdříve přihlášen";
	header('location: login.php');
}
$_SESSION['vitej'] = "Vítej";
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['jmeno']);
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Plán akci</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           .cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<style>
		.cena {
			float: left;
		}
	</style>
</head>

<body>

	<div class="header">
		<h2>Plán akci</h2>
	</div>
	<div class="content">
		<?php if (isset($_SESSION['uspech'])) : ?>
			<div class="error success">
				<h3>
					<?php
					echo $_SESSION['uspech'];
					unset($_SESSION['uspech']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<?php if (isset($_SESSION['jmeno'])) : ?>
			<div class="center">
				<?php echo $_SESSION['vitej']; ?>
				<strong><?php echo $_SESSION['jmeno']; ?></strong></p>
				<p><a href="akce.php">Vlad akci</a></p>
				<p><a href="delete.php">Mazaní</a></p>
				<p><a href="update.php">Update</a></p>
				<p><a href="vypis.php">Výpis akci</a></p>
				<p> <a href="index.php?logout='1'" style="color: red;">Odhlášení</a></p>
			</div>
		<?php endif ?>
	</div>
	<div>
		<div class="tabulka">
		</div>
	</div>
	</div>
</body>

</html>