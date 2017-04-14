<html>
<body>
<?php
if (isset($_COOKIE['nfe102cookie'])) {
	printf("Le cookie \"nfe102cookie\" existe et sa valeur est [%s].\n", ($_COOKIE['nfe102cookie'] != '') ? $_COOKIE['nfe102cookie'] : "Non défini");
}
?>
<br/><br/><br/>
<a href="1.php">&lt; &lt; Page 1</a> | <a href="3.php">Page 3 &gt;&gt;</a>
</body>
</html>
