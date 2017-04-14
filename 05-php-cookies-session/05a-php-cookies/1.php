<html>
<body>
<?php
if (isset($_COOKIE['nfe102cookie']) && ($_COOKIE['nfe102cookie'] != '') ) {
	printf("Le cookie \"nfe102cookie\" existe et sa valeur est [%s].\n", ($_COOKIE['nfe102cookie'] != '') ? $_COOKIE['nfe102cookie'] : "Non défini");

} else {

	print('
			<form action="1.php"  method="post">
			<input type="text" name="nfe102cookie" value="" placeholder="nfe102cookie">
			<input type="submit" name="setcookie" value="SetCookie">
			</form>
			');
}

?>

<?php
if (isset($_POST["nfe102cookie"])) {
	setcookie("nfe102cookie", $_POST["nfe102cookie"], -1);
}
?>

<br/><a href="2.php">Page 2 &gt;&gt;</a>
</body>
</html>
