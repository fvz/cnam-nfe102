<html>
<body>
<?php

/***
 Nouvelle façon de gérer un panier : on factorise bcp + de code et cela permet
 d'ajouter des articles + facilement. Attention, le panier n'est +stocké de la
 même manière. Les 2 implémentations ne gère donc pas le même panier :
   - Ancien fichier : une variable par article
   - Ce New fichier : panier = tableau associatif d'articles sélectionnés.
***/


session_start();


/* tableau associatif d'articles déclarés */
$article = array(
		/**** pour ajouter un article :

		'id (entier)' => array (
				'id' => id unique (entier),
				'nom' => "Nom article",
				'prix' => prix (entier),
			),
		****/

		'0' => array (
				'id' => 123,
				'nom' => "Farine",
				'prix' => 5,
			),
		'1' => array (
				'id' => 456,
				'nom' => "Levure",
				'prix' => 2,
			),
		'2' => array (
				'id' => 789,
				'nom' => "Oeufs",
				'prix' => 4,
			),
		'3' => array (
				'id' => 101,
				'nom' => "Sel",
				'prix' => 1,
			),
		'4' => array (
				'id' => 124,
				'nom' => "Sucre",
				'prix' => 2,
			),
		'5' => array (
				'id' => 125,
				'nom' => "Pepites",
				'prix' => 8,
			),


	);


/* initialisation panier (tableau associatif : 'idarticle' => nb éléments sélectionnés pr cet article ) */

if (!isset($_SESSION['panier'])) {
	$_SESSION['panier'] = array();
}


if (isset($_GET['action'])) {

	if ($_GET['action'] == 'clean') {
		$_SESSION['panier'] = array(); /* on assigne au panier un tableau vide */

	} else {
		if (isset($_GET['article']) && isset($_GET['nb'])) {

			$id = $_GET['article'];
			if (!isset($_SESSION['panier'][$id])) {
				$_SESSION['panier'][$id] = 0;
			}

			/* action add ou del */
			switch($_GET['action']) {
				case 'add':
					$_SESSION['panier'][$id] += $_GET['nb'];
					break;

				case 'del':
					$_SESSION['panier'][$id] -= $_GET['nb'];
					if ($_SESSION['panier'][$id] < 0) {
						$_SESSION['panier'][$id] = 0;
					}
					break;
			}
		}
	}
}

?>

<br/>
<b>Mon beau panier pour faire des cookies :</b>
<br/><br/>

<table border=1>
<tr>
	<th>Articles</th>
	<th>Sélection</th>
	<th>Ajout/Suppr</th>
	<th>Tarif</th>
</tr>
<?php
/* on boucle sur la liste d'articles déclarés */
foreach ($article as $k => $v) {
	$id = $v['id'];
	printf("<tr>\n");
	printf("<td>%s</td>\n", $v['nom']);
	printf("<td align=center>%d</td>\n", isset($_SESSION['panier'][$id]) ? ($_SESSION['panier'][$id]) : 0);
	printf("<td align=center>\n");
	printf("<a href=\"?article=%s&action=add&nb=1\">+1</a> /", $v['id']);
	printf("<a href=\"?article=%s&action=add&nb=10\">+10</a> /", $v['id']);
	printf("<a href=\"?article=%s&action=del&nb=1\">-1</a>", $v['id']);
	printf("</td>\n");
	printf("<td align=right>%d EUR</td>\n",  $v['prix']);
	printf("</tr>\n");
}

/* Dernière ligne = Total Articles + Somme */
printf("<tr>\n");
printf("<td><b>Total :</td>\n");
$nb = 0;
$sum = 0;
if (isset($_SESSION['panier'])) {
	/* on cherche l'id (présent dans le panier) dans le tableau d'articles déclarés */
	foreach ($_SESSION['panier'] as $kP => $vP) {	/* kP = keyPanier / vP = valuePanier */
		foreach($article as $kA => $vA) {	/* kA = keyArticle / vA = valueArticle */

			if ($kP = $vA['id']) { /* on a trouvé l'article */
				$nb += $vP;
				$sum += $vA['prix'] * $vP;
				break;
			}
		}
	}
}
printf("<td align=center>%d</td>\n", $nb);
printf("<td></td>\n");
printf("<td align=right><b>%d EUR</b></td>\n", $sum);
printf("</tr>\n");
?>
</table>

<br/>
<a href="?action=clean" onClick="javascript:return confirm('Etes-vous certain de vouloir vider votre panier ?');">Vider Panier</a>
</body>
</html>
