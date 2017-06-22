<!DOCTYPE html>

<?php

    if (isset($_POST["b_action"]) && isset($_POST["m"])) {

        if ($_POST["b_action"] == "chiffrer") {
            if ($_POST["m"] != "") {

				$r = "";
				$d = "";
				$m = $_POST["m"];
				$len = strlen($m);
				for ($i=0; $i<$len; $i++) {

					//printf ("$m[$i] = [%03d]\n", ord($m[$i]));
					//$r .= sprintf("%03d", ord($m[$i]));

					$ascii = ord($m[$i]);
					$r .= sprintf("%d", bcpowmod("$ascii", "71", "1073"));


					$d .= "[";
					$d .= sprintf("$m[$i]-$ascii:%d", bcpowmod("$ascii", "71", "1073"));
					$d .= "]";
				}

                $_POST["mchiffre"]=$r;
				$_POST["mchiffre_debug"]=$d;
			}
        }
		else if ($_POST["b_action"] == "dechiffrer") {

			$r = "";
			$d = "";
			$m = $_POST["m"];
			$len = strlen($m);
			for ($i=0; $i<$len; $i+=3) {

				$calcul = bcpowmod(substr($m, $i, 3), 1079, 1073);
				$r .= sprintf("%s", chr($calcul));

				$d .= "[";
				$d .= sprintf("%s:", substr($m, $i, 3));
				$d .= sprintf("%s", chr(bcpowmod(substr($m, $i, 3), 1079, 1073)));
				$d .= "]";

			}

			$_POST["mchiffre"]=$r;
			$_POST["mchiffre_debug"]=$d;

		}


    }
?>


<html>

	<head>
		<meta charset="utf-8"/>
		<title> Exercice n°2 - Script HTML </title>
	</head>

	<body>
        <h3> Chiffrement </h3>

<!--
<?php if (0) {phpinfo();} ?>
-->

		<form method="post" action="chiffrement.php">

			<input type="submit" name="b_action" value="chiffrer"/>
			<input type="submit" name="b_action" value="dechiffrer"/><br/>
			Message </br>
            <textarea rows="4" cols="50" name="m"><?php if (isset($_POST["mchiffre"])) {echo $_POST["mchiffre"];} else {echo "Hello";}?></textarea>
			</br>
            <input type="hidden" name="mchiffre" value=""/>
			<textarea rows="4" cols="50" name="d"><?php if (isset($_POST["mchiffre_debug"])) {echo $_POST["mchiffre_debug"];}?></textarea>
			</br>

<br/><br/><br/><br/><br/><br/>

<!--
<form method="post" action="chiffrement.php">
<table>
<tr>
	<td>
        <textarea rows="4" cols="50" name="m"><?php if (isset($_POST["m"])) {echo $_POST["m"];} else {echo "abc";}?></textarea>
	</td>
	<td>
		<input type="submit" name="b_action" value="chiffrer"/><br/>
		<input type="submit" name="b_action" value="dechiffrer"/>
	</td>
	<td>
		<textarea rows="4" cols="50" name="mchiffre"><?php if (isset($_POST["mchiffre"])) {echo $_POST["mchiffre"];}?></textarea>
	</td>
</tr>
</table>
</form>
-->

		</form>
    </body>
</html>
