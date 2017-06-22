<?php

//phpinfo();

$cnx = mysql_connect ('localhost', "root", "");
mysql_select_db ("nfe102_tp", $cnx);


if ((isset($_POST["film"])) && (isset($_POST["auteur"]))) {
    $sql = sprintf("insert into film (titre, auteur, date_real) values ('%s', '%s', '%s')",
        $_POST["film"], $_POST["auteur"], $_POST["date"]);
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

?>



<table border=1>

<tr>
    <th>Film</th>
    <th>Auteur</th>
    <th>Date</th>
    <th>Suppr</th>
    <th>Suppr</th>
</tr>

<?php
$res = mysql_query ("select * from film", $cnx);

while ( ($f = mysql_fetch_object ($res))) {
    printf("
<tr>
    <td>%s</td>
    <td>%s</td>
    <td>%s</td>
    <td><a href=\"/films.php?suppr=%d\">x</a></td>
    <td><input type=checkbox name=suppr%d></td>

</tr>\n", $f->titre, $f->auteur, $f->date_real, $f->id, $f->id);
}

?>
<table>


<br/><br/><br/>
<form action="/films.php" method="post">
    <input type="text" name="film" value="" placeholder="Nom du film">
    <input type="text" name="auteur" value="" placeholder="Auteur">
    <input type="text" name="date" value="" placeholder="Date AAAA-MM-JJ">
    <input type="submit" name="valider" value="Ajouter">
</form>
