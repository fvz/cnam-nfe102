<?php

$user="c";
$pwd="p";

function auth() {
	header('WWW-Authenticate: Basic realm="Test Authentication System"');
	header('HTTP/1.0 401 Unauthorized');
	echo "Vous n'etes pas autorisé !";
	exit;
}

if (!isset($_SERVER['PHP_AUTH_USER']) && (!isset($_SERVER['PHP_AUTH_PW'])) ) {
	auth();
} else {

	if (($_SERVER['PHP_AUTH_USER'] == "$user") && ($_SERVER['PHP_AUTH_PW'] == "$pwd") ) {
		echo "<p>Bonjour, {$_SERVER['PHP_AUTH_USER']}.</p>";
		echo "<p>Votre mot de passe est {$_SERVER['PHP_AUTH_PW']}.</p>";
		echo "Vous etes autorisé !";
	}
	else {
		auth();
	}
}


?>

<br/><br/>
<a href="1_deconnection.php">Deconnection</a>


<?php
phpinfo();
?>
