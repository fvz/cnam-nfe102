<?php

//phpinfo();

$cnx = mysql_connect ('localhost', "root", "");
mysql_select_db ("nfe102_tp", $cnx);


if ((isset($_POST["ajouter"])) && (isset($_POST["titre"])) && (isset($_POST["auteur"]))) {
    $sql = sprintf("insert into film (titre, auteur, date_real) values ('%s', '%s', '%s')",
        $_POST["titre"], $_POST["auteur"], $_POST["date_real"]);
    if (mysql_query ($sql, $cnx)) {
        //print("[Ajouté]<br/>");
    }
    else {
        print('Requête invalide : ' . mysql_error());
    }
}


if (isset($_GET["suppr"])) {
    if (is_numeric($_GET["suppr"])) {
        $sql = sprintf("delete from film where id = '%d'", $_GET["suppr"]);

        if (!mysql_query ($sql, $cnx)) {
            print('Requête invalide : ' . mysql_error());
        }
    }
}


if ((isset($_GET["multisuppr"])) && (isset($_POST["film_suppr"]))) {
    foreach ($_POST["film_suppr"] as $f => $idsuppr) {
        $sql = sprintf("delete from film where id = '%d'", (integer)$idsuppr);
        if (!mysql_query ($sql, $cnx)) {
            print('Requête invalide : ' . mysql_error());
        }
    }
}


?>

<form action="films.php" method="post">
    <input type="text" name="titre" value="" placeholder="Nom du film">
    <input type="text" name="auteur" value="" placeholder="Auteur">
    <input type="text" name="date_real" value="" placeholder="Date AAAA-MM-JJ">
    <input type="submit" name="ajouter" value="Ajouter">
    <input type="submit" name="rechercher" value="Rechercher">
</form>



<form action="films.php?multisuppr=1" method="post">
<table border=1>

<tr>
    <th>Film</th>
    <th>Auteur</th>
    <th>Date</th>
    <th>Suppr</th>
    <th><input type="submit" name="valider" value="Supprimer"></th>
</tr>

<?php
$res = mysql_query ("select * from film", $cnx);

while ( ($f = mysql_fetch_object ($res))) {
    printf("
<tr>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
    <td><a href=\"films.php?suppr=%d\">Supprimer</a></td>
    <td><input type=checkbox name=film_suppr[] value=%d></td>

</tr>\n", $f->titre, $f->auteur, $f->date_real, $f->id, $f->id);
}

?>
</table>

</form>

<?php

if (isset($_POST["rechercher"])) {

    $i = 0;
    $sql = sprintf("select titre, auteur, date_real, id from film ");

    if (isset($_POST["titre"])  && ($_POST["titre"] != "")) {
        $sql .= ($i==0) ? " where " : " and "; $i++;
        $sql .= " titre like \"%" . $_POST["titre"] . "%\"";
    }

    if (isset($_POST["auteur"]) && ($_POST["auteur"] != "")) {
        $sql .= ($i==0) ? " where " : " and "; $i++;
        $sql .= " auteur like \"%" . $_POST["auteur"] . "%\"";
    }

    if (isset($_POST["date_real"]) && ($_POST["date_real"] != "")) {
        $sql .= ($i==0) ? " where " : " and "; $i++;
        $sql .= " date_real like \"%" . $_POST["date_real"] . "%\"";
    }

    $sql .= ";";


    if ($res = mysql_query ($sql, $cnx)) {

        $i = 0;
        while ($f = mysql_fetch_object ($res)) {

            if ($i == 0) {
                $i++;
                print("
                    <table border=1>
                    <tr>
                        <th>Film</th>
                        <th>Auteur</th>
                        <th>Date</th>
                    </tr>");
            }

            printf("
                <tr>
                    <td>%s</td>
                    <td>%s</td>
                    <td>%s</td>
                </tr>\n", $f->titre, $f->auteur, $f->date_real);
        }


        if ($i > 0) {
            printf("</table>");
        }

    }
    else {
        print('Requête invalide : ' . mysql_error());
    }
}

?>


</body>
</html>
