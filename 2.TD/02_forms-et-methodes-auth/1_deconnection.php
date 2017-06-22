<?php


$_SERVER["PHP_AUTH_USER"] = '';
$_SERVER["PHP_AUTH_PW"] = '';

//header('WWW-Authenticate: Basic realm="Test Authentication System"');
header('HTTP/1.0 401 Unauthorized');


//header('HTTP/1.0 401 Unauthorized');
//echo "Vous n'etes plus autorisé !";
phpinfo();

//header ('Location:2.php');

?>
