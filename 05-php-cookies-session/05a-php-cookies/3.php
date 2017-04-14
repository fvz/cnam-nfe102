<html>
<body>
<?php
if (isset($_POST["setcookie"])) {
	if (isset($_POST["nfe102cookie"])) {
		//die($_POST["nfe102cookie"]);
		setcookie("nfe102cookie", $_POST["nfe102cookie"], -1);
		header("Location: 3.php");
	}
}

if (isset($_GET["supprcookie"])) {
	setcookie("nfe102cookie", null);
	header("Location: 3.php");
}

if (isset($_COOKIE['nfe102cookie'])) {
	printf("Le cookie \"nfe102cookie\" existe et sa valeur est [%s].\n",
			($_COOKIE['nfe102cookie'] != '') ? $_COOKIE['nfe102cookie'] : "Non défini");
}

?>

<form action="3.php"  method="post">
	<input type="text" name="nfe102cookie" value="<?php print( isset($_COOKIE['nfe102cookie']) ? $_COOKIE['nfe102cookie'] : ''); ?>" placeholder="nfe102cookie">
	<input type="submit" name="setcookie" value="modifier le nfe102cookie">
</form>

<br/><a href="1.php">&lt;&lt; page 1</a> | <a href="2.php">&lt;&lt; page 2</a> | <a href="3.php?supprcookie">Supprimer Cookie</a>
</body>
</html>
