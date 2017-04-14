<html>
<body>
<?php
session_start();

$prix = array(
		'farine' => 5,
		'oeuf' => 2,
		'levure' => 4,
		'sel' => 1,
		'sucre' => 2,
		'pepite' => 8,
	     );


/* initialisation */
if (! isset($_SESSION['farine'])) { $_SESSION['farine'] = 0; }
if (! isset($_SESSION['oeuf'])) { $_SESSION['oeuf'] = 0; }
if (! isset($_SESSION['levure'])) { $_SESSION['levure'] = 0; }
if (! isset($_SESSION['sel'])) { $_SESSION['sel'] = 0; }
if (! isset($_SESSION['sucre'])) { $_SESSION['sucre'] = 0; }
if (! isset($_SESSION['pepite'])) { $_SESSION['pepite'] = 0; }


if (isset($_GET['article']) && isset($_GET['nb'])) {

	if (isset($_GET['action'])) {

		/* action add ou del */
		switch($_GET['action']) {
			case 'add':
				$_SESSION[$_GET['article']] += $_GET['nb'];
				break;

			case 'del':
				$_SESSION[$_GET['article']] -= $_GET['nb'];
				if ($_SESSION[$_GET['article']] < 0) {
					$_SESSION[$_GET['article']] = 0;
				}
				break;

		}
	}
}



?>

<br/>
<b>Panier  (Ajouter / Supprimer)</b>
<br/><br/>

<table border=1>
<tr>
	<th>Articles</th>
	<th>Sélection</th>
	<th>Ajout/Suppr</th>
	<th>Tarif</th>
</tr>
<tr>
	<td>Farine</td>
	<td><?php printf("%d", $_SESSION['farine']); ?></td>
	<td><a href="?article=farine&action=add&nb=1">+</a> / <a href="?article=farine&action=del&nb=1">-</a></td>
	<td>5€</td>
</tr>
<tr>
	<td>Levure</td>
	<td><?php printf("%d", $_SESSION['levure']); ?></td>
	<td><a href="?article=oeuf&action=add&nb=1">+</a> / <a href="?article=oeuf&action=del&nb=1">-</a></td>
	<td>2€</td>
</tr>
<tr>
	<td>Oeufs</td>
	<td><?php printf("%d ", $_SESSION['oeuf']); ?></td>
	<td><a href="?article=levure&action=add&nb=1">+</a> / <a href="?article=levure&action=del&nb=1">-</a></td>
	<td>4€</td>
</tr>
<tr>
	<td>Sel</td>
	<td><?php printf("%d ", $_SESSION['sel']); ?></td>
	<td><a href="?article=sel&action=add&nb=1">+</a> / <a href="?article=sel&action=del&nb=1">-</a></td>
	<td>1€</td>
</tr>
<tr>
	<td>Sucre</td>
	<td><?php printf("%d ", $_SESSION['sucre']); ?></td>
	<td><a href="?article=sucre&action=add&nb=1">+</a> / <a href="?article=sucre&action=del&nb=1">-</a></td>
	<td>2€</td>
</tr>
<tr>
	<td>Pepite</td>
	<td><?php printf("%d ", $_SESSION['pepite']); ?></td>
	<td><a href="?article=pepite&action=add&nb=1">+</a> / <a href="?article=pepite&action=del&nb=1">-</a></td>
	<td>8€</td>
</tr>
<tr>
	<td><b>Total</b></td>
	<td></td>
	<td></td>
	<td><b>
	<?php printf("%d",
			($_SESSION['farine'] * $prix['farine'] + $_SESSION['oeuf'] * $prix['oeuf'] + $_SESSION['levure'] * $prix['levure'] + $_SESSION['sel'] * $prix['sel'] + $_SESSION['sucre'] * $prix['sucre'] + $_SESSION['pepite'] * $prix['pepite']) ); ?>
	</b></td>
</tr>
</table>

</body>
</html>
