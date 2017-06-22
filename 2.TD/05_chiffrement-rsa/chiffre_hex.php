<!DOCTYPE html>

<?php

    if (isset($_POST["b_action"]) && isset($_POST["m"])) {

        if ($_POST["b_action"] == "chiffrer") {
            if ($_POST["m"] != "") {

				$r = "";
				$d = ""; $d2=""; $d3="";
				$m = $_POST["m"];
				$len = strlen($m);

                $hex = "";
				for ($i=0; $i<$len; $i++) {
					$hex .= dechex(ord($m[$i]));
                    $d .= sprintf("%s:%s ", $m[$i], dechex(ord($m[$i])));
                    $d2 .= sprintf("%s ", dechex(ord($m[$i])));
                }

                $len = strlen($hex);
                for ($i=0; $i<$len; $i+=5) {

                    $mot = hexdec(substr($hex, $i, 5));

                    $haut = (($mot & 0xFFC00)>>10);
                    $bas = ($mot & 0x003FF);
                    print "haut=[$haut] bas=[$bas]<br/>";

                    $r .= sprintf("%03d", bcpowmod("$haut", "71", "1073"));
                    $r .= sprintf("%03d", bcpowmod("$bas", "71", "1073"));
                    $d3 .= $haut.$bas;
                }

/*
hex 48656c6c6f
sub 48656
    1011111000010000
11111111110000000000
          1111111111
    --------------------------
    1011110000000000
    0000001000010000

    02F 210

*/
                $_POST["mchiffre"]=$r;
				$_POST["mchiffre_debug"]=$d;
                $_POST["mchiffre_debug2"]=$d2;
                $_POST["mchiffre_debug3"]=$d3;
			}
        }
		else if ($_POST["b_action"] == "dechiffrer") {

			$r = "";
			$d = $d2 = $d3 = "";
            $hex = "";
			$m = $_POST["m"];
			$len = strlen($m);
			for ($i=0; $i<$len; $i+=6) {

                $haut = bcpowmod(substr($m, $i, 3), 1079, 1073);
                $bas = bcpowmod(substr($m, $i+3, 3), 1079, 1073);

				$d2 .= sprintf("[%03d/%03d] ", $haut, $bas);

                $mot = (($haut & 0x003FF)<<10) + ($bas & 0x003FF);

				$d .= sprintf("%d(%sh)", $mot, dechex($mot));
                $d .= " ";

                $hex .= dechex($mot);
			}


            $len = strlen($hex);
            for ($i=0; $i<$len; $i+=2) {
                $r .= chr(hexdec(substr($hex, $i, 2)));
            }


			$_POST["mchiffre"]=$r;
            $_POST["mchiffre_debug"]=$d;
            $_POST["mchiffre_debug2"]=$d2;
            $_POST["mchiffre_debug3"]=$d3;

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

		<form method="post" action="chiffre_hex.php">

			<input type="submit" name="b_action" value="chiffrer"/>
			<input type="submit" name="b_action" value="dechiffrer"/><br/>
			Message </br>
            <textarea rows="4" cols="50" name="m"><?php if (isset($_POST["mchiffre"])) {echo $_POST["mchiffre"];} else {echo "Hello";}?></textarea>
			</br>
            <input type="hidden" name="mchiffre" value=""/>
            </br></br>Debug </br>
			<textarea rows="4" cols="50" name="d"><?php if (isset($_POST["mchiffre_debug"])) {echo $_POST["mchiffre_debug"];}?></textarea>
			</br>
            <textarea rows="4" cols="50" name="d2"><?php if (isset($_POST["mchiffre_debug2"])) {echo $_POST["mchiffre_debug2"];}?></textarea>
			</br>
            <textarea rows="4" cols="50" name="d3"><?php if (isset($_POST["mchiffre_debug3"])) {echo $_POST["mchiffre_debug3"];}?></textarea>
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
